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
                  $owner_id = $_GET['owner_id'];
                  $owner_name = $_GET['owner_name'];
                  
                $back_btn = "<a href='../owner/owner.php'>
                                <button class='btn btn-default'>Go Back</button>
                              </a>";
              }
              ?>
            <h1>Credencial del propietario - <b><?php echo $owner_name; ?></b></h1>
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
            <button class="btn btn-info" data-toggle="modal" data-target="#add-ownercredential"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="table1" class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre de la credencial</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql="SELECT owner_credential_id, credential_name, file_upload, owner_id FROM tblownercredential WHERE owner_id = ?";
                $qry=$conn->prepare($sql);
                $qry->execute([$owner_id]);
                $result = $qry->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $owner_credential_id = $row['owner_credential_id'];
                    $credential_name = $row['credential_name'];
                    $file_upload = $row['file_upload'];

                    if (is_resource($file_upload)) {
                      // Realizar alguna acción para obtener el contenido del recurso, como leer el archivo
                      // y asignar el contenido a $file_upload como una cadena de texto
                      $file_content = stream_get_contents($file_upload);
                      $file_upload = $file_content;
                  }
              
                  $file_upload_text = substr($file_upload, 0, 20)."...";
                    echo "<tr>
                        <td class='text-center'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs' data-toggle='modal' data-target='#edit-ownercredential-$owner_credential_id'>
                                <i class='nav-icon fas fa-pen'></i>
                            </button> 
                            <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-ownercredential-$owner_credential_id'>
                                <i class='nav-icon fas fa-trash'></i>
                            </button>
                        </td>
                        <td>$credential_name</td>
                        <td>
                        
                            $file_upload_text
                            <a href='../uploads/$file_upload' target='_blank'>
                            <button class='btn btn-xs btn-info elevation-1'><i class='nav-icon fas fa-download'></i> Download</button>
                            </a>
                            <button class='btn elevation-1 btn-sm btn-warning btn-xs' data-toggle='modal' data-target='#edit-file_upload-$owner_credential_id'>
                                <i class='nav-icon fas fa-pen'></i> Change File
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
