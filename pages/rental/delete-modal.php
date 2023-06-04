<?php
// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

// Verificar si la conexión fue exitosa
?>

<div class='modal fade' id='delete-rental-<?php echo $rental_id; ?>'>
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="text" class="form-control" name="rental_id" value="<?php echo $rental_id ?>" hidden>
                    Esta seguro de que quiere eliminar
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger" name="delete-rental" value="Delete">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
