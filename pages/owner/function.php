<?php
require_once '../database_config/config.php';
$conn = new PDO("pgsql:host=" . $host . ";dbname=" . $dbname, $user, $password);

if (!$conn) {
    die("Connection failed: " . print_r($conn->errorInfo(), true));
}
if (isset($_POST['add-owner'])) {
    $temp = explode(".", $_FILES["profile_image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_image"]["name"]);
        $newfilename = $filename . $newfilename;

        $owner_name = $_POST['owner_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $profile_image = $newfilename;
        $fb_account = $_POST['fb_account'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $admin_id = $_SESSION['user_id'];
        $account_status = $_POST['account_status'];

        $sql = "INSERT INTO tblowner (owner_name, address, contact, profile_image, fb_account, username, password, admin_id, account_status) VALUES (?,?,?,?,?,?,?,?,?)";
        $qry = $conn->prepare($sql);
        $qry->execute([$owner_name, $address, $contact, $profile_image, $fb_account, $username, $password, $admin_id, $account_status]);

        if ($qry->rowCount() > 0) {
            echo "<script>window.location.href = 'owner.php?status=success';</script>";
        } else {
            echo "<script>window.location.href = 'owner.php?status=failed';</script>";
        }
    } else {
        echo "<script>window.location.href = 'owner.php?status=failed-upload';</script>";
    }
}


if (isset($_POST['edit-owner'])) {

    $owner_id = $_POST['owner_id'];
    $owner_name = $_POST['owner_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $fb_account = $_POST['fb_account'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_status = $_POST['account_status'];

    $sql = "UPDATE tblowner SET owner_name = ?, address = ?, contact = ?, fb_account = ?, username = ?, password = ?, account_status = ? WHERE owner_id = ?";
    $qry = $conn->prepare($sql);
    $qry->execute([$owner_name, $address, $contact, $fb_account, $username, $password, $account_status, $owner_id]);

    if ($qry->rowCount() > 0) {
        echo "<script>window.location.href = 'owner.php?status=success';</script>";
    } else {
        echo "<script>window.location.href = 'owner.php?status=failed';</script>";
    }
}

if (isset($_POST['delete-owner'])) {

    $owner_id = $_POST['owner_id'];

    $sql = "DELETE FROM tblowner WHERE owner_id=?";
    $qry = $conn->prepare($sql);
    $qry->execute([$owner_id]);

    if ($qry->rowCount() > 0) {
        $old_profile_image = $_POST['old_profile_image'];
        if ($old_profile_image != 'img-default.jpg') {
            //delete old profile_image
            unlink("../uploads/$old_profile_image");
        }

        $sql = "DELETE FROM tblownercredential WHERE owner_id=?";
        $qry = $conn->prepare($sql);
        $qry->execute([$owner_id]);

        echo "<script>window.location.href = 'owner.php?status=success';</script>";
    } else {
        echo "<script>window.location.href = 'owner.php?status=failed';</script>";
    }
}

if (isset($_POST['edit-profile_image'])) {
    $temp = explode(".", $_FILES["profile_image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "../uploads/";

    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["profile_image"]["name"]);
        $newfilename = $filename . $newfilename;

        $owner_id = $_POST['owner_id'];
        $profile_image = $newfilename;
        $old_profile_image = $_POST['old_profile_image'];

        $sql = "UPDATE tblowner SET profile_image = ? WHERE owner_id = ?";
        $qry = $conn->prepare($sql);
        $qry->execute([$profile_image, $owner_id]);

        if ($qry->rowCount() > 0) {
            echo "<script>window.location.href = 'owner.php?status=success';</script>";

            $old_profile_image = $_POST['old_profile_image'];
            if ($old_profile_image != 'img-default.jpg') {
                //delete old profile_image
                unlink("../uploads/$old_profile_image");
            }
        } else {
            echo "<script>window.location.href = 'owner.php?status=failed';</script>";
        }
    }
}
?>
