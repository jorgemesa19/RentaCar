<div class="modal fade" id="add-owner">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="owner_name">Owner Name</label>
                        <input type="text" class="form-control form-control-border" id="owner_name" name="owner_name" placeholder="Customer Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" placeholder="Contact" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control form-control-border" id="profile_image" name="profile_image" placeholder="Profile Picture" accept="image/*" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fb_account">FB Account</label>
                        <input type="text" class="form-control form-control-border" id="fb_account" name="fb_account" placeholder="FB Account" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-border" id="username" name="username" placeholder="Username" required>
                        <div id="response_username"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control form-control-border" id="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="account_status">Account Status</label>
                        <select class='custom-select form-control-border' name="account_status">
                            <option value='1'>Active</option>
                            <option value='0'>Inactive</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-owner_btn" name="add-owner" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    
$(document).ready(function(){
    $("#username").keyup(function(){
        var username = $(this).val().trim();
        if(username != ''){
            $.ajax({
                url: 'check-username.php',
                type: 'post',
                data: {username: username},
                success: function(response_username){
                    $('#response_username').html(response_username);
                }
            });
        } else{ $("#response_username").html(""); }
    });
});
</script>