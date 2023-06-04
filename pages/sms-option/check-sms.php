<?php
$cn = new mysqli (HOST, USER, PW, DB);
$sql="SELECT sms_id, api_code, api_password, enabled FROM tbl_sms";
$qry=$cn->prepare($sql);
$qry->execute();
$qry->bind_result($sms_id, $api_code, $api_password, $enabled);
$qry->store_result();
$qry->fetch();

if ($enabled == 1){
    echo "<div class='alert alert-info alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <i class='icon fas fa-info'></i> SMS Notification is <b>ENABLED</b>. Data charges may apply.
                </div>";
}
?>