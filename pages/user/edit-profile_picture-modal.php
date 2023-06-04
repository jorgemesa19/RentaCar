<div class='modal fade' id='edit-profile_picture-<?php echo $user_id; ?>'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="profile_picture<?php echo $user_id; ?>">Selecionar nueva imagen para <?php echo "<b>$firstname $middlename $lastname</b>"; ?></label>
                    <input type="file" class="form-control form-control-border" id="profile_picture<?php echo $user_id; ?>" name="profile_picture" accept="image/*" required>
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="old_profile_picture" value="<?php echo $profile_picture; ?>" hidden>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary" name="edit-profile_picture" value="Guardar">
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
var uploadField<?php echo $user_id; ?> = document.getElementById("profile_picture<?php echo $user_id; ?>");

uploadField<?php echo $user_id; ?>.onchange = function() {
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
                title: 'File is not an Image'
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
                title: 'Imagen muy grande, el máximo permitido es de 2mb.'
                })
                });

                });
       this.value = "";
    };
};
</script>