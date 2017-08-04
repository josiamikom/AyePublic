<?php 
	if (!empty($_GET['brand'])&&!empty($_GET['name'])) {
		include_once '../lib/fonoApi/fonoApi.php';
	include_once '../lib/phoneClass.php';
	require_once '../lib/AHP.php';
		$key=$_GET['brand'].$_GET['name'];
		$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
		$phone=$phoneList[$key];
		print_r($phone);
	}
 ?>