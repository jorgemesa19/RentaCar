<div class='modal fade' id='delete-admin-<?php echo $admin_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="admin_id" value="<?php echo $admin_id ?>" hidden>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" hidden>
                Estas seguro de que quieres eliminar? <b><?php echo $name;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-danger" name="delete-admin" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->