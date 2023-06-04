<?php
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

if (isset($_POST['add-car'])) {
    $temp = explode(".", $_FILES["proof_of_ownership"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["proof_of_ownership"]["name"]);

    if (move_uploaded_file($_FILES["proof_of_ownership"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["proof_of_ownership"]["name"]);
        $newfilename = $filename . $newfilename;

        $car_name = $_POST['car_name'];
        $description = $_POST['description'];
        $car_model_year = $_POST['car_model_year'];
        $car_brand = $_POST['car_brand'];
        $color = $_POST['color'];
        $capacity = $_POST['capacity'];
        $plate_number = $_POST['plate_number'];
        $rate = $_POST['rate'];
        $owner_id = $_POST['owner_id'];
        $status = $_POST['status'];
        $proof_of_ownership = $newfilename;

        // Establecer la conexión
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

        $sql = "INSERT INTO tblcar (car_id, car_name, description, car_model_year, car_brand, color, capacity, plate_number, rate, owner_id, status, proof_of_ownership) VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?)";
        $qry = $conn->prepare($sql);
        $qry->execute([$car_name, $description, $car_model_year, $car_brand, $color, $capacity, $plate_number, $rate, $owner_id, $status, $proof_of_ownership]);

        if ($qry->rowCount() > 0) {
            echo "<script>window.location.href = 'car.php?status=success';</script>";
        } else {
            echo "<script>window.location.href = 'car.php?status=failed';</script>";
        }
    } else {
        echo "<script>window.location.href = 'car.php?status=failed-upload';</script>";
    }
}


if (isset($_POST['edit-car'])) {
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $description = $_POST['description'];
    $car_model_year = $_POST['car_model_year'];
    $car_brand = $_POST['car_brand'];
    $color = $_POST['color'];
    $capacity = $_POST['capacity'];
    $plate_number = $_POST['plate_number'];
    $rate = $_POST['rate'];
    $owner_id = $_POST['owner_id'];
    $status = $_POST['status'];

    // Establecer la conexión
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "UPDATE tblcar SET car_name = ?, description = ?, car_model_year = ?, car_brand = ?, color = ?, capacity = ?, plate_number = ?, rate = ?, owner_id = ?, status = ?  WHERE car_id = ?";
    $qry = $conn->prepare($sql);
    $qry->execute([$car_name, $description, $car_model_year, $car_brand, $color, $capacity, $plate_number, $rate, $owner_id, $status, $car_id]);

    if ($qry->rowCount() > 0) {
        echo "<script>window.location.href = 'car.php?status=success';</script>";
    } else {
        echo "<script>window.location.href = 'car.php?status=failed';</script>";
    }
}

if (isset($_POST['delete-car'])) {
    $car_id = $_POST['car_id'];

    // Establecer la conexión
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $sql = "SELECT image FROM tblcarimage WHERE car_id = ?";
    $qry = $conn->prepare($sql);
    $qry->execute([$car_id]);

    $images = $qry->fetchAll(PDO::FETCH_COLUMN);
    foreach ($images as $image) {
        unlink("../uploads/$image");
    }

    $sql = "DELETE FROM tblcar WHERE car_id=?";
    $qry = $conn->prepare($sql);
    $qry->execute([$car_id]);

    if ($qry->rowCount() > 0) {
        $old_proof_of_ownership = $_POST['old_proof_of_ownership'];
        if ($old_proof_of_ownership != 'img-default.jpg') {
            unlink("../uploads/$old_proof_of_ownership");
        }

        $sql = "DELETE FROM tblcarimage WHERE car_id=?";
        $qry = $conn->prepare($sql);
        $qry->execute([$car_id]);

        $sql = "DELETE FROM tblcarreview WHERE car_id=?";
        $qry = $conn->prepare($sql);
        $qry->execute([$car_id]);

        echo "<script>window.location.href = 'car.php?status=success';</script>";
    } else {
        echo "<script>window.location.href = 'car.php?status=failed';</script>";
    }
}

if (isset($_POST['edit-proof_of_ownership'])) {
    $temp = explode(".", $_FILES["proof_of_ownership"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["proof_of_ownership"]["name"]);

    if (move_uploaded_file($_FILES["proof_of_ownership"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["proof_of_ownership"]["name"]);
        $newfilename = $filename . $newfilename;

        $car_id = $_POST['car_id'];
        $proof_of_ownership = $newfilename;
        $old_proof_of_ownership = $_POST['old_proof_of_ownership'];

        // Establecer la conexión
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

        $sql = "UPDATE tblcar SET proof_of_ownership = ? WHERE car_id = ?";
        $qry = $conn->prepare($sql);
        $qry->execute([$proof_of_ownership, $car_id]);

        if ($qry->rowCount() > 0) {
            echo "<script>window.location.href = 'car.php?status=success';</script>";

            if ($old_proof_of_ownership != 'img-default.jpg') {
                unlink("../uploads/$old_proof_of_ownership");
            }
        } else {
            echo "<script>window.location.href = 'car.php?status=failed';</script>";
        }
    }
}
?>
