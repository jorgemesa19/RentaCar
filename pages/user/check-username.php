<?php
// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

if(isset($_POST['username'])){
    $username = $_POST['username'];

    $query = "SELECT COUNT(*) AS cnt_username FROM tbl_user WHERE username=:username";
    
    $statement = $conn->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->execute();
    
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    $response = "";
    echo "<script>
    document.getElementById('add-user_btn').disabled = false;
    document.getElementById('username').className = 'form-control form-control-border is-valid';
    </script>";
    
    $count = $result['cnt_username'];
        
    if($count > 0){
        $response = "<span style='color: red;'>Already Exist</span>";
        echo "<script>
        document.getElementById('add-user_btn').disabled = true;
        document.getElementById('username').className = 'form-control form-control-border is-invalid';
        </script>";
    }
   
    echo $response;
    die;
}
?>