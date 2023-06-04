<div class='modal fade' id='edit-proof_of_ownership-<?php echo $car_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="proof_of_ownership<?php echo $car_id; ?>">Escoger nueva foto  <?php echo "<b>$car_name</b>"; ?></label>
                    <input type="file" class="form-control form-control-border" id="proof_of_ownership<?php echo $car_id; ?>" name="proof_of_ownership" accept="image/*" required>
                    <input type="text" name="car_id" value="<?php echo $car_id; ?>" hidden>
                    <input type="text" name="old_proof_of_ownership" value="<?php echo $proof_of_ownership; ?>" hidden>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary" name="edit-proof_of_ownership" value="Save">
            </div>
          </div>
            </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<script>
    //File Validation
var uploadField<?php echo $car_id; ?> = document.getElementById("proof_of_ownership<?php echo $car_id; ?>");

uploadField<?php echo $car_id; ?>.onchange = function() {
    if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png'){
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'El archivo no es una imagen'
                })
                });

                });
       this.value = "";
    };
    if(this.files[0].size > 2097152){
//       alert("File is too big! Please select image less than 2mb.");
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'La imagen excede los 2mb.'
                })
                });

                });
       this.value = "";
    };
};
</script>