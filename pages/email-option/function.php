<?php 
if(isset($_POST['add-email'])){
    
    $e_option_id= null;
    $username= $_POST['username'];
    $password= $_POST['password'];
    $enabled = 1;
    
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_email_option VALUES (?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssss", $e_option_id, $username, $password, $enabled);
        if ($qry->execute()){
            echo "<script>window.location.href = 'email-option.php?status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'email-option.php?status=failed';</script>";
        }   
    
}
if(isset($_POST['edit-email'])){
    

    $e_option_id= $_POST['e_option_id'];
    $username= $_POST['username'];
    $password= $_POST['password'];
    $enabled = $_POST['enabled'];
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_email_option SET username=?, password=?, enabled=? WHERE e_option_id=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssss", $username, $password, $enabled, $e_option_id);
    if ($qry->execute()){
       echo "<script>window.location.href = 'email-option.php?status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'email-option.php?status=failed';</script>";
    }
}
?>