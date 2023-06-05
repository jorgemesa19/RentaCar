<?php
require_once '../database_config/config.php';
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

if (!$conn) {
    die("Connection failed: " . print_r($conn->errorInfo(), true));
}

if (isset($_POST['username'])) {
    $username = $conn->quote($_POST['username']);

    $query = "SELECT COUNT(*) AS cnt_username FROM tblowner WHERE username=$username";
    
    $result = $conn->query($query);
    
    $response_username = "";
    echo "<script>
    document.getElementById('add-owner_btn').disabled = false;
    document.getElementById('username').className = 'form-control form-control-border is-valid';
    </script>";
    
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
    
        $count = $row['cnt_username'];
        
        if ($count > 0) {
            $response_username = "<span style='color: red;'>¡Este usuario ya existe!</span>";
            echo "<script>
            document.getElementById('add-owner_btn').disabled = true;
            document.getElementById('username').className = 'form-control form-control-border is-invalid';
            </script>";
        }
    }
    
    echo $response_username;
    die;
}