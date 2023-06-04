<?php 
if(isset($_POST['add-customercredential'])){
    
    $temp = explode(".", $_FILES["file_upload"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["file_upload"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $credential_id= null;
        $credential_name= $_POST['credential_name'];
        $file_upload= $newfilename;

        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tblcustomercredential VALUES (?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssss", $credential_id, $credential_name, $file_upload, $customer_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=failed';</script>";
        }
        } else {
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=failed-upload';</script>";
        }
    
}
if(isset($_POST['edit-customercredential'])){
    
    $credential_id= $_POST['credential_id'];
    $credential_name= $_POST['credential_name'];
            
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tblcustomercredential SET credential_name = ? WHERE credential_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ss", $credential_name, $credential_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=failed';</script>";
    }
}
if(isset($_POST['delete-customercredential'])){
    
    $credential_id= $_POST['credential_id'];         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tblcustomercredential WHERE credential_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $credential_id);
        if ($qry->execute()){
            
            $old_file_upload = $_POST ['old_file_upload'];
                if ($old_file_upload != 'img-default.jpg'){
                    //delete old file_upload
                    unlink("../uploads/$old_file_upload");
                }
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=failed';</script>";
        } 
    
    
}
if(isset($_POST['edit-file_upload'])){
    $temp = explode(".", $_FILES["file_upload"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["file_upload"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $credential_id= $_POST['credential_id'];
        $file_upload= $newfilename;
        $old_file_upload= $_POST['old_file_upload'];

            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tblcustomercredential SET file_upload = ? WHERE credential_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $file_upload, $credential_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=success';</script>";
            
                $old_file_upload = $_POST ['old_file_upload'];
                if ($old_file_upload != 'img-default.jpg'){
                    //delete old file_upload
                    unlink("../uploads/$old_file_upload");
                }
        }
        else {
            echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=failed';</script>";
        }
    }
}

?>