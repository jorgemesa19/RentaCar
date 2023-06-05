<?php
// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

?>

<div class="modal fade" id="add-car">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="car_name">Nombre del carro</label>
                        <input type="text" class="form-control form-control-border" id="car_name" name="car_name" placeholder="Nombre del carro" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control form-control-border" rows="3" id="description" name="description" placeholder="Descripción" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="car_model_year">Modelo (año)</label>
                        <input type="text" class="form-control form-control-border" id="car_model_year" name="car_model_year" placeholder="Modelo (año)" required>
                    </div>

                    <div class="form-group">
                        <label for="car_brand">Marca</label>
                        <input type="text" class="form-control form-control-border" id="car_brand" name="car_brand" placeholder="Marca" required>
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control form-control-border" id="color" name="color" placeholder="Color" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacidad (número)</label>
                        <input type="text" class="form-control form-control-border" id="capacity" name="capacity" placeholder="Capacidad (número)" required>
                    </div>

                    <div class="form-group">
                        <label for="plate_number">Placa del vehiculo</label>
                        <input type="text" class="form-control form-control-border" id="plate_number" name="plate_number" placeholder="Placa del vehiculo" required>
                    </div>

                    <div class="form-group">
                        <label for="rate">Calificación</label>
                        <input type="text" class="form-control form-control-border" id="rate" name="rate" placeholder="Calificación" required>
                    </div>

                    <div class="form-group">
                        <label for="owner_id">Propietario</label>
                        <select class='custom-select form-control-border' name="owner_id">
                            <?php
                            $sql = "";
                            if ($_SESSION['user_type'] == "Administrator") {
                                $sql = "SELECT owner_id, owner_name FROM tblowner";
                            } elseif ($_SESSION['user_type'] == "Owner") {
                                $owner_id = $_SESSION['user_id'];
                                $sql = "SELECT owner_id, owner_name FROM tblowner WHERE owner_id = $owner_id";
                            }

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($result as $row) {
                                $owner_id = $row['owner_id'];
                                $owner_name = $row['owner_name'];
                                echo "<option value='$owner_id'>$owner_name</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select class='custom-select form-control-border' name="status">
                            <option value='1'>Disponible</option>
                            <option value='0'>No disponible</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="proof_of_ownership">Prueba de propiedad</label>
                        <input type="file" class="form-control form-control-border" id="proof_of_ownership" name="proof_of_ownership" accept="image/*" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-primary" id="add-car_btn" name="add-car" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $("#username").keyup(function(){
            var username = $(this).val().trim();
            if(username != ''){
                $.ajax({
                    url: 'check-username.php',
                    type: 'post',
                    data: {username: username},
                    success: function(response_username){
                        $('#response_username').html(response_username);
                    }
                });
            } else {
                $("#response_username").html("");
            }
        });
    });
</script>
