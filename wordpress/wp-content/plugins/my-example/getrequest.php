<?php
$user_id = $_GET["user_id"];

$string_sql="SELECT * FROM HOA_REQUEST WHERE HOA_REQUEST.Request_Users_ID='$user_id'";

$datas=$wpdb->query($string_sql);

echo $datas;



?>