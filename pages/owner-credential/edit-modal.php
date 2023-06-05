<div class="modal fade" id="edit-ownercredential-<?php echo $owner_credential_id;?>">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="credential_name">Nombre de la credencial</label>
                        <input type="text" class="form-control form-control-border" id="credential_name" name="credential_name" value="<?php echo $credential_name; ?>" placeholder="Nombre credencial" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="text"  name="owner_credential_id" value="<?php echo $owner_credential_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-ownercredential_btn" name="edit-ownercredential" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->