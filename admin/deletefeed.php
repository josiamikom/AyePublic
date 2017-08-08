<?php 
	$feedbacks=json_decode(file_get_contents('../home/feedback.json'),true);
	print_r($feedbacks);
	unset($feedbacks[$_GET['id']]);
	file_put_contents('../home/feedback.json', json_encode($feedbacks)); 
	header('location:tamu.php');
 ?>