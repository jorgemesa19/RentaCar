<?php 
if(isset($_POST['add-rental'])){
    
    $rental_date= $_POST['rental_date'];
    $rental_time= $_POST['rental_time'];
    $return_date= $_POST['return_date'];
    $car_id= $_POST['car_id'];
    $customer_id= $_POST['customer_id'];
    $rental_status= $_POST['rental_status'];
    
    $host = "localhost";
    $user = "postgres";
    $password = "9090";
    $dbname = "bd_rentaCar";
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "SELECT owner_id FROM tblcar WHERE car_id = :car_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':car_id', $car_id);
    $stmt->execute();
    $owner_id = $stmt->fetchColumn();
    
    $sql = "INSERT INTO tblrental (rental_uuid, rental_date, rental_time, return_date, owner_id, car_id, customer_id, rental_status)
        VALUES (:rental_uuid, :rental_date, :rental_time, :return_date, :owner_id, :car_id, :customer_id, :rental_status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rental_uuid', $rental_uuid);
        $stmt->bindParam(':rental_date', $rental_date);
        $stmt->bindParam(':rental_time', $rental_time);
        $stmt->bindParam(':return_date', $return_date);
        $stmt->bindParam(':owner_id', $owner_id);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':rental_status', $rental_status);

    
    if ($stmt->execute()){
        $sql = "UPDATE tblcar SET status = 0 WHERE car_id = :car_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->execute();
        
        echo "<script>window.location.href = 'rental.php?status=success';</script>";        
    } else {
        echo "<script>window.location.href = 'rental.php?status=failed';</script>";
    } 
}


if(isset($_POST['delete-rental'])){
    
    $rental_id= $_POST['rental_id'];
         
    $host = "localhost";
    $user = "postgres";
    $password = "9090";
    $dbname = "bd_rentaCar";
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    
    $sql = "DELETE FROM tblrental WHERE rental_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $rental_id);
    if ($stmt->execute()){
        
        $sql = "SELECT COUNT(payment_id) FROM tblpayment WHERE rental_id = $rental_id";
        $stmt = $conn->query($sql);
        $ct_payment_id = $stmt->fetchColumn();
        if ($ct_payment_id == 1){
            
            $sql = "SELECT proof_of_payment FROM tblpayment WHERE rental_id = $rental_id";
            $stmt = $conn->query($sql);
            $proof_of_payment = $stmt->fetchColumn();
                
            if ($proof_of_payment != 'img-default.jpg'){
                //delete old proof_of_payment
                unlink("../uploads/$proof_of_payment");
            }
                
            $sql = "DELETE FROM tblpayment WHERE rental_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $rental_id);
            $stmt->execute();
                
            echo "<script>window.location.href = 'rental.php?status=success';</script>"; 
        }         
    }
    else {
        echo "<script>window.location.href = 'rental.php?status=failed';</script>";
    }     
}

?>
