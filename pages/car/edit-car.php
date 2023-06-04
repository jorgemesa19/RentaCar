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
            <h1>Editar carro</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        include 'function.php'; ?>
        
      <!-- Default box -->
      <div class="card">
          <form method="post">
              <div class="card-body">
            <?php
            $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
            $user = "postgres"; // Nombre de usuario de la base de datos
            $password = "9090"; // Contraseña de la base de datos
            $dbname = "bd_rentaCar"; // Nombre de la base de datos

            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $car_id = $_GET['car_id'];
            $sql = "SELECT car_id, car_name, description, car_model_year, car_brand, color, capacity, plate_number, rate, owner_id, status, proof_of_ownership FROM tblcar WHERE car_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$car_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            ?>
            
            <div class="form-group">
                <label for="car_name">Nombre del carro</label>
                <input type="text" class="form-control form-control-border" id="car_name" name="car_name" value="<?php echo $car_name;?>" placeholder="Nombre del carro" required>
            </div>
                    
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control form-control-border" rows="3" id="description" name="description" value="" placeholder="Descripción" required><?php echo $description;?></textarea>
            </div>
                    
            <div class="form-group">
                <label for="car_model_year"> Año del vehiculo</label>
                <input type="text" class="form-control form-control-border" id="car_model_year" name="car_model_year" value="<?php echo $car_model_year;?>" placeholder="Modelo" required>
            </div>
                    
            <div class="form-group">
                <label for="car_brand">Marca</label>
                <input type="text" class="form-control form-control-border" id="car_brand" name="car_brand" value="<?php echo $car_brand;?>" placeholder="Marca" required>
            </div>
                       
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control form-control-border" id="color" name="color" value="<?php echo $color;?>" placeholder="Color" required>
            </div>
                    
            <div class="form-group">
                <label for="capacity">Capacidad</label>
                <input type="text" class="form-control form-control-border" id="capacity" name="capacity" value="<?php echo $capacity;?>" placeholder="Capacidad" required>
            </div>
                    
            <div class="form-group">
                <label for="plate_number">Placa del vehiculo</label>
                <input type="text" class="form-control form-control-border" id="plate_number" name="plate_number" value="<?php echo $plate_number;?>" placeholder="Número de placa" required>
            </div>
                    
            <div class="form-group">
                <label for="rate">Calificacion</label>
                <input type="text" class="form-control form-control-border" id="rate" name="rate" value="<?php echo $rate;?>" placeholder="Calificacion" required>
            </div>
                    
            <div class="form-group">
                <label for="owner_id">Dueño</label>
                <select class='custom-select form-control-border' name="owner_id">
                    <?php
                    $stmt = $conn->prepare("SELECT owner_id, owner_name FROM tblowner WHERE owner_id = ?");
                    $stmt->execute([$owner_id]);
                    $owner = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<option value='$owner[owner_id]'>$owner[owner_name]</option>";
                    
                    $stmt = $conn->prepare("SELECT owner_id, owner_name FROM tblowner WHERE owner_id <> ?");
                    $stmt->execute([$owner_id]);
                    $owners = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($owners as $owner) {
                        echo "<option value='$owner[owner_id]'>$owner[owner_name]</option>";
                    }
                    ?>
                </select>
            </div>
                    
            <div class="form-group">
                <label for="status">Estado</label>
                <select class='custom-select form-control-border' name="status">
                    <?php
                    if ($status == 1){
                        echo "<option value='1'>Disponible</option>
                        <option value='0'>No disponible</option>";
                    } else {
                        echo "
                        <option value='0'>No disponible</option>
                        <option value='1'>DIsponible</option>";
                    }
                    ?>
                    
                </select>
            </div>
        </div>
              <div class="card-footer justify-content-between">
                  <a href="car.php"><button type="button" class="btn btn-default">Cerrar</button></a>
                    <input type="text" name="car_id" value="<?php echo $car_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-car_btn" name="edit-car" value="Save">
                </div>
          </form>
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
