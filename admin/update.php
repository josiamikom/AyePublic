<?php 
  if (!empty($_POST)) {
    $put=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
    $key=$_POST['Brand'].$_POST['Name'];
    
    $put[$key]=$_POST;
    
    
    
    
    file_put_contents('../lib/phone/phoneList.json', json_encode($put));
      header("location:info.php");
    }
 ?>