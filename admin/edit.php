<?php 

require_once '../lib/AHP.php';
	
	
	$write=array();
	$name=($_POST['name']);
	$write['name']=$name;
	foreach ($_POST['value'] as $key => $value) {
		foreach ($value as $key1 => $value1) {
			$val[$key][]=(float)$value1;
		}
	}
	$write['values']=$val;
	$write=new Kriteria($write);
	

  $hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
  
  foreach ($hierarki1->name as $key => $value) {
  	if (!in_array($value, $write->name )) {
  		unset($hierarki1->name[$key]);
  		if (isset($hierarki1->child[$value])) {
  			unset($hierarki1->child[$value]);
  		}
  		
  	}
  }
  $hierarki1->name=$_POST['name'];
  $hierarki1->values=$val;
  
	
	file_put_contents('../lib/kriteria/kriteria.json', json_encode($hierarki1));
	header('location:kriteria.php');
 ?>