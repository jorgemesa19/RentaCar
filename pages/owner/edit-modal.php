<div class="modal fade" id="edit-owner-<?php echo $owner_id;?>">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="owner_name">Nombre</label>
                        <input type="text" class="form-control form-control-border" id="owner_name" name="owner_name" value="<?php echo $owner_name;?>" placeholder="Customer Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address"  placeholder="Address" required><?php echo $address;?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contacto</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact;?>" placeholder="Contact" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fb_account">Cuenta de Facebook</label>
                        <input type="text" class="form-control form-control-border" id="fb_account" name="fb_account" value="<?php echo $fb_account;?>" placeholder="FB Account" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username;?>" placeholder="Username" required>
                        <div id="response_username"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control form-control-border" id="password" name="password" value="<?php echo $password;?>" placeholder="Password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="account_status">Estado de la cuenta</label>
                        <select class='custom-select form-control-border' name="account_status">
                            <?php
                            if ($account_status == 1){
                                echo "
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>";
                            } else {
                                echo "
                                <option value='0'>Inactive</option>
                                <option value='1'>Active</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="text"  name="owner_id" value="<?php echo $owner_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-owner_btn" name="edit-owner" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->