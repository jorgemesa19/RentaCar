<?php 
date_default_timezone_set("Asia/Manila");
if(isset($_POST['add-api'])){
    $sms_id= null;
    $api_code= $_POST['api_code'];
    $api_password= $_POST['api_password'];
    $enabled= '1';
        
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $cn = new mysqli($host, $user, $password, $dbname);
    $sql="INSERT INTO tbl_sms VALUES (?,?,?,?)";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssss", $sms_id, $api_code, $api_password, $enabled);
    if ($qry->execute()){
        echo "<script>window.location.href = 'sms-optpion.php?status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'sms-optpion.php?status=failed';</script>";
    }
}
if(isset($_POST['edit-api'])){
    $sms_id= $_POST['sms_id'];
    $api_code= $_POST['api_code'];
    $api_password= $_POST['api_password'];
    $enabled= $_POST['enabled'];
        
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $cn = new mysqli($host, $user, $password, $dbname);
    $sql="UPDATE tbl_sms SET api_code=?, api_password=?, enabled=? WHERE sms_id=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssss", $api_code, $api_password , $enabled, $sms_id);
    if ($qry->execute()){
        echo "<script>window.location.href = 'sms-optpion.php?status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'sms-optpion.php?status=failed';</script>";
    }
}
?>
