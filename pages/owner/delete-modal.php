<div class='modal fade' id='delete-owner-<?php echo $owner_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="owner_id" value="<?php echo $owner_id ?>" hidden>
                <input type="text" class="form-control" name="old_profile_image" value="<?php echo $profile_image ?>" hidden>
                Are you sure you want to delete <b><?php echo $owner_name;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" name="delete-owner" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->