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
              <?php
              $back_btn = "";
              if ($_SESSION['user_type'] == "Administrator"){
                  $customer_id = $_GET['customer_id'];
                  $customer_name = $_GET['customer_name'];
                  
                $back_btn = "<a href='../customer/customer.php'>
                                <button class='btn btn-default'>Go Back</button>
                              </a>";
              }
              ?>
            <h1>Customer Credential - <b><?php echo $customer_name; ?></b></h1>
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
            <?php echo $back_btn; ?>
            <button class="btn btn-info" data-toggle="modal" data-target="#add-customercredential"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Credential Name</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                $user = "postgres"; // Nombre de usuario de la base de datos
                $password = "9090"; // Contraseña de la base de datos
                $dbname = "bd_rentaCar"; // Nombre de la base de datos

                $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                
                $sql="SELECT credential_id, credential_name, file_upload, customer_id FROM tblcustomercredential WHERE customer_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $customer_id);
                $stmt->execute();
                $result = $stmt->fetchAll();
                
                foreach ($result as $row){
                    $credential_id = $row['credential_id'];
                    $credential_name = $row['credential_name'];
                    $file_upload = $row['file_upload'];
                    $customer_id = $row['customer_id'];

                    $file_upload_text = substr($file_upload,0,20)."...";
                    echo "<tr>
                        <td class='text-center'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs' data-toggle='modal' data-target='#edit-customercredential-$credential_id'>
                                <i class='nav-icon fas fa-pen'></i>
                            </button> 
                            <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-customercredential-$credential_id'>
                                <i class='nav-icon fas fa-trash'></i>
                            </button>
                        </td>
                        <td>$credential_name</td>
                        <td>
                        
                            $file_upload_text
                            <a href='../uploads/$file_upload' target='_blank'>
                            <button class='btn btn-xs btn-info elevation-1'><i class='nav-icon fas fa-download'></i> Download</button>
                            </a>
                            <button class='btn elevation-1 btn-sm btn-warning btn-xs' data-toggle='modal' data-target='#edit-file_upload-$credential_id'>
                                <i class='nav-icon fas fa-pen'></i> Change FIle
                            </button>
                        </td>
                        </tr>";
                    
                    include 'edit-modal.php';
                    include 'edit-file_upload-modal.php';
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
