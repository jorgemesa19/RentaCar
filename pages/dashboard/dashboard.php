<!DOCTYPE html>
<html lang="en">
<?php include '../header_footer/header.php'; ?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php include '../sidebar_navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Panel administrativo</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <?php
                        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                        $user = "postgres"; // Nombre de usuario de la base de datos
                        $password = "9090"; // Contraseña de la base de datos
                        $dbname = "bd_rentaCar"; // Nombre de la base de datos
                        
                        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

                        if ($conn) {
                            $sql = "SELECT COUNT(car_id) FROM tblcar";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $ct_car_id = $stmt->fetchColumn();
                            echo "<h3>$ct_car_id</h3>";
                        } else {
                            echo "Error al conectar a la base de datos.";
                        }
                        ?>
                        <p>No. de Cars</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-car"></i>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <?php
                        if ($conn) {
                            $sql = "SELECT COUNT(owner_id) FROM tblowner";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $ct_owner_id = $stmt->fetchColumn();
                            echo "<h3>$ct_owner_id</h3>";
                        } else {
                            echo "Error al conectar a la base de datos.";
                        }
                        ?>
                        <p>N. de dueños</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-contacts"></i>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php
                        if ($conn) {
                            $sql = "SELECT COUNT(customer_id) FROM tblcustomer";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $ct_customer_id = $stmt->fetchColumn();
                            echo "<h3>$ct_customer_id</h3>";
                        } else {
                            echo "Error al conectar a la base de datos.";
                        }
                        ?>
                        <p>No. de clientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-contacts"></i>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include '../header_footer/footer.php';  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include '../header_footer/scripts.php'; ?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
