<div class="modal fade" id="add-car">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="car_name">Car Name</label>
                        <input type="text" class="form-control form-control-border" id="car_name" name="car_name" placeholder="Car Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control form-control-border" rows="3" id="description" name="description" placeholder="Description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="car_model_year">Model Year</label>
                        <input type="text" class="form-control form-control-border" id="car_model_year" name="car_model_year" placeholder="Model Year" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="car_brand">Brand</label>
                        <input type="text" class="form-control form-control-border" id="car_brand" name="car_brand" placeholder="Brand" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control form-control-border" id="color" name="color" placeholder="Color" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="text" class="form-control form-control-border" id="capacity" name="capacity" placeholder="Capacity" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="plate_number">Plate Number</label>
                        <input type="text" class="form-control form-control-border" id="plate_number" name="plate_number" placeholder="Plate Number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control form-control-border" id="rate" name="rate" placeholder="Rate" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="owner_id">Owner</label>
                        <select class='custom-select form-control-border' name="owner_id">
                            <?php
                            $cn = new mysqli (HOST, USER, PW, DB);
                            if ($_SESSION['user_type'] == "Administrator"){
                                $sql="SELECT owner_id, owner_name FROM tblowner";
                            }
                            if ($_SESSION['user_type'] == "Owner"){
                                $owner_id = $_SESSION['user_id'];
                                $sql="SELECT owner_id, owner_name FROM tblowner WHERE owner_id = $owner_id";
                            }
                            $qry=$cn->prepare($sql);
                            $qry->execute();
                            $qry->bind_result($owner_id, $owner_name);
                            $qry->store_result();
                            while ($qry->fetch()){
                                echo " <option value='$owner_id'>$owner_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class='custom-select form-control-border' name="status">
                            <option value='1'>Available</option>
                            <option value='0'>Not Available</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="proof_of_ownership">Proof of Ownership</label>
                        <input type="file" class="form-control form-control-border" id="proof_of_ownership" name="proof_of_ownership" p accept="image/*" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-car_btn" name="add-car" value="Save">
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