<?php
require_once ('../../../wp-config.php');
$user_id = $_POST["user_id"];
//echo $user_id;
$string_sql="SELECT * FROM ".$wpdb->prefix."HOA_REQUEST WHERE ".$wpdb->prefix."HOA_REQUEST.Request_Users_ID='$user_id'";
$datas=$wpdb->get_results($string_sql,OBJECT);
//echo $string_sql;
echo json_encode($datas);



?>