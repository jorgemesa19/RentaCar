<div class="modal fade" id="add-owner">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="owner_name">Nombre del propietario</label>
                        <input type="text" class="form-control form-control-border" id="owner_name" name="owner_name" placeholder="Nombre del dueño" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Dirección" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contacto</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" placeholder="Contacto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_image">Imagen de perfil</label>
                        <input type="file" class="form-control form-control-border" id="profile_image" name="profile_image" placeholder="Imagen de perfil" accept="image/*" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fb_account">Email</label>
                        <input type="text" class="form-control form-control-border" id="fb_account" name="fb_account" placeholder="Email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control form-control-border" id="username" name="username" placeholder="Nombre de usuario" required>
                        <div id="response_username"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control form-control-border" id="password" name="password" placeholder="Contraseña" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="account_status">Estado de cuenta</label>
                        <select class='custom-select form-control-border' name="account_status">
                            <option value='1'>Activo</option>
                            <option value='0'>Inactivo</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-primary " id="add-owner_btn" name="add-owner" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    
$(document).ready(function(){
    $("#username").keyup(function(){
        var username = $(this).val().trim();
        if(username != ''){
            $.ajax({
                url: 'check-username.php',
                type: 'post',
                data: {username: username},
                success: function(response_username){
                    $('#response_username').html(response_username);
                }
            });
        } else{ $("#response_username").html(""); }
    });
});
</script>