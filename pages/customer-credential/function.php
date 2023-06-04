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

        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

        $sql="INSERT INTO tblcustomercredential VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $credential_id);
        $stmt->bindParam(2, $credential_name);
        $stmt->bindParam(3, $file_upload);
        $stmt->bindParam(4, $customer_id);
        if ($stmt->execute()){
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
            
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    
    $sql="UPDATE tblcustomercredential SET credential_name = ? WHERE credential_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $credential_name);
    $stmt->bindParam(2, $credential_id);
    if ($stmt->execute()){
        echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'customer-credential.php?customer_id=$customer_id&customer_name=$customer_name&status=failed';</script>";
    }
}
if(isset($_POST['delete-customercredential'])){
    
    $credential_id= $_POST['credential_id'];         
    
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    
    $sql="DELETE FROM tblcustomercredential WHERE credential_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $credential_id);
    if ($stmt->execute()){
        
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

        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        
        $sql="UPDATE tblcustomercredential SET file_upload = ? WHERE credential_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $file_upload);
        $stmt->bindParam(2, $credential_id);
        if ($stmt->execute()){
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
