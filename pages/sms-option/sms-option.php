<!DOCTYPE html>
<html lang="en">

<?php
include '../header_footer/header.php';
?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <?php
    include '../sidebar_navbar.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-6">
              <h1>SMS Option</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content ">
        <!-- Default box -->
        <div class="card col-md-12 mx-auto">
          <?php
          include 'add-modal.php';
          include 'function.php';

          $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
          $user = "postgres"; // Nombre de usuario de la base de datos
          $password = "9090"; // Contraseña de la base de datos
          $dbname = "bd_rentaCar"; // Nombre de la base de datos

          $cn = new mysqli($host, $user, $password, $dbname);
          $sql = "SELECT sms_id, api_code, api_password, enabled FROM tbl_sms";
          $qry = $cn->prepare($sql);
          $qry->execute();
          $qry->bind_result($sms_id, $api_code, $api_password, $enabled);
          $qry->store_result();
          $qry->fetch();
          ?>
          <div class="card-body">
            <?php
            if ($qry->num_rows == 0) {
              echo "<div class='alert alert-warning'>
                    <i class='icon fas fa-info'></i>To enable SMS Support please insert API Code and API Password. <a href='#' data-toggle='modal' data-target='#add-api'>Click here to add.</a> If you don't have one, please obtain Trial ApiCode or Buy ApiCode Package and get your personal API Code and API Password <a target='_blank' href='https://itexmo.com/Developers/'>here.</a>
                    </div>";
            } else {
              if ($enabled == 1) {
                $enabled_txt = "<span class='badge bg-green'>Enabled</span>";
              } else {
                $enabled_txt = "<span class='badge bg-yellow'>Disabled</span>";
              }
              echo "
                <div class='alert alert-warning'>
                    <i class='icon fas fa-info'></i>This SMS Support is powered by iTextMo API. <a target='_blank' href='https://itexmo.com/Developers/'>Click here to learn more.</a>
                    </div>
                <table id='#' class='table table-striped'>
                <thead>
                    <tr>
                        <th></th>
                        <th>API Code</th>
                        <th>API Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> <button class='btn btn-flat btn-success btn-xs' data-toggle='modal' data-target='#edit-api'><i class='nav-  icon fas fa-pen'></i></button> 
                        </td>
                        <td>$api_code</td>
                        <td>$api_password</td>
                        <td>$enabled_txt</td>
                        </tr>
                    
                </tbody>
                </table>";
              include 'edit-modal.php';
              include 'delete-modal.php';
            }
            ?>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php

    include '../header_footer/footer.php';
    ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php
  include '../header_footer/scripts.php';
  ?>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>
