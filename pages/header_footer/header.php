<?php
 session_start();
 if (!isset($_SESSION['user_id'])){
     header("location:../login/login.php");
 }
date_default_timezone_set("Asia/Manila");

require_once '../database_config/config.php';

if ($_SESSION['user_type'] == "Administrator"){
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT admin_id, name, contact, address, username, password FROM tbladmin WHERE admin_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $_SESSION['user_id']);
    $qry->execute();
    $qry->bind_result($admin_id, $name, $contact, $address, $username, $password);
    $qry->store_result();
    $qry->fetch();
    $user_full_name = "$name";
    $profile_image = "img-default.jpg";
}
if ($_SESSION['user_type'] == "Owner"){
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT owner_id, owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblowner WHERE owner_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $_SESSION['user_id']);
    $qry->execute();
    $qry->bind_result($owner_id, $owner_name, $address, $contact, $profile_image, $fb_account, $username, $password, $admin_id, $account_status);
    $qry->store_result();
    $qry->fetch();
    $user_full_name = "$owner_name";
}
if ($_SESSION['user_type'] == "Customer"){
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT customer_id, customer_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblcustomer WHERE customer_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $_SESSION['user_id']);
    $qry->execute();
    $qry->bind_result($customer_id, $customer_name, $address, $contact, $profile_image, $fb_account, $username, $password, $admin_id, $account_status);
    $qry->store_result();
    $qry->fetch();
    $user_full_name = "$customer_name";
}

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car Rental System</title>

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
    
    <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
    
 
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- fullCalendar -->
  <link rel="stylesheet" href="../../plugins/fullcalendar/main.css">
    
</head>