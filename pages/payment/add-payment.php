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
            <h1>Pagos</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        
        $rental_id = $_GET['rental_id'];
        $customer_id = $_GET['customer_id'];
        
        include "add-payment-modal.php";
        include "function.php";
        
        $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
        $user = "postgres"; // Nombre de usuario de la base de datos
        $password = "9090"; // Contraseña de la base de datos
        $dbname = "bd_rentaCar"; // Nombre de la base de datos
        
        $cn = new mysqli($host, $user, $password, $dbname);
        $sql="SELECT rental_id FROM tblpayment WHERE rental_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $rental_id);
        $qry->execute();
        $qry->bind_result($rental_id);
        $qry->store_result();
        $qry->fetch();
        ?>
      <!-- Default box -->
      <div class="card">
          <div class='card-header'>
              <a href="../rental/rental.php">
                  <button class="btn btn-default">Atras</button>
              </a>
          <?php
          if ($qry->num_rows==0) {
              echo "
                <button class='btn btn-info' data-toggle='modal' data-target='#add-payment'>
                    <i class='nav-icon fas fa-plus'></i> Add Payment
                </button>
               ";
          } 
          ?>
          </div>
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Monto del pagot</th>
                        <th>Agregar cargos</th>
                        <th>Fecha de pago</th>
                        <th>Prueba de pago</th>
                        <th>Cliente</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cn = new mysqli($host, $user, $password, $dbname);
                    $sql="SELECT payment.payment_id, payment.rental_id, payment.payment_amount, payment.add_charges, payment.payment_date, payment.proof_of_payment, payment.customer_id, customer.customer_name
                    FROM tblpayment AS payment
                    INNER JOIN tblcustomer AS customer
                    ON payment.customer_id = customer.customer_id
                    WHERE payment.rental_id = ?";
                    $qry=$cn->prepare($sql);
                    $qry->bind_param("s", $rental_id);
                    $qry->execute();
                    $qry->bind_result($payment_id, $rental_id, $payment_amount, $add_charges, $payment_date, $proof_of_payment, $customer_id, $customer_name);
                    $qry->store_result();
                    while ($qry->fetch()){
                        echo "<tr>
                            <td>
                                <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-payment-$payment_id'>
                                    <i class='nav-icon fas fa-trash'></i>
                                </button>
                            </td>
                            <td>$payment_amount</td>
                            <td>$add_charges</td>
                            <td>$payment_date</td>
                            <td class='text-center'>
                                <img src='../uploads/$proof_of_payment' class='img' style='width:100px;' alt='Image'><br>
                                <button class='btn btn-sm elevation-1 btn-default btn-xs' data-toggle='modal' data-target='#view-proof_of_payment-$payment_id'><i class='nav-icon fas fa-eye'></i> View Picture</button>
                            </td>
                            <td>$customer_name</td>
                            </tr>";
                        include 'view-proof_of_payment-modal.php';
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
