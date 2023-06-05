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
            <h1>Propietarios</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        echo "<script src='../../plugins/jquery/jquery.min.js'></script>";
        include 'add-modal.php';
        include 'function.php'; 
        $add_btn = "";
        if ($_SESSION['user_type'] == "Administrator"){
            $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-owner'><i class='fa fa-plus'></i> Añadir</button>";
        }
        ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <?php echo $add_btn;?>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th class='text-center'>Imagen</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Nro. Contacto</th>
                        <th>Cuenta de FB</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Estado</th>
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
                    if ($_SESSION['user_type'] == "Administrator"){
                        $sql = "SELECT owner_id, owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblowner";
                    }
                    if ($_SESSION['user_type'] == "Owner"){
                        $owner_id = $_SESSION['user_id'];
                        $sql = "SELECT owner_id, owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblowner WHERE owner_id = $owner_id";
                    }
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $row) {
                        $owner_id = $row['owner_id'];
                        $owner_name = $row['owner_name'];
                        $address = $row['address'];
                        $contact = $row['contact'];
                        $profile_image = $row['profile_image'];
                        $fb_account = $row['fb_account'];
                        $username = $row['username'];
                        $password = $row['password'];
                        $account_status = $row['account_status'];

                        $delete_btn = "";
                        if ($_SESSION['user_type'] == "Administrator"){
                            $delete_btn = "<button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-owner-$owner_id'>
                                <i class='nav-icon fas fa-trash'></i> Eliminar
                            </button>";
                        }

                        if ($account_status == 1){
                            $status_text = "<span class='badge badge-success'>Activo</span>";
                        } else {
                            $status_text = "<span class='badge badge-warning'>Inactivo</span>";
                        }
                        echo "<tr>
                            <td class='text-center'>
                                <button class='btn elevation-1 btn-sm btn-success btn-xs' data-toggle='modal' data-target='#edit-owner-$owner_id'>
                                    <i class='nav-icon fas fa-pen'></i> Editar
                                </button> 
                                $delete_btn
                                <a href='../owner-credential/owner-credential.php?owner_id=$owner_id&owner_name=$owner_name'>
                                    <button class='btn elevation-1 btn-sm btn-default btn-xs'>
                                        <i class='nav-icon fas fa-user'></i> Credenciales
                                    </button> 
                                </a>
                            </td>
                            <td class='text-center'>
                                <img src='../uploads/$profile_image' class='img' style='width:100px;' alt='Image'><br>
                                <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-profile_image-$owner_id'><i class='nav-icon fas fa-pen'></i> Editar foto</button>
                            </td>
                            <td>$owner_name</td>
                            <td>$address</td>
                            <td>$contact</td>
                            <td>$fb_account</td>
                            <td>$username</td>
                            <td>$password</td>
                            <td>$status_text</td>
                            </tr>";

                        include 'edit-modal.php';
                        include 'edit-profile_image-modal.php';
                        include 'delete-modal.php';
                    }
                } else {
                    echo "Error en la conexión a la base de datos.";
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
