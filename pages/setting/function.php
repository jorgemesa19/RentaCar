<?php 
if(isset($_POST['update-about'])){
    $setting_id= $_POST['setting_id'];
    $app_name= $_POST['app_name'];
    $address= $_POST['address'];
    $contact= $_POST['contact'];
    $about= $_POST['about'];
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_setting SET app_name = ?,  about = ?, contact = ?, address = ? WHERE setting_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssss", $app_name, $about, $contact, $address, $setting_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'setting.php?status=success';</script>";
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> updated about.";
        include '../activity-log/activity-log-function.php';
    }
    else {
        echo "<script>window.location.href = 'setting.php?status=failed';</script>";
    }
}
if(isset($_POST['edit-logo'])){
    $temp = explode(".", $_FILES["logo"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["logo"]["name"]);
    
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["logo"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $setting_id= $_POST['setting_id'];
        $logo= $newfilename;
        $old_logo= $_POST['old_logo'];
            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_setting SET logo = ? WHERE setting_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $logo, $setting_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'setting.php?status=success';</script>";
            
            $old_logo = $_POST ['old_logo'];
            unlink("../uploads/$old_logo");
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> updated about logo.";
            include '../activity-log/activity-log-function.php';
        }
        else {
            echo "<script>window.location.href = 'setting.php?status=failed';</script>";
        }
    }
}
if(isset($_POST['edit-login_image'])){
    $temp = explode(".", $_FILES["login_image"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["login_image"]["name"]);
    
    if (move_uploaded_file($_FILES["login_image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["login_image"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $setting_id= $_POST['setting_id'];
        $login_image= $newfilename;
        $old_login_image= $_POST['old_login_image'];
            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_setting SET login_image = ? WHERE setting_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $login_image, $setting_id);
        if ($qry->execute()){
//            echo "<script>window.location.href = 'setting.php?status=success';</script>";
            
            $old_login_image = $_POST ['old_login_image'];
            unlink("../uploads/$old_login_image");
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> updated background image.";
            include '../activity-log/activity-log-function.php';
        }
        else {
            echo "<script>window.location.href = 'setting.php?status=failed';</script>";
        }
    }
}
?>