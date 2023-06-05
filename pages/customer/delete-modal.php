<div class='modal fade' id='delete-customer-<?php echo $customer_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="customer_id" value="<?php echo $customer_id ?>" hidden>
                <input type="text" class="form-control" name="name" value="<?php echo $customer_name ?>" hidden>
                <input type="text" class="form-control" name="old_profile_image" value="<?php echo $profile_image ?>" hidden>
                ¿Estás seguro de eliminar a <b><?php echo $customer_name;?></b>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-danger" name="delete-customer" value="Eliminar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->