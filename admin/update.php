<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  if (!empty($_POST)) {
  	print_r($_POST);
  	print_r($_FILES);
    $put=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
    $key=$_POST['Brand'].$_POST['Name'];
    $data=$_POST;
    $uploadok=0;
    $data['imagepath']=$put[$key]['imagepath'];
    if ($_FILES['image']['error']===0) {
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
	      $uploadok=1;
	    }else {
	      $uploadok=0;
	    }
    }
    if ($uploadok) {
        $data['imagepath']=basename($target_file);
      }

    $put[$key]=$data;
    
    
    file_put_contents('../lib/phone/phoneList.json', json_encode($put));
    header("location:info.php");
    }
 ?>