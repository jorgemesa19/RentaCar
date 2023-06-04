<div class="modal fade" id="add-customer">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="customer_name">Nombre del cliente</label>
                        <input type="text" class="form-control form-control-border" id="customer_name" name="customer_name" placeholder="Nombre del cliente" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Durección</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Dirección" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contacto</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" placeholder="Contacto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_image">Perfil imagen</label>
                        <input type="file" class="form-control form-control-border" id="profile_image" name="profile_image" placeholder="Perfil imagen" accept="image/*" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fb_account">Cuenta FB</label>
                        <input type="text" class="form-control form-control-border" id="fb_account" name="fb_account" placeholder="Cuenta FB" required>
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
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-customer_btn" name="add-customer" value="Save">
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