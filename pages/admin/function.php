<?php
require_once '../database_config/config.php';

$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

try {
    // Establecer la conexión
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    if (isset($_POST['add-admin'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $sql = "INSERT INTO tbladmin (name, contact, address, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $contact, $address, $username, $password]);
    
        echo "<script>window.location.href = 'admin.php?status=success';</script>";
    }

    if (isset($_POST['edit-admin'])) {
        $admin_id = $_POST['admin_id'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "UPDATE tbladmin SET name = ?, contact = ?, address = ?, username = ?, password = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $contact, $address, $username, $password, $admin_id]);

        echo "<script>window.location.href = 'admin.php?status=success';</script>";

        $activity = "<b>$user_full_name</b> edited <b>$name</b>.";
    }

    if (isset($_POST['delete-admin'])) {
        $admin_id = $_POST['admin_id'];
        $name = $_POST['name'];

        $sql = "DELETE FROM tbladmin WHERE admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$admin_id]);

        echo "<script>window.location.href = 'admin.php?status=success';</script>";

        $activity = "<b>$user_full_name</b> deleted <b>$name</b>.";
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
