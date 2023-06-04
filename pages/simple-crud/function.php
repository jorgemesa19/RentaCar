<?php
if (isset($_POST['add-simple_crud'])) {
    $s_crud_id = null;
    $text = $_POST['text'];
    $text_area = $_POST['text_area'];
    $dropdown = $_POST['dropdown'];

    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    // Establecer la conexión
    $cn = new mysqli($host, $user, $password, $dbname);

    $sql = "INSERT INTO tbl_simple_crud VALUES (?,?,?,?)";
    $qry = $cn->prepare($sql);
    $qry->bind_param("ssss", $s_crud_id, $text, $text_area, $dropdown);
    if ($qry->execute()) {
        echo "<script>window.location.href = 'simple-crud.php?status=success';</script>";
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> added <b>$text</b>.";
        include '../activity-log/activity-log-function.php';
    } else {
        echo "<script>window.location.href = 'simple-crud.php?status=failed';</script>";
    }
}

if (isset($_POST['edit-simple_crud'])) {
    $s_crud_id = $_POST['s_crud_id'];
    $text = $_POST['text'];
    $text_area = $_POST['text_area'];
    $dropdown = $_POST['dropdown'];

    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    // Establecer la conexión
    $cn = new mysqli($host, $user, $password, $dbname);

    $sql = "UPDATE tbl_simple_crud SET text = ?, text_area = ?, dropdown = ? WHERE s_crud_id = ?";
    $qry = $cn->prepare($sql);
    $qry->bind_param("ssss", $text, $text_area, $dropdown, $s_crud_id);
    if ($qry->execute()) {
        echo "<script>window.location.href = 'simple-crud.php?status=success';</script>";
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited <b>$text</b>.";
        include '../activity-log/activity-log-function.php';
    } else {
        echo "<script>window.location.href = 'simple-crud.php?status=failed';</script>";
    }
}

if (isset($_POST['delete-simple_crud'])) {
    $s_crud_id = $_POST['s_crud_id'];
    $text = $_POST['text'];

    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos

    // Establecer la conexión
    $cn = new mysqli($host, $user, $password, $dbname);

    $sql = "DELETE FROM tbl_simple_crud WHERE s_crud_id=?";
    $qry = $cn->prepare($sql);
    $qry->bind_param("s", $s_crud_id);
    if ($qry->execute()) {
        echo "<script>window.location.href = 'simple-crud.php?status=success';</script>";
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> deleted <b>$text</b>.";
        include '../activity-log/activity-log-function.php';
    } else {
        echo "<script>window.location.href = 'simple-crud.php?status=failed';</script>";
    }
}
?>
