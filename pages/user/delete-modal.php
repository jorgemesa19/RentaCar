<div class='modal fade' id='delete-brgy-<?php echo $brgy_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="brgy_id" value="<?php echo $brgy_id ?>" hidden>
                <?php echo "¿Estás seguro de borrar <b>$brgy_name<b>?" ?>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-danger btn-flat" name="delete-brgy" value="Eliminar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->