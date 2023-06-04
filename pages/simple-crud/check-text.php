<?php
require_once '../database_config/config.php';
$cn = new mysqli (HOST, USER, PW, DB);
// Check connection
if (!$cn) {
 die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['text'])){
    $text = mysqli_real_escape_string($cn,$_POST['text']);

    $query = "SELECT COUNT(*) AS cnt_text FROM tbl_simple_crud WHERE text='".$text."'";
    
    $result = mysqli_query($cn,$query);
    
    $response = "";
    echo "<script>
    document.getElementById('add-simple_crud_btn').disabled = false;
    document.getElementById('text').className = 'form-control form-control-border is-valid';
    </script>";
    
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cnt_text'];
        
        if($count > 0){
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
