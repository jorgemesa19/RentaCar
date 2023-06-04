<?php
require_once '../database_config/config.php';

$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

try {
    // Establecer la conexión
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    // Verificar si la conexión fue exitosa
    if ($conn) {
        $username = $_POST['username'];
        $query = "SELECT COUNT(*) AS cnt_username FROM tbladmin WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $response_username = "";
        echo "<script>
        document.getElementById('add-admin_btn').disabled = false;
        document.getElementById('username').className = 'form-control form-control-border is-valid';
        </script>";

        if ($count > 0) {
            $response_username = "<span style='color: red;'>Ya existe</span>";
            echo "<script>
            document.getElementById('add-admin_btn').disabled = true;
            document.getElementById('username').className = 'form-control form-control-border is-invalid';
            </script>";
        }

        echo $response_username;
        die;
    } else {
        echo "Error al conectar a la base de datos.";
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
