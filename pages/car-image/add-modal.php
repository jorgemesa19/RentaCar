<div class="modal fade" id="add-carimage">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="image_description">Image Description</label>
                        <textarea class="form-control form-control-border" rows="3" id="image_description" name="image_description" placeholder="Image Description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control form-control-border" id="image" name="image" placeholder="Picture" accept="image/*" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-carimage_btn" name="add-carimage" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->