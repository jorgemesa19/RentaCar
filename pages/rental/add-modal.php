<div class="modal fade" id="add-rental">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="rental_date">Rental Date</label>
                        <input type="date" class="form-control form-control-border" id="rental_date" name="rental_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rental_time">Rental Time</label>
                        <input type="time" class="form-control form-control-border" id="rental_time" name="rental_time" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="return_date">Return Date</label>
                        <input type="date" class="form-control form-control-border" id="return_date" name="return_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="car_id">Car</label>
                        <select class='custom-select form-control-border' name="car_id">
                            <?php
                            $host = "localhost";
                            $user = "postgres";
                            $password = "9090";
                            $dbname = "bd_rentaCar";
                            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

                            $sql = "SELECT car_id, car_name FROM tblcar WHERE status = 1";
                            $stmt = $conn->query($sql);
                            while ($row = $stmt->fetch()) {
                                $car_id = $row['car_id'];
                                $car_name = $row['car_name'];
                                echo "<option value='$car_id'>$car_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select class='custom-select form-control-border' name="customer_id">
                            <?php
                            if ($_SESSION['user_type'] == "Administrator") {
                                $sql = "SELECT customer_id, customer_name FROM tblcustomer";
                            }
                            if ($_SESSION['user_type'] == "Customer") {
                                $customer_id = $_SESSION['user_id'];
                                $sql = "SELECT customer_id, customer_name FROM tblcustomer WHERE customer_id = $customer_id";
                            }
                            $stmt = $conn->query($sql);
                            while ($row = $stmt->fetch()) {
                                $customer_id = $row['customer_id'];
                                $customer_name = $row['customer_name'];
                                echo "<option value='$customer_id'>$customer_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="rental_status">Rental Status</label>
                        <select class='custom-select form-control-border' name="rental_status">
                            <option value='1'>Available</option>
                            <option value='0'>Unavailable</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-rental_btn" name="add-rental" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
