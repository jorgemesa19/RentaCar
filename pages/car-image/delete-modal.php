<div class='modal fade' id='delete-carimage-<?php echo $image_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="image_id" value="<?php echo $image_id ?>" hidden>
                <input type="text" class="form-control" name="old_image" value="<?php echo $image ?>" hidden>
                Estas seguro de eliminar?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-danger" name="delete-carimage" value="Eliminar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->