<?php
//this file for saving action

require_once ('../../../wp-config.php');


$hoa_form=$_POST["action_form"];

//INSERT INTO `HOA_ACTION` (`Action_ID`, `Request_ID`, `Assignee_ID`, `Action_Description`, `Start_Time`, `Action_Status`, `Status_Time`, `Due_Time`)
// VALUES (NULL, '1', '1', 'AD1', CURRENT_TIMESTAMP, '1', '2019-04-04 10:00:00', '2019-04-09 00:00:00');

$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');

global $wpdb;

/* 
var actions = {
    "Reqeust_ID":item_id,
    "Assignee":"",
    "Action_Description":"",
    "Action_Status":"1",
  }
*/



$value=array(
    'Action_ID'=>NULL,
    'Request_ID'=>$hoa_form["Request_ID"],
    'Assignee_ID'=>intval($hoa_form["Assignee"]),
    'Action_Description'=>$hoa_form["Action_Description"],
    'Start_Time'=>$timestamp,
    'Action_Status'=>$hoa_form["Action_Status"],
    'Status_Time'=>$timestamp,
    'Due_Time'=>$hoa_form["Action_Due"],
);




$formats_values = array('%d',
                        '%d',
                        '%d',
                        '%s',
                        '%s',
                        '%d',
                        '%s',
                        '%s'
                        );





try{
    //$wpdb->query($my_sql);
    $wpdb->insert('HOA_ACTION',$value,$formats_values);
    //$wpdb->insert('h_a',$value_test,$formats_test);
}catch(Exception $e){
    echo $e->getMessage();
}

?>