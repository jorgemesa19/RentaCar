      <div class="modal fade" id="edit-api">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group" class="text-black">
                    <label for="api_code">API Code</label>
                    <input type="text" class="form-control form-control-border" id="api_code" name="api_code" value="<?php echo $api_code; ?>" required>
                    <input type="text" name="s_option_id" value="<?php echo $s_option_id; ?>" hidden>
                </div>
                <div class="form-group" class="text-black">
                    <label for="api_password">API Password</label>
                    <input type="text" class="form-control form-control-border" id="api_password" name="api_password" value="<?php echo $api_password; ?>" required>
                </div>
                <div class="form-group" class="text-black">
                    <label for="enabled">Status</label>
                    <select class="form-control" name="enabled">
                        <?php
                        if ($enabled==1){
                            echo "<option value='1'>Enable</option>
                                    <option value='2'>Disable</option>";
                        }
                        else{
                            echo " <option value='2'>Disable</option>
                                    <option value='1'>Enable</option>";
                        }
                        ?>
                        
                    </select>
                </div>
                <div class="form-group" class="text-black">
                    <label for="expiration_date">Expiration Date</label>
                    <input type="date" class="form-control form-control-border" id="expiration_date" name="expiration_date" min="<?php echo date('Y-m-d');?>" value="<?php echo $expiration_date; ?>" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-flat" name="edit-api" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
