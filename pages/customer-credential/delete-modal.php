<div class='modal fade' id='delete-customercredential-<?php echo $credential_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="credential_id" value="<?php echo $credential_id ?>" hidden>
                <input type="text" name="old_file_upload" value="<?php echo $file_upload; ?>" hidden>
                Are you sure you want to delete?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" name="delete-customercredential" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->