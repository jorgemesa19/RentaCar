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
            <h1>Edit Car</h1>
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
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT car_id, car_name, description, car_model_year, car_brand, color, capacity, plate_number, rate, owner_id, status, proof_of_ownership FROM tblcar WHERE car_id = ?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("s", $_GET['car_id']);
            $qry->execute();
            $qry->bind_result($car_id, $car_name, $description, $car_model_year, $car_brand, $color, $capacity, $plate_number, $rate, $owner_id,   $status, $proof_of_ownership);
            $qry->store_result();
            $qry->fetch();
            ?>
            
            <div class="form-group">
                <label for="car_name">Car Name</label>
                <input type="text" class="form-control form-control-border" id="car_name" name="car_name" value="<?php echo $car_name;?>" placeholder="Car Name" required>
            </div>
                    
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control form-control-border" rows="3" id="description" name="description" value="" placeholder="Description" required><?php echo $description;?></textarea>
            </div>
                    
            <div class="form-group">
                <label for="car_model_year">Model Year</label>
                <input type="text" class="form-control form-control-border" id="car_model_year" name="car_model_year" value="<?php echo $car_model_year;?>" placeholder="Model Year" required>
            </div>
                    
            <div class="form-group">
                <label for="car_brand">Brand</label>
                <input type="text" class="form-control form-control-border" id="car_brand" name="car_brand" value="<?php echo $car_brand;?>" placeholder="Brand" required>
            </div>
                       
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control form-control-border" id="color" name="color" value="<?php echo $color;?>" placeholder="Color" required>
            </div>
                    
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="text" class="form-control form-control-border" id="capacity" name="capacity" value="<?php echo $capacity;?>" placeholder="Capacity" required>
            </div>
                    
            <div class="form-group">
                <label for="plate_number">Plate Number</label>
                <input type="text" class="form-control form-control-border" id="plate_number" name="plate_number" value="<?php echo $plate_number;?>" placeholder="Plate Number" required>
            </div>
                    
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" class="form-control form-control-border" id="rate" name="rate" value="<?php echo $rate;?>" placeholder="Rate" required>
            </div>
                    
            <div class="form-group">
                <label for="owner_id">Owner</label>
                <select class='custom-select form-control-border' name="owner_id">
                    <?php
                    $cn = new mysqli (HOST, USER, PW, DB);
                    $sql="SELECT owner_id, owner_name FROM tblowner WHERE owner_id = ?";
                    $qry=$cn->prepare($sql);
                    $qry->bind_param("s", $owner_id);
                    $qry->execute();
                    $qry->bind_result($owner_id, $owner_name);
                    $qry->store_result();
                    $qry->fetch();
                    echo " <option value='$owner_id'>$owner_name</option>";
                    
                    
                    $cn = new mysqli (HOST, USER, PW, DB);
                    $sql="SELECT owner_id, owner_name FROM tblowner WHERE owner_id <> ?";
                    $qry=$cn->prepare($sql);
                    $qry->bind_param("s", $owner_id);
                    $qry->execute();
                    $qry->bind_result($owner_id, $owner_name);
                    $qry->store_result();
                    while ($qry->fetch()){
                        echo " <option value='$owner_id'>$owner_name</option>";
                    }
                    ?>
                </select>
            </div>
                    
            <div class="form-group">
                <label for="status">Status</label>
                <select class='custom-select form-control-border' name="status">
                    <?php
                    if ($status == 1){
                        echo "<option value='1'>Available</option>
                        <option value='0'>Not Available</option>";
                    } else {
                        echo "
                        <option value='0'>Not Available</option>
                        <option value='1'>Available</option>";
                    }
                    ?>
                    
                </select>
            </div>
        </div>
              <div class="card-footer justify-content-between">
                  <a href="car.php"><button type="button" class="btn btn-default">Close</button></a>
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