<?php 
	$feedbacks=json_decode(file_get_contents('feedback.json'),true);
	$single=$feedbacks[0];
	$single['email']='galvaninatasya@gmail.com';
	print_r($feedbacks);
	//$feedbacks[]=$single;
	//file_put_contents('feedback.json', json_encode($feedbacks));
 ?>