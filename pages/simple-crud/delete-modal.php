<div class='modal fade' id='delete-simple_crud-<?php echo $s_crud_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="s_crud_id" value="<?php echo $s_crud_id ?>" hidden>
                <input type="text" class="form-control" name="text" value="<?php echo $text ?>" hidden>
                Esta seguro de que quiere eliminar <b><?php echo $text;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" name="delete-simple_crud" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->