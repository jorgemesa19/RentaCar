<?php  
if(isset($_POST['add-user'])){
    $temp = explode(".", $_FILES["profile_picture"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_picture"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $user_id= null;
        $firstname= $_POST['firstname'];
        $middlename= $_POST['middlename'];
        $lastname= $_POST['lastname'];
        $contact= $_POST['contact'];
        $email= $_POST['email'];
        $address= $_POST['address'];
        $username= $_POST['username'];
        $password= $_POST['password'];
        $password= md5($password);
        $profile_picture= $newfilename;
        $status= $_POST['status'];
        
        
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_user VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("sssssssssss", $user_id, $firstname, $middlename, $lastname, $contact, $email, $address, $username, $password, $profile_picture, $status);
        if ($qry->execute()){
            echo "<script>window.location.href = 'user.php?status=success';</script>";
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added user <b>$first_name $middle_name $last_name</b>.";
            include '../activity-log/activity-log-function.php';
        }
        else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        }
    }
    else {
        echo "<script>window.location.href = 'user.php?status=failed';</script>";
    }
}
if(isset($_POST['edit-user'])){
    $user_id= $_POST['user_id'];
    $lastname= $_POST['lastname'];
    $firstname= $_POST['firstname'];
    $middlename= $_POST['middlename'];
    $contact= $_POST['contact'];
    $email= $_POST['email'];
    $address= $_POST['address'];
    $username= $_POST['username'];
    $status= $_POST['status'];
    
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_user SET lastname = ?, firstname = ?, middlename = ?, contact = ?, email = ?, address = ?, username = ?, status = ? WHERE user_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssssssss", $lastname, $firstname, $middlename, $contact, $email, $address, $username, $status, $user_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'user.php?status=success';</script>";
        
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited user <b>$firstname $middlename $lastname</b>.";
        include '../activity-log/activity-log-function.php';
    }
    else {
        echo "<script>window.location.href = 'user.php?status=failed';</script>";
    }
}
if(isset($_POST['delete-user'])){
    $user_id= $_POST['user_id'];
    
         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tbl_user WHERE user_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $user_id);
        if ($qry->execute()){
           echo "<script>window.location.href = 'user.php?status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        } 
    
    
}
if(isset($_POST['edit-profile_picture'])){
    $temp = explode(".", $_FILES["profile_picture"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_picture"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $user_id= $_POST['user_id'];
        $profile_picture= $newfilename;
        $old_profile_picture= $_POST['old_profile_picture'];

            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_user SET profile_picture = ? WHERE user_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $profile_picture, $user_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'user.php?status=success';</script>";
            
                $old_profile_picture = $_POST ['old_profile_picture'];
                if ($old_profile_picture != 'img-default.jpg'){
                    //delete old profile_picture
                    unlink("../uploads/$old_profile_picture");
                }
        }
        else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        }
    }
}
if(isset($_POST['edit-password'])){
    $user_id= $_POST['user_id'];
    $password= $_POST['password'];
    $password= md5($password);
    
     
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_user SET password = ? WHERE user_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $password, $user_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'user.php?status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        } 
}
?>