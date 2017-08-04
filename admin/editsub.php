<?php

	require_once '../lib/AHP.php';$write=array();
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
  
  $hierarki1->child[$_POST['parent']]=$write;
  
  file_put_contents('../lib/kriteria/kriteria.json', json_encode($hierarki1));
  header('location:subkriteria.php?name='.$_POST['parent']);
  
?>