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
            <h1>Editar usuario</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
          <?php 
          include 'function.php'; 
          
          $user_id = $_SESSION['user_id'];
          $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
          $user = "postgres"; // Nombre de usuario de la base de datos
          $password = "9090"; // Contraseña de la base de datos
          $dbname = "bd_rentaCar"; // Nombre de la base de datos
          $cn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
          $sql="SELECT user_id, lastname, firstname, middlename, contact, email, address, username, password, profile_picture, status FROM tbl_user WHERE user_id = ?";
          $qry=$cn->prepare($sql);
          $qry->bindParam(1, $user_id);
          $qry->execute();
          $result = $qry->fetch(PDO::FETCH_ASSOC);
          $lastname = $result['lastname'];
          $firstname = $result['firstname'];
          $middlename = $result['middlename'];
          $contact = $result['contact'];
          $email = $result['email'];
          $address = $result['address'];
          $username = $result['username'];
          $password = $result['password'];
          $profile_picture = $result['profile_picture'];
          $status = $result['status'];
          ?>
          <div class="row">
              <div class="col-4">
                  <div class="card text-center">    
                      <div class="card-body">
                          <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                              <img class="img-circle elevation-2" style="height:200px;" src="../uploads/<?php echo $profile_picture; ?>" alt="User profile picture"><br>
                          </li>
                          <li class="list-group-item">
                              <button type="button" class='btn btn-sm btn-warning ' data-toggle='modal' data-target='#edit-profile_picture-<?php echo $user_id;?>'><i class='nav-icon fas fa-pen'></i>Editar foto</button>
                          </li>
                      </ul>
                      </div>
                  </div>
              </div>
              <div class="col-8">
                  <form method="post" class="form-horizontal">
                      <div class="card">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="firstname">Primer nombre</label>
                            <input type="text" class="form-control form-control-border" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required>
                            <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                            <input type="text" name="redirect" value="n" hidden>
                        </div>
                        <div class="form-group">
                            <label for="middlename">Segundo nombre</label>
                            <input type="text" class="form-control form-control-border" id="middlename" name="middlename" value="<?php echo $middlename; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Apellidos</label>
                            <input type="text" class="form-control form-control-border" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">nro. contacto</label>
                            <input type="text" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact; ?>" oninput="checkNumber()" maxlength="11" required>
                            <div id="response_contact"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-border" id="email" name="email" value="<?php echo $email; ?>" required>
                            <div id="response_email"></div>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required><?php echo $address; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username; ?>" required>
                            <div id="response"></div>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select class='custom-select form-control-border' name="status">
                                <?php 
                                if ($status == 1){
                                    echo "
                                    <option value='1'>Activo</option>
                                    <option value='0'>Inactivo</option>";
                                }
                                else {
                                    echo "
                                    <option value='0'>Inactivo</option>
                                    <option value='1'>Activo</option>";
                                }
                                ?>
                            </select>
                        </div>
                          <div class="form-group">
                              <label>Password</label>
                              <button type="button" class='form-control btn   btn-default ' data-toggle='modal' data-target='#edit-password-<?php echo $user_id;?>'>Cambiar contraseña</button>
                          </div>
                      </div>
                          <div class="card-footer">
                          <a href="../dashboard/dashboard.php">
                              <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                          </a>
                          <input type="submit" class="btn btn-primary" name="edit-user" value="Guardar">
                    </div>
                      </div>
                  </form>
              </div>
          </div>

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

<?php include '../header_footer/scripts.php'; include 'edit-profile_picture-modal.php'; include 'edit-password-modal.php';?>
<script>
$(function () {
      $("#example1").DataTable({
      "responsive": false,  "lengthChange": false, "autoWidth": false, "scrollX":true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
      $("#example2").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX":true,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
    
    function checkNumber() {
        var contact = document.getElementById("contact").value;
        var prev_contact = contact;
        if (contact > 09999999999) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Nro. teléfono inválido</span>";
            document.getElementById("add-user_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (contact < 09000000000) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Nro. teléfono inválido</span>";
            document.getElementById("add-user_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (isNaN(contact)){
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Nro. teléfono inválido</span>";
            document.getElementById("add-user_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else {
            document.getElementById("response_contact").innerHTML = "<span style='color: green;'>Nro. teléfono válido</span>";
            document.getElementById("add-user_btn").disabled = false;
            document.getElementById('contact').className = 'form-control form-control-border is-valid';
        }
    }
</script>
</body>
</html>
