<?php
//for saving comment and rating
require_once ('../../../wp-config.php');
$comment_form = $_POST["hoa_comment_rating"];
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');

$values = array(
    'Request_Rating'=>$comment_form['rate'],
    'Rating_time'=>$timestamp
);

$where = array('Request_ID'=>$comment_form["request_id"]);

$formates_values = array('%d','%s');

$formats_where = array('%d');

//$string_sql="UPDATE `HOA_REQUEST` SET `Request_Rating` = '"+$comment_form['rate']+"' WHERE (`Request_ID` = '"+$comment_form["request_id"]+"')";

$wpdb->update('HOA_REQUEST',$values,$where,$formates_values,$formats_where);

?>