      <div class="modal fade" id="add-api">
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="api_code">API Code</label>
                    <input type="text" class="form-control form-control-border" id="api_code" name="api_code" placeholder="API Code" required>
                </div>
                <div class="form-group">
                    <label for="api_password">API Password</label>
                    <input type="text" class="form-control form-control-border" id="api_password" name="api_password" placeholder="API Password" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-flat" name="add-api" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->