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
            <h1>Payments</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th>Payment Amount</th>
                        <th>Add Charges</th>
                        <th>Payment Date</th>
                        <th>Proof of Payment</th>
                        <th>Customer</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $cn = new mysqli (HOST, USER, PW, DB);
                    if ($_SESSION['user_type'] == "Administrator"){
                        $sql="SELECT payment.payment_id, payment.rental_id, payment.payment_amount, payment.add_charges, payment.payment_date, payment.proof_of_payment, payment.customer_id, customer.customer_name
                        FROM tblpayment AS payment
                        INNER JOIN tblcustomer AS customer
                        ON payment.customer_id = customer.customer_id";
                    }
                    if ($_SESSION['user_type'] == "Owner"){
                        $owner_id = $_SESSION['user_id'];
                        $sql="SELECT payment.payment_id, payment.rental_id, payment.payment_amount, payment.add_charges, payment.payment_date, payment.proof_of_payment, payment.customer_id, customer.customer_name
                        FROM tblpayment AS payment
                        INNER JOIN tblcustomer AS customer
                        ON payment.customer_id = customer.customer_id
                        INNER JOIN tblrental AS rental
                        ON payment.rental_id = rental.rental_id
                        INNER JOIN tblcar AS car
                        ON rental.car_id = car.car_id
                        WHERE car.owner_id = $owner_id";
                    }
                    if ($_SESSION['user_type'] == "Customer"){
                        $customer_id = $_SESSION['user_id'];
                        $sql="SELECT payment.payment_id, payment.rental_id, payment.payment_amount, payment.add_charges, payment.payment_date, payment.proof_of_payment, payment.customer_id, customer.customer_name
                        FROM tblpayment AS payment
                        INNER JOIN tblcustomer AS customer
                        ON payment.customer_id = customer.customer_id
                        INNER JOIN tblrental AS rental
                        ON payment.rental_id = rental.rental_id
                        WHERE rental.customer_id = $customer_id";
                    }
                    $qry=$cn->prepare($sql);
                    $qry->execute();
                    $qry->bind_result($payment_id, $rental_id, $payment_amount, $add_charges, $payment_date, $proof_of_payment, $customer_id, $customer_name);
                    $qry->store_result();
                    while ($qry->fetch()){
                    echo "<tr>
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
