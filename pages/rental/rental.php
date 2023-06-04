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
            <h1>Rental</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        include 'add-modal.php';
        include 'function.php'; 
        
        $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-rental'><i class='fa fa-plus'></i> Add</button>";
        if ($_SESSION['user_type'] == "Owner"){
            $add_btn = "";
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
                        <th>Rental Date</th>
                        <th>Rental Time</th>
                        <th>Return Date</th>
                        <th>Owner</th>
                        <th>Car</th>
                        <th>Customer</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $cn = new mysqli (HOST, USER, PW, DB);
                $add_payment_btn = "";
                if ($_SESSION['user_type'] == "Administrator"){
                    $sql="SELECT rental.rental_id, rental.rental_date, rental.rental_time, rental.return_date, rental.owner_id, rental.car_id, rental.customer_id, rental.rental_status, owner.owner_name, car.car_name, customer.customer_name
                    FROM tblrental AS rental
                    INNER JOIN tblowner AS owner
                    ON rental.owner_id = owner.owner_id
                    INNER JOIN tblcar AS car
                    ON rental.car_id = car.car_id
                    INNER JOIN tblcustomer AS customer
                    ON rental.customer_id = customer.customer_id";
                }
                if ($_SESSION['user_type'] == "Owner"){
                    $owner_id = $_SESSION['user_id'];
                    $sql="SELECT rental.rental_id, rental.rental_date, rental.rental_time, rental.return_date, rental.owner_id, rental.car_id, rental.customer_id, rental.rental_status, owner.owner_name, car.car_name, customer.customer_name
                    FROM tblrental AS rental
                    INNER JOIN tblowner AS owner
                    ON rental.owner_id = owner.owner_id
                    INNER JOIN tblcar AS car
                    ON rental.car_id = car.car_id
                    INNER JOIN tblcustomer AS customer
                    ON rental.customer_id = customer.customer_id
                    WHERE owner.owner_id = $owner_id";
                }
                if ($_SESSION['user_type'] == "Customer"){
                    $customer_id = $_SESSION['user_id'];
                    $sql="SELECT rental.rental_id, rental.rental_date, rental.rental_time, rental.return_date, rental.owner_id, rental.car_id, rental.customer_id, rental.rental_status, owner.owner_name, car.car_name, customer.customer_name
                    FROM tblrental AS rental
                    INNER JOIN tblowner AS owner
                    ON rental.owner_id = owner.owner_id
                    INNER JOIN tblcar AS car
                    ON rental.car_id = car.car_id
                    INNER JOIN tblcustomer AS customer
                    ON rental.customer_id = customer.customer_id
                    WHERE customer.customer_id = $customer_id";
                }
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($rental_id, $rental_date, $rental_time, $return_date, $owner_id, $car_id, $customer_id, $rental_status, $owner_name, $car_name, $customer_name);
                $qry->store_result();
                while ($qry->fetch()){
                    $delete_btn = "<button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-rental-$rental_id'>
                                    <i class='nav-icon fas fa-trash'></i> Delete
                                    </button>";
                    if ($_SESSION['user_type'] == "Administrator"){
                        $add_payment_btn = "
                        <a href='../payment/add-payment.php?rental_id=$rental_id&customer_id=$customer_id'>
                            <button class='btn elevation-1 btn-sm btn-default btn-xs'>
                                <i class='nav-icon fas fa-plus'></i> Add Payment
                            </button>
                        </a>";
                    }
                    if ($_SESSION['user_type'] == "Owner"){
                        $delete_btn = "";
                    }
                    if ($_SESSION['user_type'] == "Customer"){
                        $add_payment_btn = "
                        <a href='../payment/add-payment.php?rental_id=$rental_id&customer_id=$customer_id'>
                            <button class='btn elevation-1 btn-sm btn-default btn-xs'>
                                <i class='nav-icon fas fa-plus'></i> Add Payment
                            </button>
                        </a>";
                    }
                    
                    if ($rental_status == 1){
                        $status_text = "<span class='badge badge-success'>Available</span>";
                    } else {
                        $status_text = "<span class='badge badge-warning'>Unavailable</span>";
                    }
                    echo "<tr>
                        <td class='text-center'>
                        $delete_btn    
                        $add_payment_btn
                        </td>
                        <td>$rental_date</td>
                        <td>$rental_time</td>
                        <td>$return_date</td>
                        <td>$owner_name</td>
                        <td>$car_name</td>
                        <td>$customer_name</td>
                        <td>$status_text</td>
                        </tr>";
                    
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
      "responsive": true,
    });
  });
</script>
</body>
</html>
