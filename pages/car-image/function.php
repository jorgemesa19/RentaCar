<?php 
if(isset($_POST['add-carimage'])){
    $temp = explode(".", $_FILES["image"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["image"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $image_id= null;
        $image_description = $_POST['image_description'];
        $image = $newfilename;
        $car_id = $_GET['car_id'];
        
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tblcarimage VALUES (?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssss", $image_id, $image_description, $image, $car_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
        }
        else {
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
        }
    } else {
        echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed-upload';</script>";
    }
     
}
if(isset($_POST['delete-carimage'])){
    
    $image_id= $_POST['image_id'];
         
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="DELETE FROM tblcarimage WHERE image_id=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $image_id);
    if ($qry->execute()){
        $old_image = $_POST ['old_image'];
        if ($old_image != 'img-default.jpg'){
            //delete old image
            unlink("../uploads/$old_image");
        }
        echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
              
    }
    else {
        echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    } 
}

if(isset($_POST['edit-image'])){
    $temp = explode(".", $_FILES["image"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["image"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $image_id= $_POST['image_id'];
        $image= $newfilename;
        $old_image= $_POST['old_image'];

            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tblcarimage SET image = ? WHERE image_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $image, $image_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
            
                $old_image = $_POST ['old_image'];
                if ($old_image != 'img-default.jpg'){
                    //delete old image
                    unlink("../uploads/$old_image");
                }
        }
        else {
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
        }
    }
}
?>