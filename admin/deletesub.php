<?php 

	require_once '../lib/AHP.php';
	

  $hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
  unset($hierarki1->child[$_POST['parent']]);
  file_put_contents('../lib/kriteria/kriteria.json', json_encode($hierarki1));
	header('location:subkriteria.php?name='.$_POST['parent']);

?>