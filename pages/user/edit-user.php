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
            <h1>Edit User</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
          <?php 
          include 'function.php'; 
          
          $user_id = $_GET['user_id'];
          $cn = new mysqli (HOST, USER, PW, DB);
          $sql="SELECT user_id, firstname, middlename, lastname, contact, email, address, username, password, profile_picture, status FROM tbl_user WHERE user_id = ?";
          $qry=$cn->prepare($sql);
          $qry->bind_param("s", $user_id);
          $qry->execute();
          $qry->bind_result($user_id, $firstname, $middlename, $lastname, $contact, $email, $address, $username, $password, $profile_picture, $status);
          $qry->store_result();
          $qry->fetch();
          ?>
          <form method="post" class="form-horizontal">
              <div class="card-body">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control form-control-border" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required>
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                      <input type="text" name="redirect" value="y" hidden>
                </div>
                <div class="form-group">
                    <label for="middlename">Middle Name</label>
                    <input type="text" class="form-control form-control-border" id="middlename" name="middlename" value="<?php echo $middlename; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control form-control-border" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact; ?>" oninput="checkNumber()" maxlength="11" required>
                    <div id="response_contact"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-border" id="email" name="email" value="<?php echo $email; ?>" required>
                    <div id="response_email"></div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required><?php echo $address; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username; ?>" required>
                    <div id="response"></div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class='custom-select form-control-border' name="status">
                        <?php 
                        if ($status == 1){
                            echo "
                            <option value='1'>Active</option>
                            <option value='0'>Inactive</option>";
                        }
                        else {
                            echo "
                            <option value='0'>Inactive</option>
                            <option value='1'>Active</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
              <div class="card-footer">
                  <a href="user.php">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </a>
                  <input type="submit" class="btn btn-primary" name="edit-user" id="edit-user_btn" value="Save">
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

<?php include '../header_footer/scripts.php'; ?>
<script>
$(function () {
      $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX":true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
      $("#example2").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX":true,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
    
    function checkNumber() {
        var contact = document.getElementById("contact").value;
        var prev_contact = contact;
        if (contact > 09999999999) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("edit-user_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (contact < 09000000000) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("edit-user_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (isNaN(contact)){
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("edit-user_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else {
            document.getElementById("response_contact").innerHTML = "<span style='color: green;'>Valid Phone Number</span>";
            document.getElementById("edit-user_btn").disabled = false;
            document.getElementById('contact').className = 'form-control form-control-border is-valid';
        }
    }
</script>
</body>
</html>
