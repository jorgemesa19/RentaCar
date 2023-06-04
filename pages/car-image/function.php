<?php
// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

if (isset($_POST['add-carimage'])) {
    $temp = explode(".", $_FILES["image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["image"]["name"]);
        $newfilename = $filename . $newfilename;

        $image_id = null;
        $image_description = $_POST['image_description'];
        $image = $newfilename;
        $car_id = $_GET['car_id'];

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $sql = "INSERT INTO tblcarimage VALUES (?,?,?,?)";
        $qry = $conn->prepare($sql);
        $qry->bindParam(1, $image_id);
        $qry->bindParam(2, $image_description);
        $qry->bindParam(3, $image);
        $qry->bindParam(4, $car_id);
        if ($qry->execute()) {
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=success';</script>";
        } else {
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
        }
    } else {
        echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed-upload';</script>";
    }
}

if (isset($_POST['delete-carimage'])) {

    $image_id = $_POST['image_id'];

    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $sql = "DELETE FROM tblcarimage WHERE image_id=?";
    $qry = $conn->prepare($sql);
    $qry->bindParam(1, $image_id);
    if ($qry->execute()) {
        $old_image = $_POST['old_image'];
        if ($old_image != 'img-default.jpg') {
            // delete old image
            unlink("../uploads/$old_image");
        }
        echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=success';</script>";

    } else {
        echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
    }
}

if (isset($_POST['edit-image'])) {
    $temp = explode(".", $_FILES["image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["image"]["name"]);
        $newfilename = $filename . $newfilename;

        $image_id = $_POST['image_id'];
        $image = $newfilename;
        $old_image = $_POST['old_image'];

        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $sql = "UPDATE tblcarimage SET image = ? WHERE image_id = ?";
        $qry = $conn->prepare($sql);
        $qry->bindParam(1, $image);
        $qry->bindParam(2, $image_id);
        if ($qry->execute()) {
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=success';</script>";

            $old_image = $_POST['old_image'];
            if ($old_image != 'img-default.jpg') {
                // delete old image
                unlink("../uploads/$old_image");
            }
        } else {
            echo "<script>window.location.href = 'car-image.php?car_id=$car_id&car_name=$car_name&status=failed';</script>";
        }
    }
}
?>
