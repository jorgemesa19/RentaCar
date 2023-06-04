<?php 
if(isset($_POST['add-admin'])){
    
    $admin_id= null;
    $name= $_POST['name'];
    $contact= $_POST['contact'];
    $address= $_POST['address'];
    $username= $_POST['username'];
    $password= $_POST['password'];
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="INSERT INTO tbladmin VALUES (?,?,?,?,?,?)";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssssss", $admin_id, $name, $contact, $address, $username, $password);
    if ($qry->execute()){
        echo "<script>window.location.href = 'admin.php?status=success';</script>";
        
        
        
        
    }
    else {
        echo "<script>window.location.href = 'admin.php?status=failed';</script>";
    } 
    
}
if(isset($_POST['edit-admin'])){
    
    $admin_id= $_POST['admin_id'];
    $name= $_POST['name'];
    $contact= $_POST['contact'];
    $address= $_POST['address'];
    $username= $_POST['username'];
    $password= $_POST['password'];
            
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbladmin SET name = ?, contact = ?, address = ?, username = ?, password = ? WHERE admin_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssssss", $name, $contact, $address, $username, $password, $admin_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'admin.php?status=success';</script>";
        
        
        
        $activity = "<b>$user_full_name</b> edited <b>$name</b>.";
        
    }
    else {
        echo "<script>window.location.href = 'admin.php?status=failed';</script>";
    }
}
if(isset($_POST['delete-admin'])){
    
    $admin_id= $_POST['admin_id'];
    $name= $_POST['name'];

         
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tbladmin WHERE admin_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $admin_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'admin.php?status=success';</script>";
            
            
            $activity = "<b>$user_full_name</b> deleted <b>$name</b>.";
            
        }
        else {
            echo "<script>window.location.href = 'admin.php?status=failed';</script>";
        } 
    
    
}
?>