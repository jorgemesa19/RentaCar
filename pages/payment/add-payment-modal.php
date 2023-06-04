<div class="modal fade" id="add-payment">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="payment_amount">Payment Amount</label>
                        <input type="number" class="form-control form-control-border" id="payment_amount" name="payment_amount" placeholder="Payment Amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="add_charges">Add Charges</label>
                        <input type="number" class="form-control form-control-border" id="add_charges" name="add_charges" placeholder="Add Charges" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="date" class="form-control form-control-border" id="payment_date" name="payment_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="proof_of_payment">Proof of Payment</label>
                        <input type="file" class="form-control form-control-border" id="proof_of_payment" name="proof_of_payment" accept="image/*" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="text" name="rental_id" value="<?php echo $rental_id;?>" hidden>
                    <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="add-payment_btn" name="add-payment" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->