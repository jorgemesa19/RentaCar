<div class='modal fade' id='view-proof_of_payment-<?php echo $payment_id; ?>'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <?php
                // Parámetros de conexión a la base de datos
                $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                $user = "postgres"; // Nombre de usuario de la base de datos
                $password = "9090"; // Contraseña de la base de datos
                $dbname = "bd_rentaCar"; // Nombre de la base de datos

                try {
                    // Establecer la conexión
                    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                    // Establecer el modo de error de PDO a excepciones
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para obtener la ruta de la imagen de comprobante de pago
                    $query = "SELECT proof_of_payment FROM tblpayment WHERE payment_id = :payment_id";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':payment_id', $payment_id);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $proof_of_payment = $row['proof_of_payment'];

                    echo "<img src='../uploads/$proof_of_payment' class='img' style='width:100%;' alt='Image'>";
                } catch (PDOException $e) {
                    echo "Error de conexión: " . $e->getMessage();
                }
                ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
