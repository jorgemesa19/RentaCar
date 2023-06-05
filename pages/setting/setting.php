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
            <h1>Setting</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <!-- Default box -->
            
          <div class="col-lg-8">
          <div class="card">
              <form method="post">
                  <div class="card-body">
                      <div class="form-group">
                          <label for="app_name">Nombre de la app</label>
                          <input type="text" class="form-control form-control-border" id="app_name" name="app_name" placeholder="Nombre de la app" value="<?php echo $app_name;?>" required>
                          <input type="text" name="setting_id" value="<?php echo $setting_id;?>" hidden>
                      </div>
                      <div class="form-group">
                        <label for="address">Dirección</label>
                        <textarea type="text" class="form-control form-control-border" id="address" name="address" placeholder="Dirección" required><?php echo $app_address;?></textarea>
                      </div>
                      <div class="form-group">
                          <label for="contact">Número de contacto</label>
                          <input type="text" class="form-control form-control-border" id="contact" name="contact" placeholder="Número de contacto" value="<?php echo $contact;?>" required>
                      </div>
                      <div class="form-group">
                        <label for="about">Acerca de</label>
                        <textarea type="text" class="form-control form-control-border" id="about" name="about" placeholder="Acerca de" required><?php echo $about;?></textarea>
                      </div>
                  </div>
                  <div class="card-footer">
                      <input type="submit" class="btn btn-primary" id="add-donation_btn" name="update-about" value="Guardar">
                  </div>
              </form>
            <!-- /.card-body -->          
          </div>
          <!-- /.card -->
              
              <div class="card">
              <div class="card-body text-center">
                  <img src='../uploads/<?php echo $login_image; ?>' class='img elevation-3' style='width:500px;' alt='Background Image'><br>
              </div>
              <div class="card-footer">
                  <button class='btn btn-warning' data-toggle='modal' data-target='#edit-login_image'>
                      <i class='nav-icon fas fa-pen'></i> Actualizar imagen de fondo</button>
              </div>
            <!-- /.card-body -->          
          </div>
          <!-- /.card -->
              
            </div>

            <!-- Default box -->
          <div class="col-lg-4">
          <div class="card">
              <div class="card-body text-center">
                  <img src='../uploads/<?php echo $logo; ?>' class='img elevation-3' style='width:200px;' alt='Logo'><br>
              </div>
              <div class="card-footer">
                  <button class='btn btn-warning' data-toggle='modal' data-target='#edit-logo'>
                      <i class='nav-icon fas fa-pen'></i>Actualizar logo</button>
              </div>
            <!-- /.card-body -->          
          </div>
          <!-- /.card -->
        </div>
        

        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php 
    include '../header_footer/scripts.php'; 
    include 'edit-logo-modal.php'; 
    include 'edit-login_image-modal.php'; 
    include 'function.php';
    ?>
<script>
  $(function () {
     $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX":true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
