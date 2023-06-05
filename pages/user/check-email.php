<?php
// Establecer la conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

if(isset($_POST['email'])){
    $email = $_POST['email'];

    $query = "SELECT COUNT(*) AS cnt_email FROM tbl_user WHERE email=:email";
    
    $statement = $conn->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    $response = "";
    echo "<script>
    document.getElementById('add-user_btn').disabled = false;
    document.getElementById('email').className = 'form-control form-control-border is-valid';
    </script>";
    
    $count = $result['cnt_email'];
        
    if($count > 0){
        $response = "<span style='color: red;'>¡El Email ingresado ya existe!</span>";
        echo "<script>
        document.getElementById('add-user_btn').disabled = true;
        document.getElementById('email').className = 'form-control form-control-border is-invalid';
        </script>";
    }
   
    echo $response;
    die;
}
?>
