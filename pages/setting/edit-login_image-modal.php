<div class='modal fade' id='edit-login_image'>
        <div class="modal-dialog modal-md">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="login_image">Seleccionar imagen</label>
                    <input type="file" class="form-control form-control-border" id="login_image" name="login_image" accept="image/*" required>
                    <input type="text" name="setting_id" value="<?php echo $setting_id;?>" hidden>
                    <input type="text" name="old_login_image" value="<?php echo $login_image; ?>" hidden>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-primary btn-flat" name="edit-login_image" value="Guardar">
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
var uploadField = document.getElementById("login_image");

uploadField.onchange = function() {
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
                title: '¡El archivo no es una imagen!'
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
                title: '¡La imagen pesa más de 2mb!'
                })
                });

                });
       this.value = "";
    };
};
</script>