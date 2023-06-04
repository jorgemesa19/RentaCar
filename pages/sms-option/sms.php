<?php 

//for sms
//$member_id= $_POST['member_id'];
//$message_details = "$first_name $middle_name $last_name approved your request with message: $message_from_management";
//include '../sms-option/sms.php';

$host = "localhost"; // Nombre del servidor donde está alojada la base de datos
$user = "postgres"; // Nombre de usuario de la base de datos
$password = "9090"; // Contraseña de la base de datos
$dbname = "bd_rentaCar"; // Nombre de la base de datos

$cn = new mysqli ($host, $user, $password, $dbname);

$sql="SELECT s_option_id, api_code, api_password, enabled FROM tbl_sms_option";
$qry=$cn->prepare($sql);
$qry->execute();
$qry->bind_result($s_option_id, $api_code, $api_password, $enabled);
$qry->store_result();
$qry->fetch();

$message_details = "$message_details\n$app_name";

if ($enabled == 1){
    while ($qry->fetch()){
        $result = itexmo("$contact","$message_details","$api_code", "$api_password");
        if ($result == ""){
            echo "
                <script>
                $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'There was an error sending sms!'
                })
                });

                });
                </script>
                        ";
        }
        else if ($result == 0){
//            echo "Message Sent!";
        }
        else{	
            echo "
                <script>
                $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'There was an error sending sms! Error Num. $result was encountered!'
                })
                });

                });
                </script>
                ";
        }
    }
}

//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}
//##########################################################################
?>
