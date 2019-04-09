<?php
//Get All request whose status is submitted.
require_once ('../../../wp-config.php');
//echo $user_id;
$string_sql="SELECT * FROM HOA_REQUEST WHERE HOA_REQUEST.Request_Status=1 OR HOA_REQUEST.Request_Status=2";

$datas=$wpdb->get_results($string_sql,OBJECT);

echo json_encode($datas);

?>