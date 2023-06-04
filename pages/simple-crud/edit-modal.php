<div class="modal fade" id="edit-simple_crud-<?php echo $s_crud_id;?>">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="text">Text</label>
                        <input type="text" class="form-control form-control-border" id="text" name="text" placeholder="Text" value="<?php echo $text;?>" required>
                        <div id="response"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="text_area">Textarea</label>
                        <textarea class="form-control form-control-border" rows="3" id="text_area" name="text_area" placeholder="Textarea" required><?php echo $text_area;?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Dropdown</label>
                        <select class="form-control select2" id="dropdown" name="dropdown" required>
                            <?php
                            if ($dropdown == 0){ echo ""; }
                            if ($dropdown == 1){ echo "<option value='1'>1st</option>"; }
                            if ($dropdown == 2){ echo "<option value='2'>2nd</option>"; }
                            if ($dropdown == 3){ echo "<option value='3'>3rd</option>"; }
                            if ($dropdown == 4){ echo "<option value='4'>4th</option>"; }
                            ?>
                            <option value='1'>1st</option>
                            <option value='2'>2nd</option>
                            <option value='3'>3rd</option>
                            <option value='4'>4th</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="text"  name="s_crud_id" value="<?php echo $s_crud_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-simple_crud_btn" name="edit-simple_crud" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->