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
            <h1>Vehiculos</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        include 'add-modal.php';
        include 'function.php'; 
        
        $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-car'><i class='fa fa-plus'></i> Añadir</button>";
        if ($_SESSION['user_type'] == "Customer"){
            $add_btn = "";
        }
        ?>
        
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <?php echo $add_btn;?>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm" style="table-layout: fixed; max-width:100%; text-align: center; vertical-align: middle;">
                <thead>
                  <tr>
                      <th></th>
                      <th style="text-align: center; vertical-align: middle;">Nombre del vehiculo</th>
                      <th style="text-align: center; vertical-align: middle;">Descripción</th>
                      <th style="text-align: center; vertical-align: middle;">Modelo</th>
                      <th style="text-align: center; vertical-align: middle;">Marca</th>
                      <th style="text-align: center; vertical-align: middle;">Color</th>
                      <th style="text-align: center; vertical-align: middle;">Capacidad</th>
                      <th style="text-align: center; vertical-align: middle;">Nro. de placa</th>
                      <th style="text-align: center; vertical-align: middle;">Calificación</th>
                      <th style="text-align: center; vertical-align: middle;">Propietario</th>
                      <th style="text-align: center; vertical-align: middle;">Estado</th>
                      <th style="text-align: center; vertical-align: middle;">Prueba de propiedad</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                $user = "postgres"; // Nombre de usuario de la base de datos
                $password = "9090"; // Contraseña de la base de datos
                $dbname = "bd_rentaCar"; // Nombre de la base de datos

                $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

                if ($_SESSION['user_type'] == "Administrator"){
                    $sql="SELECT car.car_id, car.car_name, car.description, car.car_model_year, car.car_brand, car.color, car.capacity, car.plate_number, car.rate, car.owner_id, car.status, car.proof_of_ownership, owner.owner_name 
                    FROM tblcar AS car
                    INNER JOIN tblowner AS owner
                    ON car.owner_id = owner.owner_id
                    LIMIT 100"; // LIMITAR LOS DATOS QUE CARGARÁ EL APARTADO DE AUTOS YA QUE CON TODOS NO PUEDE, SE BLOQUE LA PÁG
                }
                if ($_SESSION['user_type'] == "Owner"){
                    $owner_id = $_SESSION['user_id'];
                    $sql="SELECT car.car_id, car.car_name, car.description, car.car_model_year, car.car_brand, car.color, car.capacity, car.plate_number, car.rate, car.owner_id, car.status, car.proof_of_ownership, owner.owner_name 
                    FROM tblcar AS car
                    INNER JOIN tblowner AS owner
                    ON car.owner_id = owner.owner_id
                    WHERE owner.owner_id = $owner_id
                    LIMIT 100"; // LIMITAR LOS DATOS QUE CARGARÁ EL APARTADO DE AUTOS YA QUE CON TODOS NO PUEDE, SE BLOQUE LA PÁG";
                }
                if ($_SESSION['user_type'] == "Customer"){
                    $sql="SELECT car.car_id, car.car_name, car.description, car.car_model_year, car.car_brand, car.color, car.capacity, car.plate_number, car.rate, car.owner_id, car.status, car.proof_of_ownership, owner.owner_name 
                    FROM tblcar AS car
                    INNER JOIN tblowner AS owner
                    ON car.owner_id = owner.owner_id
                    LIMIT 100"; // LIMITAR LOS DATOS QUE CARGARÁ EL APARTADO DE AUTOS YA QUE CON TODOS NO PUEDE, SE BLOQUE LA PÁG";
                }
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    $car_id = $row['car_id'];
                    $car_name = $row['car_name'];
                    $description = $row['description'];
                    $car_model_year = $row['car_model_year'];
                    $car_brand = $row['car_brand'];
                    $color = $row['color'];
                    $capacity = $row['capacity'];
                    $plate_number = $row['plate_number'];
                    $rate = $row['rate'];
                    $owner_id = $row['owner_id'];
                    $status = $row['status'];
                    $proof_of_ownership = $row['proof_of_ownership'];
                    $owner_name = $row['owner_name'];

                    if ($_SESSION['user_type'] == "Administrator"){
                         $action_btns = "
                            <a href='edit-car.php?car_id=$car_id'>
                                    <button class='btn elevation-1 btn-success btn-xs' style='width:80px;>
                                        <i class='nav-icon fas fa-pen'></i> Editar
                                    </button> 
                                </a>
                                <button class='btn elevation-1 btn-danger btn-xs' data-toggle='modal' data-target='#delete-car-$car_id' style='width:80px;>
                                <i class='nav-icon fas fa-trash'></i> Eliminar
                            </button>";
                        
                    }
                    if ($_SESSION['user_type'] == "Owner"){
                        $action_btns = "
                            <a href='edit-car.php?car_id=$car_id'>
                                    <button class='btn elevation-1 btn-success btn-xs' style='width:80px;>
                                        <i class='nav-icon fas fa-pen'></i> Editar
                                    </button> 
                                </a>
                                <button class='btn elevation-1 btn-danger btn-xs' data-toggle='modal' data-target='#delete-car-$car_id' style='width:80px;>
                                <i class='nav-icon fas fa-trash'></i> Eliminar
                            </button>";
                    }
                    if ($_SESSION['user_type'] == "Customer"){
                        $action_btns = "";
                    }
    
                    if ($status == 1){
                        $status_text = "<span class='badge badge-success'>Disponible</span>";
                    } else {
                        $status_text = "<span class='badge badge-warning'>No disponible</span>";
                    }
                    echo "<tr>
                        <td class='text-center'>
                        $action_btns
                        <a href='../car-image/car-image.php?car_id=$car_id&car_name=$car_name'>
                            <button class='btn elevation-1 btn-default btn-xs' style='width:80px;'>
                                <i class='nav-icon fas fa-eye'></i> Imágenes
                            </button> 
                        </a>
                        <a href='../car-review/car-review.php?car_id=$car_id&car_name=$car_name'>
                            <button class='btn elevation-1 btn-default btn-xs style='width:80px;'>
                                <i class='nav-icon fas fa-eye'></i> Revisiones
                            </button> 
                        </a>
                        </td>
                        <td>$car_name</td>
                        <td>$description</td>
                        <td>$car_model_year</td>
                        <td>$car_brand</td>
                        <td>$color</td>
                        <td>$capacity</td>
                        <td>$plate_number</td>
                        <td>$rate</td>
                        <td>$owner_name</td>
                        <td>$status_text</td>
                        <td class='text-center'>
                            <img src='../uploads/$proof_of_ownership' class='img' style='width:100px;' alt='Image'><br>
                            <button class='btn btn-sm elevation-1 btn-default btn-xs' data-toggle='modal' data-target='#view-proof_of_ownership-$car_id'><i class='nav-icon fas fa-eye'></i> Ver imagen</button>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-proof_of_ownership-$car_id'><i class='nav-icon fas fa-pen'></i> Editar imagen</button>
                        </td>
                        </tr>";
                    
                    include 'edit-proof_of_ownership-modal.php';
                    include 'view-proof_of_ownership-modal.php';
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
      "responsive": false,
        "scrollX": true
    });
  });
</script>
</body>
</html>
