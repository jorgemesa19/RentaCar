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
            <h1>Cars</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        include 'add-modal.php';
        include 'function.php'; 
        
        $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-car'><i class='fa fa-plus'></i> Add</button>";
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
            <table id="table1" class="table table-hover table-sm" style="table-layout: fixed; width:105%;">
                <thead>
                    <tr>
                        <th></th>
                        <th>Car Name</th>
                        <th>Description</th>
                        <th>Model Year</th>
                        <th>Brand</th>
                        <th>Color</th>
                        <th>Capacity</th>
                        <th>Plate Number</th>
                        <th>Rate</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th>Proof of Ownership</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $cn = new mysqli (HOST, USER, PW, DB);
                if ($_SESSION['user_type'] == "Administrator"){
                    $sql="SELECT car.car_id, car.car_name, car.description, car.car_model_year, car.car_brand, car.color, car.capacity, car.plate_number, car.rate, car.owner_id, car.status, car.proof_of_ownership, owner.owner_name 
                    FROM tblcar AS car
                    INNER JOIN tblowner AS owner
                    ON car.owner_id = owner.owner_id";
                }
                if ($_SESSION['user_type'] == "Owner"){
                    $owner_id = $_SESSION['user_id'];
                    $sql="SELECT car.car_id, car.car_name, car.description, car.car_model_year, car.car_brand, car.color, car.capacity, car.plate_number, car.rate, car.owner_id, car.status, car.proof_of_ownership, owner.owner_name 
                    FROM tblcar AS car
                    INNER JOIN tblowner AS owner
                    ON car.owner_id = owner.owner_id
                    WHERE owner.owner_id = $owner_id";
                }
                if ($_SESSION['user_type'] == "Customer"){
                    $sql="SELECT car.car_id, car.car_name, car.description, car.car_model_year, car.car_brand, car.color, car.capacity, car.plate_number, car.rate, car.owner_id, car.status, car.proof_of_ownership, owner.owner_name 
                    FROM tblcar AS car
                    INNER JOIN tblowner AS owner
                    ON car.owner_id = owner.owner_id";
                }
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($car_id, $car_name, $description, $car_model_year, $car_brand, $color, $capacity, $plate_number, $rate, $owner_id, $status, $proof_of_ownership, $owner_name);
                $qry->store_result();
                while ($qry->fetch()){
                    if ($_SESSION['user_type'] == "Administrator"){
                         $action_btns = "
                            <a href='edit-car.php?car_id=$car_id'>
                                    <button class='btn elevation-1 btn-success btn-xs'>
                                        <i class='nav-icon fas fa-pen'></i> Edit
                                    </button> 
                                </a>
                                <button class='btn elevation-1 btn-danger btn-xs' data-toggle='modal' data-target='#delete-car-$car_id'>
                                <i class='nav-icon fas fa-trash'></i> Delete
                            </button>";
                        
                    }
                    if ($_SESSION['user_type'] == "Owner"){
                        $action_btns = "
                            <a href='edit-car.php?car_id=$car_id'>
                                    <button class='btn elevation-1 btn-success btn-xs'>
                                        <i class='nav-icon fas fa-pen'></i> Edit
                                    </button> 
                                </a>
                                <button class='btn elevation-1 btn-danger btn-xs' data-toggle='modal' data-target='#delete-car-$car_id'>
                                <i class='nav-icon fas fa-trash'></i> Delete
                            </button>";
                    }
                    if ($_SESSION['user_type'] == "Customer"){
                        $action_btns = "";
                    }
    
                    if ($status == 1){
                        $status_text = "<span class='badge badge-success'>Available</span>";
                    } else {
                        $status_text = "<span class='badge badge-warning'>Unavailable</span>";
                    }
                    echo "<tr>
                        <td class='text-center'>
                        $action_btns
                        <a href='../car-image/car-image.php?car_id=$car_id&car_name=$car_name'>
                            <button class='btn elevation-1 btn-default btn-xs'>
                                <i class='nav-icon fas fa-eye'></i> Images
                            </button> 
                        </a>
                        <a href='../car-review/car-review.php?car_id=$car_id&car_name=$car_name'>
                            <button class='btn elevation-1 btn-default btn-xs'>
                                <i class='nav-icon fas fa-eye'></i> Reviews
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
                            <button class='btn btn-sm elevation-1 btn-default btn-xs' data-toggle='modal' data-target='#view-proof_of_ownership-$car_id'><i class='nav-icon fas fa-eye'></i> View Picture</button>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-proof_of_ownership-$car_id'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
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
