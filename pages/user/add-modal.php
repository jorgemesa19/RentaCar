      <div class="modal fade" id="add-user">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">                
                <div class="form-group">
                    <label for="firstname">Primer nombre</label>
                    <input type="text" class="form-control form-control-border" id="firstname" name="firstname" placeholder="Primer nombre" required>
                </div>
                <div class="form-group">
                    <label for="middlename">Segundo nombre</label>
                    <input type="text" class="form-control form-control-border" id="middlename" name="middlename" placeholder="Segundo nombre" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Apellidos</label>
                    <input type="text" class="form-control form-control-border" id="lastname" name="lastname" placeholder="Apellidos" required>
                </div>
                <div class="form-group">
                    <label for="contact">Nro. de contacto</label>
                    <input type="text" class="form-control form-control-border" id="contact" name="contact" placeholder="Nro. de contacto" oninput="checkNumber()" maxlength="11" required>
                    <div id="response_contact"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-border" id="email" name="email" placeholder="Email" required>
                    <div id="response_email"></div>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Dirección" required></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" class="form-control form-control-border" id="username" name="username" placeholder="Nombre de usuario" required>
                    <div id="response"></div>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control form-control-border" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                    <label for="profile_picture">Foto de perfil</label>
                    <input type="file" class="form-control form-control-border" id="profile_picture" name="profile_picture" placeholder="Foto de perfil" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="status">Estado</label>
                    <select class='custom-select form-control-border' name="status">
                        <option value='1'>Activo</option>
                        <option value='0'>Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary" name="add-user" id="add-user_btn" value="Guardar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script>
    //File Validation
var uploadField2 = document.getElementById("profile_picture");

uploadField2.onchange = function() {
    if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png'){
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: '¡El archivo no es una imagen!'
                })
                });

                });
       this.value = "";
    };
    if(this.files[0].size > 2097152){
//       alert("File is too big! Please select image less than 2mb.");
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: '¡La imagen pesa más de 2mb!'
                })
                });

                });
       this.value = "";
    };
};
</script>
<script>
    $(document).ready(function(){
        
        $("#username").keyup(function(){
                    
            var username = $(this).val().trim();
            
            if(username != ''){
            
                $.ajax({
                    url: 'check-username.php',
                    type: 'post',
                    data: {username: username},
                    success: function(response){
                
                        $('#response').html(response);
                
                    }
                });
            }else{
                $("#response").html("");
            }
                
                });

            });
    
    $(document).ready(function(){
        
        $("#email").keyup(function(){
                    
            var email = $(this).val().trim();
            if(email != ''){
            
                $.ajax({
                    url: 'check-email.php',
                    type: 'post',
                    data: {email: email},
                    success: function(response_email){
                
                        $('#response_email').html(response_email);
                
                    }
                });
            }else{
                $("#response_email").html("");
            }
                
                });

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