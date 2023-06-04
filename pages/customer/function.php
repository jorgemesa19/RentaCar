<?php 
if(isset($_POST['add-customer'])){
    $temp = explode(".", $_FILES["profile_image"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_image"]["name"]);
        $newfilename = $filename.$newfilename;
        
        
        $customer_name = $_POST['customer_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $profile_image = $newfilename;
        $fb_account = $_POST['fb_account'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $admin_id = $_SESSION['user_id'];
        $account_status = $_POST['account_status'];
        
        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

        $sql = "INSERT INTO tblcustomer (customer_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $customer_name);
        $stmt->bindParam(2, $address);
        $stmt->bindParam(3, $contact);
        $stmt->bindParam(4, $profile_image);
        $stmt->bindParam(5, $fb_account);
        $stmt->bindParam(6, $username);
        $stmt->bindParam(7, $password);
        $stmt->bindParam(8, $admin_id);
        $stmt->bindParam(9, $account_status);
        
        if ($stmt->execute()){
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
    
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $fb_account = $_POST['fb_account'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_status = $_POST['account_status'];
            
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "UPDATE tblcustomer SET customer_name = ?, address = ?, contact = ?, fb_account = ?, username = ?, password = ?, account_status = ? WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $customer_name);
    $stmt->bindParam(2, $address);
    $stmt->bindParam(3, $contact);
    $stmt->bindParam(4, $fb_account);
    $stmt->bindParam(5, $username);
    $stmt->bindParam(6, $password);
    $stmt->bindParam(7, $account_status);
    $stmt->bindParam(8, $customer_id);
    
    if ($stmt->execute()){
        echo "<script>window.location.href = 'customer.php?status=success';</script>";  
    }
    else {
        echo "<script>window.location.href = 'customer.php?status=failed';</script>";
    }
}

if(isset($_POST['delete-customer'])){
    
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['name'];

    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "DELETE FROM tblcustomer WHERE customer_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $customer_id);
    
    if ($stmt->execute()){
        $old_profile_image = $_POST['old_profile_image'];
        if ($old_profile_image != 'img-default.jpg'){
            //delete old profile_image
            unlink("../uploads/$old_profile_image");
        }
        
        $sql = "DELETE FROM tblcustomercredential WHERE customer_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $customer_id);
        $stmt->execute();
        
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
        
        $customer_id = $_POST['customer_id'];
        $profile_image = $newfilename;
        $old_profile_image = $_POST['old_profile_image'];

        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

        $sql = "UPDATE tblcustomer SET profile_image = ? WHERE customer_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $profile_image);
        $stmt->bindParam(2, $customer_id);
        
        if ($stmt->execute()){
            echo "<script>window.location.href = 'customer.php?status=success';</script>";
            
            $old_profile_image = $_POST['old_profile_image'];
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
