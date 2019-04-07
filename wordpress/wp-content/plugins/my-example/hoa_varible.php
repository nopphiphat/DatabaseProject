<?php
$hoa_form=$_POST["hoa_request_form"];
$hoa_use_id=$hoa_form["hoa_c_user_id"];
$hoa_title=$hoa_form["hoa_c_title"];
$hoa_description=$hoa_form["hoa_c_description"];
$hoa_start_time=$hoa_form["hoa_c_record_time"];
$hoa_status=$hoa_form["hoa_c_status"];

$my_sql ="INSERT INTO HOA_REQUEST (Request_ID,Request_Title,Request_Description,
Request_Method,Request_Users_ID,Record_Employee_ID,Record_Time,Request_Handler_ID,Request_Status,
Status_Time,Due_Time,Request_Rating,Rating_time) VALUES 
(NULL,'$hoa_title','$hoa_description','Form','$hoa_use_id',225,'2019-04-01 00:00:00',300,1,'2019-04-01 00:00:00',NULL,NULL,NULL);
";


try{
    $wpdb->query($my_sql);
    $wpdb->insert('HOA_REQUEST',array('Request_ID'=>NULL,'Request_Title'=>$hoa_title,'Request_Description'=>$hoa_description,
    'Request_Method'=>'Form','Request_Users_ID'=>$hoa_use_id,'Record_Employee_ID'=>225,'Record_Time'=>'2019-04-01 00:00:00','Request_Handler_ID'=>300,
    'Request_Status'=>1,'Status_Time'=>'2019-04-01 00:00:00','Due_Time'=>NULL,'Request_Rating'=>NULL,'Rating_time'=>NULL));
}catch(Exception $e){
    echo $e->getMessage();
}
//echo $my_sql;
?>