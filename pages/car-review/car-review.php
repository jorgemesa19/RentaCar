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
            <h1>Revisión del carro <b><?php echo $_GET['car_name'];?></b></h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        $car_id = $_GET['car_id'];
        $car_name = $_GET['car_name'];
        $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-carreview'><i class='fa fa-plus'></i> Add</button>";
        
        include 'add-modal.php';
        include 'function.php'; 
        
        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

        if ($_SESSION['user_type'] == "Administrator") {
            $sql = "SELECT review.review_id, review.review, review.review_score, review.date, review.customer_id, review.car_id, customer.customer_name, customer.profile_image 
            FROM tblcarreview AS review
            INNER JOIN tblcustomer AS customer
            ON review.customer_id = customer.customer_id
            WHERE review.car_id = ?
            ORDER BY review.review_id DESC";
        }
        if ($_SESSION['user_type'] == "Owner") {
            $owner_id = $_SESSION['user_id'];
            $sql = "SELECT review.review_id, review.review, review.review_score, review.date, review.customer_id, review.car_id, customer.customer_name, customer.profile_image 
            FROM tblcarreview AS review
            INNER JOIN tblcustomer AS customer
            ON review.customer_id = customer.customer_id
            INNER JOIN tblcar AS car
            ON review.car_id = car.car_id
            INNER JOIN tblowner AS owner
            ON car.car_id = owner.owner_id
            WHERE review.car_id = ? AND owner.owner_id = $owner_id
            ORDER BY review.review_id DESC";
            $add_btn = "";
        }
        if ($_SESSION['user_type'] == "Customer") {
            $sql = "SELECT review.review_id, review.review, review.review_score, review.date, review.customer_id, review.car_id, customer.customer_name, customer.profile_image 
            FROM tblcarreview AS review
            INNER JOIN tblcustomer AS customer
            ON review.customer_id = customer.customer_id
            WHERE review.car_id = ?
            ORDER BY review.review_id DESC";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $car_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <?php
            foreach ($results as $row) {
                $review_id = $row['review_id'];
                $review = $row['review'];
                $review_score = $row['review_score'];
                $date = $row['date'];
                $customer_id = $row['customer_id'];
                $customer_name = $row['customer_name'];
                $profile_image = $row['profile_image'];

                $action_btn = "";
                if ($customer_id == $_SESSION['user_id']) {
                    $action_btn = "
                    <button class='btn elevation-1 btn-sm btn-danger btn-xs ' data-toggle='modal' data-target='#delete-carreview-$review_id'>
                        <i class='nav-icon fas fa-trash'></i>
                    </button>
                    <a href='edit-carreview.php?car_id=$car_id&car_name=$car_name&review_id=$review_id'>
                        <button class='btn elevation-1 btn-sm btn-success btn-xs'> 
                            <i class='nav-icon fas fa-pen'></i>
                        </button>
                    </a>";
                }
                if ($_SESSION['user_type'] == "Administrator") {
                    $action_btn = "
                    <button class='btn elevation-1 btn-sm btn-danger btn-xs ' data-toggle='modal' data-target='#delete-carreview-$review_id'>
                        <i class='nav-icon fas fa-trash'></i>
                    </button>
                    <a href='edit-carreview.php?car_id=$car_id&car_name=$car_name&review_id=$review_id'>
                        <button class='btn elevation-1 btn-sm btn-success btn-xs'> 
                            <i class='nav-icon fas fa-pen'></i>
                        </button>
                    </a>";
                }

                echo "
                <div class='post clearfix'>
                    <div class='user-block'>
                        <img class='img-circle img-bordered-sm' src='../uploads/$profile_image' alt='User Image'>
                        <span class='username'>
                            <a href='#'>$customer_name</a>
                            <div class='float-right'>
                                $action_btn
                            </div>
                        </span>
                        <span class='description'>$date</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        $review
                    </p>
                    <span class='description'>Review Score: $review_score</span>
                </div>
                ";
                
                include "delete-modal.php";
            }
            ?>
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
