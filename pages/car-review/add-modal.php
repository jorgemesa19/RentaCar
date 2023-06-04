<div class="modal fade" id="add-carreview">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="review">Review</label>
                        <textarea class="form-control form-control-border" rows="3" id="review" name="review" placeholder="Review" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="review_score">Review Score</label>
                        <input type="number" class="form-control form-control-border" id="review_score" name="review_score" placeholder="Review Score" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select class='custom-select form-control-border' name="customer_id">
                            <?php
                            $cn = new mysqli (HOST, USER, PW, DB);
                            if ($_SESSION['user_type'] == "Administrator"){
                                $sql="SELECT customer_id, customer_name FROM tblcustomer";
                            }
                            if ($_SESSION['user_type'] == "Customer"){
                                $customer_id = $_SESSION['user_id'];
                                $sql="SELECT customer_id, customer_name FROM tblcustomer WHERE customer_id = $customer_id";
                            }
                            $qry=$cn->prepare($sql);
                            $qry->execute();
                            $qry->bind_result($customer_id, $customer_name);
                            $qry->store_result();
                            while ($qry->fetch()){
                                echo " <option value='$customer_id'>$customer_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-carreview_btn" name="add-carreview" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->