<?php 
if (isset($_POST['add-carreview'])) {
    
    $review = $_POST['review'];
    $review_score = $_POST['review_score'];
    $date = date('Y-m-d');
    $customer_id = $_POST['customer_id'];
    $car_id = $_GET['car_id'];
    
    // Establecer la conexión
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "INSERT INTO tblcarreview (review_id, review, review_score, date, customer_id, car_id) VALUES (DEFAULT,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $review);
    $stmt->bindParam(2, $review_score);
    $stmt->bindParam(3, $date);
    $stmt->bindParam(4, $customer_id);
    $stmt->bindParam(5, $car_id);
    
    if ($stmt->execute()){
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=success';</script>";        
    } else {
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    } 
    
}


if(isset($_POST['edit-carreview'])){
    
    $review_id = $_POST['review_id'];
    $review = $_POST['review'];
    $review_score = $_POST['review_score'];
    $customer_id = $_POST['customer_id'];
            
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "UPDATE tblcarreview SET review = ?, review_score = ?, customer_id = ? WHERE review_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $review);
    $stmt->bindParam(2, $review_score);
    $stmt->bindParam(3, $customer_id);
    $stmt->bindParam(4, $review_id);
    
    if ($stmt->execute()){
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    }
}

if(isset($_POST['delete-carreview'])){
    
    $review_id = $_POST['review_id'];

    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "DELETE FROM tblcarreview WHERE review_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $review_id);
    
    if ($stmt->execute()){
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
    }
    else {
        echo "<script>window.location.href = 'car-review.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    } 
}
?>
