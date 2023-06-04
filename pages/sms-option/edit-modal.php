      <div class="modal fade" id="edit-api">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="api_code">API Code</label>
                    <input type="text" class="form-control form-control-border" id="api_code" name="api_code" value="<?php echo $api_code; ?>" required>
                    <input type="text"  name="sms_id" value="<?php echo $sms_id; ?>" hidden>
                </div>
                <div class="form-group">
                    <label for="api_password">API Password</label>
                    <input type="text" class="form-control form-control-border" id="api_password" name="api_password" value="<?php echo $api_password; ?>" required>
                </div>
                <div class="form-group">
                    <label for="enabled">Status</label>
                    <select class="form-control form-control-border" name="enabled">
                        <?php
                        if ($enabled == 1){
                            echo "<option value='1'>Enable</option>
                            <option value='0'>Disable</option>";
                        }
                        else if ($enabled == 0){
                            echo "
                            <option value='0'>Disable</option>
                            <option value='1'>Enable</option>";
                        }
                        ?>
                        
                    </select>
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