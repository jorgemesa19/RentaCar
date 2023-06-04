<div class="modal fade" id="edit-admin-<?php echo $admin_id;?>">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" value="<?php echo $name; ?>" placeholder="Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact; ?>" placeholder="Contact" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address" value="" placeholder="Address" required><?php echo $address; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username; ?>" placeholder="Username" required>
                        <div id="response_username"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control form-control-border" id="password" name="password" value="<?php echo $password; ?>" placeholder="Password" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="text"  name="admin_id" value="<?php echo $admin_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="edit-admin_btn" name="edit-admin" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->