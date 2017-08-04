<?php 
	if (($handle = fopen("Alternatives.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $alt[]=$data;
        
      }
    fclose($handle);
  }
    require_once 'AHP.php';


  $hierarki1=new Kriteria(json_decode(file_get_contents('lib/kriteria/kriteria.json'),true));
  $PV['main']=$hierarki1->getPV();
  foreach ($hierarki1->getChild() as $key => $value) {
  	$class=new Kriteria($value);
  	$PV['child'][$key]=$class->getPV();
  }
  echo "<pre>";
  
  print_r($alt);
  print_r($PV);
 ?>