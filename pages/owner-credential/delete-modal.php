<div class='modal fade' id='delete-ownercredential-<?php echo $owner_credential_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="owner_credential_id" value="<?php echo $owner_credential_id ?>" hidden>
                <input type="text" name="old_file_upload" value="<?php echo $file_upload; ?>" hidden>
                ¿Estás seguro de borrar <?php echo $credential_name ?>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-danger" name="delete-ownercredential" value="Eliminar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->