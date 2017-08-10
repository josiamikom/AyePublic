<?php 
	$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
	foreach ($phoneList as $key => $value) {
		if ($_POST['value']===$value['rule']) {
			$result[$key]=$value;
		}
	}
	echo "<pre>";
	print_r($result);
 ?>