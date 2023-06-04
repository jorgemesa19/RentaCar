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
            <h1>Administrator</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        echo "<script src='../../plugins/jquery/jquery.min.js'></script>";
        include 'add-modal.php';
        include 'function.php'; ?>
        
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-info" data-toggle="modal" data-target="#add-admin"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                $user = "postgres"; // Nombre de usuario de la base de datos
                $password = "9090"; // Contraseña de la base de datos
                $dbname = "bd_rentaCar"; // Nombre de la base de datos

                $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

                if ($conn) {
                    $sql = "SELECT admin_id, name, contact, address, username, password FROM tbladmin";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $row) {
                        $admin_id = $row['admin_id'];
                        $name = $row['name'];
                        $contact = $row['contact'];
                        $address = $row['address'];
                        $username = $row['username'];
                        $password = $row['password'];

                        echo "<tr>
                            <td class='text-center'>
                                <button class='btn elevation-1 btn-sm btn-success btn-xs' data-toggle='modal' data-target='#edit-admin-$admin_id'>
                                    <i class='nav-icon fas fa-pen'></i>
                                </button> 
                                <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-admin-$admin_id'>
                                    <i class='nav-icon fas fa-trash'></i>
                                </button>
                            </td>
                            <td>$name</td>
                            <td>$contact</td>
                            <td>$address</td>
                            <td>$username</td>
                            <td>$password</td>
                            </tr>";

                        include 'edit-modal.php';
                        include 'delete-modal.php';
                    }
                } else {
                    echo "Error al conectar a la base de datos.";
                }
                ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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

<?php include '../header_footer/scripts.php';  ?>
<script>
  $(function () {
    $('#table1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
