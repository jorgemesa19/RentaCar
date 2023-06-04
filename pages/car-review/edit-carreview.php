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
            <h1>Edit Car Review <b><?php echo $_GET['car_name'];?></b></h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        $review_id = $_GET['review_id'];
        $car_id = $_GET['car_id'];
        $car_name = $_GET['car_name'];
        
        include 'function.php'; 
        
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT review.review_id, review.review, review.review_score, review.date, review.customer_id, review.car_id, customer.customer_name, customer.profile_image 
        FROM tblcarreview AS review
        INNER JOIN tblcustomer AS customer
        ON review.customer_id = customer.customer_id
        WHERE review.review_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $review_id);
        $qry->execute();
        $qry->bind_result($review_id, $review, $review_score, $date, $customer_id, $car_id, $customer_name, $profile_image);
        $qry->store_result();
        $qry->fetch();
        ?>
        
      <!-- Default box -->
      <div class="card">
          <form method="post">
              <div class="card-body">
            <div class="form-group">
                <label for="review">Review</label>
                <textarea class="form-control form-control-border" rows="3" id="review" name="review" placeholder="Review" required><?php echo $review;?></textarea>
            </div>
                    
            <div class="form-group">
                <label for="review_score">Review Score</label>
                <input type="number" class="form-control form-control-border" id="review_score" name="review_score" value="<?php echo $review_score; ?>" placeholder="Review Score" required>
            </div>
                    
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select class='custom-select form-control-border' name="customer_id">
                    <?php
                    echo " <option value='$customer_id'>$customer_name</option>";
                    
                    $cn = new mysqli (HOST, USER, PW, DB);
                    $sql="SELECT customer_id, customer_name FROM tblcustomer WHERE customer_id <> ?";
                    $qry=$cn->prepare($sql);
                    $qry->bind_param("s", $customer_id);
                    $qry->execute();
                    $qry->bind_result($customer_id, $customer_name);
                    $qry->store_result();
                    while ($qry->fetch()){
                        echo " <option value='$customer_id'>$customer_name</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
              <div class="card-footer justify-content-between">
              <a onclick="history.back()">
                  <button type="button" class="btn btn-default">Go back</button>
              </a>
              <input type="text" name="review_id" value="<?php echo $review_id;?>" hidden>
              <input type="submit" class="btn btn-primary " id="edit-carreview_btn" name="edit-carreview" value="Save">
          </div>
            <!-- /.card-body -->
          </form>
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
