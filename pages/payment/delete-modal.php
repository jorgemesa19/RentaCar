<div class='modal fade' id='delete-payment-<?php echo $payment_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="payment_id" value="<?php echo $payment_id ?>" hidden>
                <input type="text" class="form-control" name="rental_id" value="<?php echo $rental_id ?>" hidden>
                <input type="text" name="old_proof_of_payment" value="<?php echo $proof_of_payment; ?>" hidden>
                Are you sure you want to delete?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" name="delete-payment" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->