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
            <h1>Simple CRUD</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        include 'function.php'; 
        include '../sms-option/check-sms.php'; 
        ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-info" data-toggle="modal" data-target="#add-simple_crud"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>CRUD ID</th>
                        <th>Text</th>
                        <th>Textarea</th>
                        <th>Dropdown</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                $user = "postgres"; // Nombre de usuario de la base de datos
                $password = "9090"; // Contraseña de la base de datos
                $dbname = "bd_rentaCar"; // Nombre de la base de datos

                // Establecer la conexión
                $cn = new mysqli($host, $user, $password, $dbname);

                $sql = "SELECT s_crud_id, text, text_area, dropdown FROM tbl_simple_crud";
                $qry = $cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($s_crud_id, $text, $text_area, $dropdown);
                $qry->store_result();
                while ($qry->fetch()) {
                    echo "<tr>
                        <td class='text-center'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs' data-toggle='modal' data-target='#edit-simple_crud-$s_crud_id'>
                                <i class='nav-icon fas fa-pen'></i>
                            </button> 
                            <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-simple_crud-$s_crud_id'>
                                <i class='nav-icon fas fa-trash'></i>
                            </button>
                        </td>
                        <td>$s_crud_id</td>
                        <td>$text</td>
                        <td>$text_area</td>
                        <td>$dropdown</td>
                        </tr>";
                    
                    include 'edit-modal.php';
                    include 'delete-modal.php';
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

<?php include '../header_footer/scripts.php'; 
        include 'add-modal.php'; ?>
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
