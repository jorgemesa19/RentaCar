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
            <h1>Imagenes del carro <b><?php echo $_GET['car_name'];?></b></h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        include 'add-modal.php';
        include 'function.php'; 
        $car_id = $_GET['car_id'];
        $car_name = $_GET['car_name'];
        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);


        $sql="SELECT image_id, image_description, image, car_id FROM tblcarimage WHERE car_id = ?";
        $qry=$conn->prepare($sql);
        $qry->bindParam(1, $car_id); // Corregimos el enlace del parámetro
        $qry->execute();
        $result = $qry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $image_id = $row['image_id'];
            $image_description = $row['image_description'];
            $image = $row['image'];
            $current_car_id = $row['car_id']; // Utilizamos una variable diferente para almacenar el valor del parámetro
          }

        if ($_SESSION['user_type'] == "Administrator" || $_SESSION['user_type'] == "Owner"){
            $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-carimage'><i class='fa fa-plus'></i> Añadir</button>";
        } else {
            $add_btn = "";
        }
        ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <a href="../car/car.php">
                <button class="btn btn-default">Volver</button>
            </a>
            <?php echo $add_btn;?>
        </div>
        <div class="card-body">
            <div class='row'>
            <?php
                foreach ($result as $row) {
                    $image_id = $row['image_id'];
                    $image_description = $row['image_description'];
                    $image = $row['image'];
                    $current_car_id = $row['car_id'];

                    echo "<div class='col-md-3'>
                            <img class='img-fluid mb-3 elevation-1 img-bordered-sm' src='../uploads/$image' alt='Photo'>
                            <p>$image_description</p>
                            <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-carimage-$image_id'>
                                <i class='nav-icon fas fa-trash'></i>
                            </button>
                        </div>";

                    include 'delete-modal.php';
                }

            ?>
            </div>
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
