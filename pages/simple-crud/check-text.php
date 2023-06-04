<?php
require_once '../database_config/config.php';

// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

// Establecer la conexión
$cn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($cn->connect_error) {
    die("Connection failed: " . $cn->connect_error);
}

if (isset($_POST['text'])) {
    $text = $cn->real_escape_string($_POST['text']);

    $query = "SELECT COUNT(*) AS cnt_text FROM tbl_simple_crud WHERE text='" . $text . "'";

    $result = $cn->query($query);

    $response = "";
    echo "<script>
    document.getElementById('add-simple_crud_btn').disabled = false;
    document.getElementById('text').className = 'form-control form-control-border is-valid';
    </script>";

    if ($result->num_rows) {
        $row = $result->fetch_array();

        $count = $row['cnt_text'];

        if ($count > 0) {
            $response = "<span style='color: red;'>Already Exist</span>";
            echo "<script>
            document.getElementById('add-simple_crud_btn').disabled = true;
            document.getElementById('text').className = 'form-control form-control-border is-invalid';
            </script>";
        }
    }

    echo $response;
    die;
}
?>
