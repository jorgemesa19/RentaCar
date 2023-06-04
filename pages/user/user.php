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
            <h1>Users (Administrator)</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<?php 
        include 'add-modal.php';  
        include 'function.php'; 
?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-info" data-toggle="modal" data-target="#add-user"><i class="fa fa-plus"></i> Add</button>
            
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT user_id, firstname, middlename, lastname, contact, email, address, username, password, profile_picture, status FROM tbl_user";
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($user_id, $firstname, $middlename, $lastname, $contact, $email, $address, $username, $password, $profile_picture, $status);
                $qry->store_result();
                while ($qry->fetch()){
                    if ($status == 1){
                        $active = "<span class='right badge badge-success'>Active</span>";
                    }
                    else {
                        $active = "<span class='right badge badge-warning'>Inactive</span>";
                    }
                    echo "<tr>
                        <td class='text-center'>
                        <a href='edit-user.php?user_id=$user_id'><button class='btn btn-sm elevation-1 btn-success btn-xs'><i class='nav-icon fas fa-pen'></i></button></a> 
                        </td>
                        <td class='text-center'><img src='../uploads/$profile_picture' class='img' style='width:100px;' alt='Image'><br>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-profile_picture-$user_id'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                        </td>
                        <td>$firstname $middlename $lastname</td>
                        <td>$contact</td>
                        <td>$email</td>
                        <td>$address</td>
                        <td>$username</td>
                        <td class='text-center'>
                            <button class='btn btn-sm elevation-1 btn-default btn-sm' data-toggle='modal' data-target='#edit-password-$user_id'>Change Password</button>
                        </td>
                        <td>$active</td>
                        </tr>";
                    
                    include 'delete-modal.php';
                    include 'edit-profile_picture-modal.php';
                    include 'edit-password-modal.php';
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

<?php include '../header_footer/scripts.php'; ?>
<script>
$(function () {
      $("#table1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX":true
      }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
      
      $("#example2").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX":true,
      }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
