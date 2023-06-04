<?php
// Parámetros de conexión a la base de datos
$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

// Verificar si la conexión fue exitosa
if ($conn) {
    if (isset($_POST['add-user'])) {
        $temp = explode(".", $_FILES["profile_picture"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);

        $target_dir = "../uploads/";

        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file . $newfilename)) {
            $filename = basename($_FILES["profile_picture"]["name"]);
            $newfilename = $filename . $newfilename;

            $user_id = null;
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = md5($password);
            $profile_picture = $newfilename;
            $status = $_POST['status'];

            $sql = "INSERT INTO tbl_user VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $qry = $conn->prepare($sql);
            $qry->execute([$user_id, $firstname, $middlename, $lastname, $contact, $email, $address, $username, $password, $profile_picture, $status]);

            if ($qry) {
                echo "<script>window.location.href = 'user.php?status=success';</script>";

                //activity log
                $log_id = '';
                $activity = "<b>$user_full_name</b> added user <b>$first_name $middle_name $last_name</b>.";
                include '../activity-log/activity-log-function.php';
            } else {
                echo "<script>window.location.href = 'user.php?status=failed';</script>";
            }
        } else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        }
    }

    if (isset($_POST['edit-user'])) {
        $user_id = $_POST['user_id'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $status = $_POST['status'];

        $sql = "UPDATE tbl_user SET lastname = ?, firstname = ?, middlename = ?, contact = ?, email = ?, address = ?, username = ?, status = ? WHERE user_id = ?";
        $qry = $conn->prepare($sql);
        $qry->execute([$lastname, $firstname, $middlename, $contact, $email, $address, $username, $status, $user_id]);

        if ($qry) {
            echo "<script>window.location.href = 'user.php?status=success';</script>";

            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> edited user <b>$firstname $middlename $lastname</b>.";
            include '../activity-log/activity-log-function.php';
        } else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        }
    }

    if (isset($_POST['delete-user'])) {
        $user_id = $_POST['user_id'];

        $sql = "DELETE FROM tbl_user WHERE user_id=?";
        $qry = $conn->prepare($sql);
        $qry->execute([$user_id]);

        if ($qry) {
            echo "<script>window.location.href = 'user.php?status=success';</script>";
        } else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        }
    }

    if (isset($_POST['edit-profile_picture'])) {
        $temp = explode(".", $_FILES["profile_picture"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);

        $target_dir = "../uploads/";

        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file . $newfilename)) {
            $filename = basename($_FILES["profile_picture"]["name"]);
            $newfilename = $filename . $newfilename;

            $user_id = $_POST['user_id'];
            $profile_picture = $newfilename;
            $old_profile_picture = $_POST['old_profile_picture'];

            $sql = "UPDATE tbl_user SET profile_picture = ? WHERE user_id = ?";
            $qry = $conn->prepare($sql);
            $qry->execute([$profile_picture, $user_id]);

            if ($qry) {
                echo "<script>window.location.href = 'user.php?status=success';</script>";

                $old_profile_picture = $_POST['old_profile_picture'];
                if ($old_profile_picture != 'img-default.jpg') {
                    //delete old profile_picture
                    unlink("../uploads/$old_profile_picture");
                }
            } else {
                echo "<script>window.location.href = 'user.php?status=failed';</script>";
            }
        }
    }

    if (isset($_POST['edit-password'])) {
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "UPDATE tbl_user SET password = ? WHERE user_id=?";
        $qry = $conn->prepare($sql);
        $qry->execute([$password, $user_id]);

        if ($qry) {
            echo "<script>window.location.href = 'user.php?status=success';</script>";
        } else {
            echo "<script>window.location.href = 'user.php?status=failed';</script>";
        }
    }
} else {
    echo "Error al conectar a la base de datos.";
}
?>
