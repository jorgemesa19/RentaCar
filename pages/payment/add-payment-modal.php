<?php
// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

?>

<div class="modal fade" id="add-payment">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="payment_amount">Monto de pago (COP)</label>
                        <input type="number" class="form-control form-control-border" id="payment_amount" name="payment_amount" placeholder="Monto de pago (COP)" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="add_charges">Añadir cargos adicionales (COP)</label>
                        <input type="number" class="form-control form-control-border" id="add_charges" name="add_charges" placeholder="Añadir cargos adicionales (COP)" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="payment_date">Fecha de pago</label>
                        <input type="date" class="form-control form-control-border" id="payment_date" name="payment_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="proof_of_payment">Comprobante de pago</label>
                        <input type="file" class="form-control form-control-border" id="proof_of_payment" name="proof_of_payment" accept="image/*" required>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="text" name="rental_id" value="<?php echo $rental_id;?>" hidden>
                    <input type="text" name="customer_id" value="<?php echo $customer_id;?>" hidden>
                    <input type="submit" class="btn btn-primary " id="add-payment_btn" name="add-payment" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
