

<div class="modal fade" id="edit-email">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group" class="text-black">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username; ?>" required>
                    <input type="text"  name="e_option_id" value="<?php echo $e_option_id; ?>" hidden>
                </div>
                <div class="form-group" class="text-black">
                    <label for="password">Password</label>
                    <input type="text" class="form-control form-control-border" id="password" name="password" value="<?php echo $password; ?>" required>
                </div>
                <div class="form-group" class="text-black">
                    <label for="enabled">Status</label>
                    <select class="form-control" name="enabled">
                        <?php
                        if ($enabled==1){
                            echo "<option value='1'>Enable</option>
                                    <option value='0'>Disable</option>";
                        }
                        else{
                            echo " <option value='0'>Disable</option>
                                    <option value='1'>Enable</option>";
                        }
                        ?>
                        
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-flat" name="edit-email" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->