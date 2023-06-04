<?php 
if(isset($_POST['add-customer'])){
    $temp = explode(".", $_FILES["profile_image"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_image"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $customer_id= null;
        $customer_name = $_POST['customer_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $profile_image = $newfilename;
        $fb_account = $_POST['fb_account'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $admin_id = $_SESSION['user_id'];
        $account_status = $_POST['account_status'];
        
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tblcustomer VALUES (?,?,?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssssssss", $customer_id, $customer_name, $address, $contact, $profile_image, $fb_account, $username, $password, $admin_id, $account_status);
        if ($qry->execute()){
            echo "<script>window.location.href = 'customer.php?status=success';</script>";
                        
        }
        else {
            echo "<script>window.location.href = 'customer.php?status=failed';</script>";
        }
    } else {
        echo "<script>window.location.href = 'customer.php?status=failed-upload';</script>";
    }
     
}
if(isset($_POST['edit-customer'])){
    
    $customer_id= $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $fb_account = $_POST['fb_account'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_status = $_POST['account_status'];
            
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tblcustomer SET customer_name = ?, address = ?, contact = ?, fb_account = ?, username = ?, password = ?, account_status = ? WHERE customer_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssssssss", $customer_name, $address, $contact, $fb_account, $username, $password, $account_status, $customer_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'customer.php?status=success';</script>";  
    }
    else {
        echo "<script>window.location.href = 'customer.php?status=failed';</script>";
    }
}
if(isset($_POST['delete-customer'])){
    
    $customer_id= $_POST['customer_id'];
    $customer_name= $_POST['name'];

         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tblcustomer WHERE customer_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $customer_id);
        if ($qry->execute()){
            $old_profile_image = $_POST ['old_profile_image'];
                if ($old_profile_image != 'img-default.jpg'){
                    //delete old profile_image
                    unlink("../uploads/$old_profile_image");
                }
            
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="DELETE FROM tblcustomercredential WHERE customer_id=?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("s", $customer_id);
            $qry->execute();
            
            echo "<script>window.location.href = 'customer.php?status=success';</script>";
            
        }
        else {
            echo "<script>window.location.href = 'customer.php?status=failed';</script>";
        } 
    
    
}

if(isset($_POST['edit-profile_image'])){
    $temp = explode(".", $_FILES["profile_image"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_image"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $customer_id= $_POST['customer_id'];
        $profile_image= $newfilename;
        $old_profile_image= $_POST['old_profile_image'];

            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tblcustomer SET profile_image = ? WHERE customer_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $profile_image, $customer_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'customer.php?status=success';</script>";
            
                $old_profile_image = $_POST ['old_profile_image'];
                if ($old_profile_image != 'img-default.jpg'){
                    //delete old profile_image
                    unlink("../uploads/$old_profile_image");
                }
        }
        else {
            echo "<script>window.location.href = 'customer.php?status=failed';</script>";
        }
    }
}
?>