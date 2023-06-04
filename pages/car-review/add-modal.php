<div class="modal fade" id="add-carreview">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="review">Revisión</label>
                        <textarea class="form-control form-control-border" rows="3" id="review" name="review" placeholder="Revisión" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="review_score">Puntaje de la revisión</label>
                        <input type="number" class="form-control form-control-border" id="review_score" name="review_score" placeholder="Puntaje de la revisión" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_id">Cliente</label>
                        <select class='custom-select form-control-border' name="customer_id">
                            <?php
                            $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
                            $user = "postgres"; // Nombre de usuario de la base de datos
                            $password = "9090"; // Contraseña de la base de datos
                            $dbname = "bd_rentaCar"; // Nombre de la base de datos

                            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

                            if ($_SESSION['user_type'] == "Administrator") {
                                $sql = "SELECT customer_id, customer_name FROM tblcustomer";
                            }
                            if ($_SESSION['user_type'] == "Customer") {
                                $customer_id = $_SESSION['user_id'];
                                $sql = "SELECT customer_id, customer_name FROM tblcustomer WHERE customer_id = $customer_id";
                            }

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $row) {
                                $customer_id = $row['customer_id'];
                                $customer_name = $row['customer_name'];
                                echo "<option value='$customer_id'>$customer_name</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-primary " id="add-carreview_btn" name="add-carreview" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
