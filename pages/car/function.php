<?php 
if(isset($_POST['add-car'])){
    $temp = explode(".", $_FILES["proof_of_ownership"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["proof_of_ownership"]["name"]);
    
    if (move_uploaded_file($_FILES["proof_of_ownership"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["proof_of_ownership"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $car_id= null;
        $car_name = $_POST['car_name'];
        $description = $_POST['description'];
        $car_model_year = $_POST['car_model_year'];
        $car_brand = $_POST['car_brand'];
        $color = $_POST['color'];
        $capacity = $_POST['capacity'];
        $plate_number = $_POST['plate_number'];
        $rate = $_POST['rate'];
        $owner_id = $_POST['owner_id'];
        $status = $_POST['status'];
        $proof_of_ownership = $newfilename;

        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tblcar VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssssssssss", $car_id, $car_name, $description, $car_model_year, $car_brand, $color, $capacity, $plate_number, $rate, $owner_id, $status, $proof_of_ownership);
        if ($qry->execute()){
            echo "<script>window.location.href = 'car.php?status=success';</script>";
        } else {
            echo "<script>window.location.href = 'car.php?status=failed';</script>";
        } 
    } else {
        echo "<script>window.location.href = 'car.php?status=faile-upload';</script>";
    }
}
if(isset($_POST['edit-car'])){
    
    $car_id= $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $description = $_POST['description'];
    $car_model_year = $_POST['car_model_year'];
    $car_brand = $_POST['car_brand'];
    $color = $_POST['color'];
    $capacity = $_POST['capacity'];
    $plate_number = $_POST['plate_number'];
    $rate = $_POST['rate'];
    $owner_id = $_POST['owner_id'];
    $status = $_POST['status'];
    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tblcar SET car_name = ?, description = ?, car_model_year = ?, car_brand = ?, color = ?, capacity = ?, plate_number = ?, rate = ?, owner_id = ?, status = ?  WHERE car_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssssssssss", $car_name, $description, $car_model_year, $car_brand, $color, $capacity, $plate_number, $rate, $owner_id, $status, $car_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'car.php?status=success';</script>";
        
    }
    else {
        echo "<script>window.location.href = 'car.php?status=failed';</script>";
    }
}
if(isset($_POST['delete-car'])){
    
    $car_id= $_POST['car_id'];
    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT image FROM tblcarimage WHERE car_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $car_id);
    $qry->execute();
    $qry->bind_result($image);
    $qry->store_result();
    while ($qry->fetch()){
        unlink("../uploads/$image");
    }
    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="DELETE FROM tblcar WHERE car_id=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $car_id);
    if ($qry->execute()){
        $old_proof_of_ownership = $_POST ['old_proof_of_ownership'];
        if ($old_proof_of_ownership != 'img-default.jpg'){
            //delete old proof_of_ownership
            unlink("../uploads/$old_proof_of_ownership");
        }
            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tblcarimage WHERE car_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $car_id);
        if ($qry->execute()){
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="DELETE FROM tblcarreview WHERE car_id=?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("s", $car_id);
            $qry->execute();
            
            echo "<script>window.location.href = 'car.php?status=success';</script>";
        } else {
        echo "<script>window.location.href = 'car.php?status=failed';</script>";
        } 
    }
    else {
        echo "<script>window.location.href = 'car.php?status=failed';</script>";
    } 
}

if(isset($_POST['edit-proof_of_ownership'])){
    $temp = explode(".", $_FILES["proof_of_ownership"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["proof_of_ownership"]["name"]);
    
    if (move_uploaded_file($_FILES["proof_of_ownership"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["proof_of_ownership"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $car_id= $_POST['car_id'];
        $proof_of_ownership= $newfilename;
        $old_proof_of_ownership= $_POST['old_proof_of_ownership'];

            
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tblcar SET proof_of_ownership = ? WHERE car_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $proof_of_ownership, $car_id);
        if ($qry->execute()){
            echo "<script>window.location.href = 'car.php?status=success';</script>";
            
                $old_proof_of_ownership = $_POST ['old_proof_of_ownership'];
                if ($old_proof_of_ownership != 'img-default.jpg'){
                    //delete old proof_of_ownership
                    unlink("../uploads/$old_proof_of_ownership");
                }
        }
        else {
            echo "<script>window.location.href = 'car.php?status=failed';</script>";
        }
    }
}
?>