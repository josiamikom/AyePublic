<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  if (!empty($_POST)) {
    //$root=__DIR__;
    //$root=str_replace('admin', '', $root);
    $target_dir="..\lib\phone\img\\";
    $target_name=$_POST['Brand']."-_-".$_POST['Name'];
    $ext=pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION);
    $target_file=$target_dir.$target_name.".".$ext;
    $uploadok=1;

    if (getimagesize($_FILES["image"]["tmp_name"])!==false) {
      # code...
    }else{
      $uploadok=0;
    }

    if ($uploadok&& move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      
    }else {
      $uploadok=0;
    }
    
    $put=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
    $key=$_POST['Brand'].$_POST['Name'];
    if (!array_key_exists($key, $put)) {
      $data=$_POST;
      $data['imagepath']='default.jpg';
      if ($uploadok) {
        $data['imagepath']=basename($target_file);
      }
      $put[$key]=$data;
    }
    
    print_r($put);
    
    file_put_contents('../lib/phone/phoneList.json', json_encode($put));
      header("location:info.php");
  }
 ?>