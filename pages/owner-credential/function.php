<?php 
if(isset($_POST['add-ownercredential'])){
    
    $temp = explode(".", $_FILES["file_upload"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
    
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["file_upload"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $owner_credential_id= null;
        $credential_name= $_POST['credential_name'];
        $file_upload= $newfilename;

        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tblownercredential VALUES (?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssss", $owner_credential_id, $credential_name, $file_upload, $owner_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=failed';</script>";
        }
        } else {
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=failed-upload';</script>";
        }
    
}
if(isset($_POST['edit-ownercredential'])){
    
    $owner_credential_id= $_POST['owner_credential_id'];
    $credential_name= $_POST['credential_name'];
            
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tblownercredential SET credential_name = ? WHERE owner_credential_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ss", $credential_name, $owner_credential_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=failed';</script>";
    }
}
if(isset($_POST['delete-ownercredential'])){
    
    $owner_credential_id= $_POST['owner_credential_id'];         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tblownercredential WHERE owner_credential_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $owner_credential_id);
        if ($qry->execute()){
            
            $old_file_upload = $_POST ['old_file_upload'];
                if ($old_file_upload != 'img-default.jpg'){
                    //delete old file_upload
                    unlink("../uploads/$old_file_upload");
                }
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=failed';</script>";
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
        
        $owner_credential_id= $_POST['owner_credential_id'];
        $file_upload= $newfilename;
        $old_file_upload= $_POST['old_file_upload'];

            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tblownercredential SET file_upload = ? WHERE owner_credential_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $file_upload, $owner_credential_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=success';</script>";
            
                $old_file_upload = $_POST ['old_file_upload'];
                if ($old_file_upload != 'img-default.jpg'){
                    //delete old file_upload
                    unlink("../uploads/$old_file_upload");
                }
        }
        else {
            echo "<script>window.location.href = 'owner-credential.php?owner_id=$owner_id&owner_name=$owner_name&status=failed';</script>";
        }
    }
}

?>