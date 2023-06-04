<?php
require_once '../database&config/config.php';
$cn = new mysqli (HOST, USER, PW, DB);
$sql="SELECT enabled FROM tbl_email_option";
$qry=$cn->prepare($sql);
$qry->execute();
$qry->bind_result($enabled);
$qry->store_result();
$qry->fetch();

if ($enabled != 1){
//    echo "<div class='alert alert-info alert-dismissible'>
//                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
//                  <i class='icon fas fa-info'></i> EMAIL Supportication is <b>DISABLED</b>. Please contact your administrator.
//                </div>";
    echo "<script>
            $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
            });

            $(document).ready(function(){
            Toast.fire({
            icon: 'warning',
            title: ' EMAIL Support is DISABLED. The system cannot send EMAIL code for registration. Please contact your administrator.'
            })
            });

            });
            </script>";
}
?>