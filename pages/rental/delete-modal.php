<div class='modal fade' id='delete-rental-<?php echo $rental_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal">
          <div class="modal-content ">
            <div class="modal-body">
                <input type="text" class="form-control" name="rental_id" value="<?php echo $rental_id ?>" hidden>
                ¿Está seguro de eliminar la renta de <?php echo $customer_name ?>?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-danger" name="delete-rental" value="Eliminar">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->