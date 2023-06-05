<div class='modal fade' id='edit-file_upload-<?php echo $credential_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="file_upload<?php echo $credential_id; ?>">Seleccionar nuevo archivo</label>
                    <input type="file" class="form-control form-control-border" id="file_upload<?php echo $credential_id; ?>" name="file_upload" accept="image/*" required>
                    <input type="text" name="credential_id" value="<?php echo $credential_id; ?>" hidden>
                    <input type="text" name="old_file_upload" value="<?php echo $file_upload; ?>" hidden>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary" name="edit-file_upload" value="Guardar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->