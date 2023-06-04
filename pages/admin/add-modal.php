<div class="modal fade" id="add-admin">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="number" class="form-control form-control-border" id="contact" name="contact" placeholder="Contact" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required></textarea>
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
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-admin_btn" name="add-admin" value="Save">
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