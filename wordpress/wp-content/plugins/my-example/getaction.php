<?php

//Get action and request depend on Employee_ID

require_once ('../../../wp-config.php');
$user_id = $_POST["user_id"];
//echo $user_id;
$string_sql="SELECT * FROM ".$wpdb->prefix."HOA_ACTION, ".$wpdb->prefix."HOA_REQUEST WHERE ".$wpdb->prefix."HOA_ACTION.Request_ID = ".$wpdb->prefix."HOA_REQUEST.Request_ID HAVING ".$wpdb->prefix."HOA_ACTION.Assignee_ID = '$user_id';";

$datas=$wpdb->get_results($string_sql,OBJECT);

echo json_encode($datas);


?>