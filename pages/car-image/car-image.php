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
            <h1>Car Images <b><?php echo $_GET['car_name'];?></b></h1>
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
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT image_id, image_description, image, car_id FROM tblcarimage WHERE car_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $car_id);
        $qry->execute();
        $qry->bind_result($image_id, $image_description, $image, $car_id);
        $qry->store_result();
        if ($_SESSION['user_type'] == "Administrator"){
            $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-carimage'><i class='fa fa-plus'></i> Add</button>";
            $delete_btn = "<button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-carimage-$image_id'>
                            <i class='nav-icon fas fa-trash'></i>
                            </button>";
        }
        if ($_SESSION['user_type'] == "Owner"){
            $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-carimage'><i class='fa fa-plus'></i> Add</button>";
            $delete_btn = "<button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-carimage-$image_id'>
                            <i class='nav-icon fas fa-trash'></i>
                            </button>";
        }
        if ($_SESSION['user_type'] == "Customer"){
            $add_btn = "";
            $delete_btn = "";
        }
        ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <a href="../car/car.php">
                <button class="btn btn-default">Go back</button>
            </a>
            <?php echo $add_btn;?>
        </div>
        <div class="card-body">
            <div class='row'>
            <?php
                while ($qry->fetch()){
                    echo "<div class='col-md-3'>
                            <img class='img-fluid mb-3 elevation-1 img-bordered-sm' src='../uploads/$image' alt='Photo'>
                            <p>$image_description</p>
                            $delete_btn
                        </div>
                            ";
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
