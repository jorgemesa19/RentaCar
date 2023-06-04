<?php
$time = date('Y-m-d h:i:s a');
$cn = new mysqli (HOST, USER, PW, DB);
$sql="INSERT INTO tbl_log VALUES (?,?,?)";
$qry=$cn->prepare($sql);
$qry->bind_param("sss", $log_id, $activity, $time);
$qry->execute();
?>