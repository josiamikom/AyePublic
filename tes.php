<?php 
	//print_r(json_decode(file_get_contents('tes.json')));
	  require_once 'AHP.php';
	  echo "<pre>";

  $hierarki1=new Kriteria(json_decode(file_get_contents('lib/kriteria/kriteria.json'),true));
  $hierarki1->setChild(array('Brand Popularity'=>array('name'=>array('Sangat Populer','Populer','Cukup Populer'),'values'=>array(array(1,3,5),array(0.33,1,3),array(0.2,0.33,1)))));
  print_r($hierarki1);
  
  $child1=new Kriteria($hierarki1->child['Brand Popularity']);
  //print_r($child1->getPV());
  echo !isset($hierarki1->child['Brand Popularity']);
  unset($hierarki1->child['Brand Popularity']);
  print_r($hierarki1);
  echo json_encode($hierarki1);
 ?>