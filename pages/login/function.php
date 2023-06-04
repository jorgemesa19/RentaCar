<?php
if(isset($_POST['sign-in'])){
    session_start();
        
    $username= $_POST['username'];
    $password= $_POST['password'];
//    $password = md5($password);
        
    require_once '../database_config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT admin_id FROM tbladmin WHERE username=? AND password=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ss", $username, $password);
    $qry->execute();
    $qry->bind_result($admin_id);
    $qry->store_result();
    $qry->fetch();
        
    if($qry->num_rows==1){//chek if there is data in tbladmin
        $_SESSION['user_id'] = $admin_id;
        $_SESSION['user_type'] = "Administrator";
        header("location:../dashboard/dashboard.php");
           
    } else {//check if there is data in tblowner
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT owner_id, account_status FROM tblowner WHERE username=? AND password=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $username, $password);
        $qry->execute();
        $qry->bind_result($owner_id, $account_status);
        $qry->store_result();
        $qry->fetch();
        if($qry->num_rows==1){
            if ($account_status == 1){
                $_SESSION['user_id'] = $owner_id;
                $_SESSION['user_type'] = "Owner";
                header("location:../dashboard/dashboard.php");
            } else {
                echo "
                <div class='alert alert-warning alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                  <i class='icon fas fa-exclamation-triangle'></i>
                  Your account is deactivated!
                </div>
                ";
            }
        } else {//check if in tblcustomer
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT customer_id, account_status FROM tblcustomer WHERE username=? AND password=?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("ss", $username, $password);
            $qry->execute();
            $qry->bind_result($customer_id, $account_status);
            $qry->store_result();
            $qry->fetch();
            if($qry->num_rows==1){
                if ($account_status == 1){
                    $_SESSION['user_id'] = $customer_id;
                    $_SESSION['user_type'] = "Customer";
                    header("location:../dashboard/dashboard.php");
                } else {
                    echo "
                    <div class='alert alert-warning alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                      <i class='icon fas fa-exclamation-triangle'></i>
                      Your account is deactivated!
                    </div>
                    ";
                }
            
            } else {
                echo "
                <div class='alert alert-warning alert-dismissible'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                          <i class='icon fas fa-exclamation-triangle'></i>
                          Incorrect Username or Password!
                        </div>
                ";
            }
        }
    
    }
}
?>