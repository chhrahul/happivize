<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php';


global $wpdb;
 
 $mai = $_POST['daaa'];


$gg = $wpdb->get_row('select * from hp_users where user_email = "'.$mai.'"');



if(! empty($gg )){
	$returnValue['res'] = 'yes';
	$returnValue['mail'] = $mai;
	
}else{

$wpdb->insert( 
	'hp_newmail', 
	array( 
		'email_id' => $mai
		
	), 
	array( 
		'%s'
	) 
);

$returnValue['res'] = 'no';
}


echo json_encode($returnValue);


?>