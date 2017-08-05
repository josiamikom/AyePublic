<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  if (!empty($_POST)) {
    $put=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
    $key=$_POST['key'];
    unset($put[$key]);
    
    
    
    
    file_put_contents('../lib/phone/phoneList.json', json_encode($put));
      header("location:info.php");
    }
 ?>