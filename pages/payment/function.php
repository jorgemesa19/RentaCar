<?php
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);


if (isset($_POST['add-payment'])) {

    $temp = explode(".", $_FILES["proof_of_payment"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["proof_of_payment"]["name"]);

    if (move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["proof_of_payment"]["name"]);
        $newfilename = $filename . $newfilename;

        $payment_id = null;
        $rental_id = $_POST['rental_id'];
        $payment_amount = $_POST['payment_amount'];
        $add_charges = $_POST['add_charges'];
        $payment_date = $_POST['payment_date'];
        $proof_of_payment = $newfilename;
        $customer_id = $_POST['customer_id'];

        $sql = "INSERT INTO tblpayment VALUES (?,?,?,?,?,?,?)";
        $qry = $conn->prepare($sql);
        $qry->bindParam(1, $payment_id);
        $qry->bindParam(2, $rental_id);
        $qry->bindParam(3, $payment_amount);
        $qry->bindParam(4, $add_charges);
        $qry->bindParam(5, $payment_date);
        $qry->bindParam(6, $proof_of_payment);
        $qry->bindParam(7, $customer_id);

        if ($qry->execute()) {

            $sql = "SELECT car_id FROM tblrental WHERE rental_id = ?";
            $qry = $conn->prepare($sql);
            $qry->bindParam(1, $rental_id);
            $qry->execute();
            $car_id = $qry->fetchColumn();

            $sql = "UPDATE tblcar SET status = 1 WHERE car_id = ?";
            $qry = $conn->prepare($sql);
            $qry->bindParam(1, $car_id);
            $qry->execute();

            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=success';</script>";
        } else {
            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=failed';</script>";
        }
    } else {
        echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=failed-upload';</script>";
    }
}

if (isset($_POST['delete-payment'])) {

    $payment_id = $_POST['payment_id'];
    $rental_id = $_POST['rental_id'];

    $sql = "DELETE FROM tblpayment WHERE payment_id=?";
    $qry = $conn->prepare($sql);
    $qry->bindParam(1, $payment_id);

    if ($qry->execute()) {

        $old_proof_of_payment = $_POST['old_proof_of_payment'];
        if ($old_proof_of_payment != 'img-default.jpg') {
            //delete old proof_of_ownership
            unlink("../uploads/$old_proof_of_payment");
        }

        $sql = "SELECT car_id FROM tblrental WHERE rental_id = ?";
        $qry = $conn->prepare($sql);
        $qry->bindParam(1, $rental_id);
        $qry->execute();
        $car_id = $qry->fetchColumn();

        $sql = "UPDATE tblcar SET status = 0 WHERE car_id = ?";
        $qry = $conn->prepare($sql);
        $qry->bindParam(1, $car_id);
        $qry->execute();

        //            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=success';</script>";
    } else {
        //            echo "<script>window.location.href = 'add-payment.php?rental_id=$rental_id&customer_id=$customer_id&status=failed';</script>";
    }
}
?>
