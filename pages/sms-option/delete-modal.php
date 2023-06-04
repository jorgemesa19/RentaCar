<?php echo "<div class='modal fade' id='delete-api'>" ?>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                    <input type="text" name="s_option_id" value="<?php echo $s_option_id ?>" hidden>
                <?php echo "Are you sure you want to delete API?" ?>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger btn-flat" name="delete-api" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->