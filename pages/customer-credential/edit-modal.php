<div class="modal fade" id="edit-customercredential-<?php echo $credential_id;?>">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="credential_name">Nombre de la credencial</label>
                        <input type="text" class="form-control form-control-border" id="credential_name" name="credential_name" value="<?php echo $credential_name; ?>" placeholder="Nombre de la credencial" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="text"  name="credential_id" value="<?php echo $credential_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-customercredential_btn" name="edit-customercredential" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->