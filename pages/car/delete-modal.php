<div class='modal fade' id='delete-car-<?php echo $car_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="car_id" value="<?php echo $car_id ?>" hidden>
                <input type="text" name="old_proof_of_ownership" value="<?php echo $proof_of_ownership; ?>" hidden>
                Are you sure you want to delete <b><?php echo $car_name;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-danger" name="delete-car" value="Delete">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->