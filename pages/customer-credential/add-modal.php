<div class="modal fade" id="add-customercredential">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="credential_name">Credential Name</label>
                        <input type="text" class="form-control form-control-border" id="credential_name" name="credential_name" placeholder="Credential Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="file_upload">File Upload</label>
                        <input type="file" class="form-control form-control-border" id="file_upload" name="file_upload" required>
                    </div>
                                
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-customercredential_btn" name="add-customercredential" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->