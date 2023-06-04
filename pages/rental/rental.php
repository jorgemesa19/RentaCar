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
            <h1>Rentas</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        include 'add-modal.php';
        include 'function.php'; 
        
        $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-rental'><i class='fa fa-plus'></i> Añadir</button>";
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
                        <th>Fecha de renta</th>
                        <th>Tiempo de renta</th>
                        <th>Fecha de devolución</th>
                        <th>Dueño</th>
                        <th>Carro</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $host = "localhost";
                $user = "postgres";
                $password = "9090";
                $dbname = "bd_rentaCar";
                $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                
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
                
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($result as $row) {
                    $rental_id = $row['rental_id'];
                    $rental_date = $row['rental_date'];
                    $rental_time = $row['rental_time'];
                    $return_date = $row['return_date'];
                    $owner_id = $row['owner_id'];
                    $car_id = $row['car_id'];
                    $customer_id = $row['customer_id'];
                    $rental_status = $row['rental_status'];
                    $owner_name = $row['owner_name'];
                    $car_name = $row['car_name'];
                    $customer_name = $row['customer_name'];
                    
                    $delete_btn = "<button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-rental-$rental_id'>
                                    <i class='nav-icon fas fa-trash'></i> Eliminar
                                    </button>";
                    if ($_SESSION['user_type'] == "Administrator"){
                        $add_payment_btn = "
                        <a href='../payment/add-payment.php?rental_id=$rental_id&customer_id=$customer_id'>
                            <button class='btn elevation-1 btn-sm btn-default btn-xs'>
                                <i class='nav-icon fas fa-plus'></i> Añadir pago
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
                                <i class='nav-icon fas fa-plus'></i> Añadir pago
                            </button>
                        </a>";
                    }
                    
                    if ($rental_status == 1){
                        $status_text = "<span class='badge badge-success'>Disponible</span>";
                    } else {
                        $status_text = "<span class='badge badge-warning'>No disponible</span>";
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
