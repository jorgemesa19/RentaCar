<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:../login/login.php");
}
date_default_timezone_set("Asia/Manila");

// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

if ($_SESSION['user_type'] == "Administrator") {
    $sql = "SELECT admin_id, name, contact, address, username, password FROM tbladmin WHERE admin_id = ?";
    $qry = $conn->prepare($sql);
    $qry->bindParam(1, $_SESSION['user_id']);
    $qry->execute();
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    $admin_id = $row['admin_id'];
    $name = $row['name'];
    $contact = $row['contact'];
    $address = $row['address'];
    $username = $row['username'];
    $password = $row['password'];
    $user_full_name = "$name";
    $profile_image = "img-default.jpg";
}

if ($_SESSION['user_type'] == "Owner") {
    $sql = "SELECT owner_id, owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblowner WHERE owner_id = ?";
    $qry = $conn->prepare($sql);
    $qry->bindParam(1, $_SESSION['user_id']);
    $qry->execute();
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    $owner_id = $row['owner_id'];
    $owner_name = $row['owner_name'];
    $address = $row['address'];
    $contact = $row['contact'];
    $profile_image = $row['profile_image'];
    $fb_account = $row['fb_account'];
    $username = $row['username'];
    $password = $row['password'];
    $admin_id = $row['admin_id'];
    $account_status = $row['account_status'];
    $user_full_name = "$owner_name";
}

if ($_SESSION['user_type'] == "Customer") {
    $sql = "SELECT customer_id, customer_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblcustomer WHERE customer_id = ?";
    $qry = $conn->prepare($sql);
    $qry->bindParam(1, $_SESSION['user_id']);
    $qry->execute();
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    $customer_id = $row['customer_id'];
    $customer_name = $row['customer_name'];
    $address = $row['address'];
    $contact = $row['contact'];
    $profile_image = $row['profile_image'];
    $fb_account = $row['fb_account'];
    $username = $row['username'];
    $password = $row['password'];
    $admin_id = $row['admin_id'];
    $account_status = $row['account_status'];
    $user_full_name = "$customer_name";
}

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEMA DE RENTA DE VEHICULOS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">

  <!-- Summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DropzoneJS -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- FullCalendar -->
  <link rel="stylesheet" href="../../plugins/fullcalendar/main.css">

</head>
