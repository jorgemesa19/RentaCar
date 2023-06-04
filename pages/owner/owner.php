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
            <h1>Owner</h1>
          </div>
        </div>  
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php  
        echo "<script src='../../plugins/jquery/jquery.min.js'></script>";
        include 'add-modal.php';
        include 'function.php'; 
        $add_btn = "";
        if ($_SESSION['user_type'] == "Administrator"){
            $add_btn = "<button class='btn btn-info' data-toggle='modal' data-target='#add-owner'><i class='fa fa-plus'></i> Add</button>";
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
                        <th class='text-center'>Profile Image</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Fb Account</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $cn = new mysqli (HOST, USER, PW, DB);
                if ($_SESSION['user_type'] == "Administrator"){
                    $sql="SELECT owner_id, owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblowner";
                }
                if ($_SESSION['user_type'] == "Owner"){
                    $owner_id = $_SESSION['user_id'];
                    $sql="SELECT owner_id, owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status FROM tblowner WHERE owner_id = $owner_id";
                }
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($owner_id, $owner_name, $address, $contact, $profile_image, $fb_account, $username, $password, $admin_id, $account_status);
                $qry->store_result();
                while ($qry->fetch()){
                    $delete_btn = "";
                    if ($_SESSION['user_type'] == "Administrator"){
                        $delete_btn = "<button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-owner-$owner_id'>
                                <i class='nav-icon fas fa-trash'></i> Delete
                            </button>";
                    }
                    
                    if ($account_status == 1){
                        $status_text = "<span class='badge badge-success'>Active</span>";
                    } else {
                        $status_text = "<span class='badge badge-warning'>Inactive</span>";
                    }
                    echo "<tr>
                        <td class='text-center'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs' data-toggle='modal' data-target='#edit-owner-$owner_id'>
                                <i class='nav-icon fas fa-pen'></i> Edit
                            </button> 
                            $delete_btn
                            <a href='../owner-credential/owner-credential.php?owner_id=$owner_id&owner_name=$owner_name'>
                                <button class='btn elevation-1 btn-sm btn-default btn-xs'>
                                    <i class='nav-icon fas fa-user'></i> Credentials
                                </button> 
                            </a>
                        </td>
                        <td class='text-center'>
                            <img src='../uploads/$profile_image' class='img' style='width:100px;' alt='Image'><br>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-profile_image-$owner_id'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                        </td>
                        <td>$owner_name</td>
                        <td>$address</td>
                        <td>$contact</td>
                        <td>$fb_account</td>
                        <td>$username</td>
                        <td>$password</td>
                        <td>$status_text</td>
                        </tr>";
                    
                    include 'edit-modal.php';
                    include 'edit-profile_image-modal.php';
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
