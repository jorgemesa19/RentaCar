<div class="modal fade" id="edit-customer-<?php echo $customer_id;?>">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="customer_name">Nombre del cliente</label>
                        <input type="text" class="form-control form-control-border" id="customer_name" name="Nombre del cliente" value="<?php echo $customer_name;?>" placeholder="Nombre del cliente" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address"  placeholder="Dirección" required><?php echo $address;?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contacto</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact;?>" placeholder="Contacto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fb_account">Email</label>
                        <input type="text" class="form-control form-control-border" id="fb_account" name="fb_account" value="<?php echo $fb_account;?>" placeholder="Email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username;?>" placeholder="Nombre del usuario" required>
                        <div id="response_username"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control form-control-border" id="password" name="password" value="<?php echo $password;?>" placeholder="Contraseña" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="account_status">Estado de cuenta</label>
                        <select class='custom-select form-control-border' name="account_status">
                            <?php
                            if ($account_status == 1){
                                echo "
                                <option value='1'>Activo</option>
                                <option value='0'>Inactivo</option>";
                            } else {
                                echo "
                                <option value='0'>Inactivo</option>
                                <option value='1'>Activo</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="text"  name="customer_id" value="<?php echo $customer_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-customer_btn" name="edit-customer" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->