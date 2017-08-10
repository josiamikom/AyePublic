<?php 
$feedbacks=json_decode(file_get_contents('../home/feedback.json'),true);
if (!empty($_POST['message'])&& isset($_POST['message'])) {
    date_default_timezone_set('Asia/Jakarta'); // CDT


    $put=$_POST;
    $put['timestamp']=date('d M Y, h:ia O');
    $feedbacks[]=$put;
    file_put_contents('../home/feedback.json', json_encode($feedbacks)); 
  }
//date_default_timezone_set('Asia/Jakarta'); // CDT

//$current_date = date('d M Y, h:ia O');
	//$put[]=array('type'=>'admin','name'=>'Josi Aranda','timestamp'=>$current_date,'message'=>'hello,world');
	$feedbacks=json_decode(file_get_contents('feedback.json'),true);
	$feedbacks=array_reverse($feedbacks,true);
	
	//file_put_contents('feedback.json', json_encode($put));
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>AyeAye - Feedbacks</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/skin-blue.css" rel="stylesheet">
<!-- Le fav -->
<link rel="shortcut icon" href="assets/ico/favicon.png">
<!--[if lt IE 9]>
<style>
nav,.container,header#top-section,.carousel,.demobutton {display:none;}
</style>
<div id='browserWarning'>
You are using an outdated version of Internet Explorer. Please, switch to
<a style="color:red;" href='http://getfirefox.com'>Firefox</a>,
<a style="color:red;" href='http://www.google.de/chrome'>Google Chrome</a>
,
<a style="color:red;" href='http://www.apple.com/safari/'>Safari</a>
or the latest version of
<a style="color:red;" href='http://windows.microsoft.com/en-US/internet-explorer/downloads/ie'>Internet Explorer</a>
for a
<span class='bold'>better</span>
and
<span class='bold'>safer</span>
experience.
</div>
<![endif]-->
</head>
<!-- /head-->
<body data-spy="scroll" data-target=".navbar">
<nav id="topnav" class="navbar navbar-fixed-top navbar-default" role="navigation">
<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="../home">AyeAye</a>
	</div>
	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="../home">Home</a></li>
			<li><a href="compare.php">Perbandingan</a></li>
			<li><a href="smartphones.php">Daftar Smartphone</a></li>
			<li class="active"><a href="#">Buku Tamu</a></li>
			
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</div>
</nav>
<!-- HOMEPAGE -->

<div class="container">
	<div class="row">
	<br>
	<br>
		<div class="col-lg-12">
			<h1>Feedbacks</h1>
			<h3>Write your feedback</h3>
		</div>
    </div>
    <div class="row">
    	<div class="col-lg-12">
    		<form action="feedback.php" method="post">
                      
                      <label class="col-lg-12">Name :</label>
                      <input type="text" name="name" class="col-lg-12">
                      <input type="hidden" name="type" value="user">
                      <label class="col-lg-12">Message :</label>
                        <textarea class="col-lg-12" name="message" rows="6" placeholder="Write your message here..." required=""></textarea>
                        <div class="col-lg-12">
                        	<button type="submit" class="btn btn-success pull-right" style="margin-top:10px;">Submit</button>	
                        </div>
                        
                      </form>
    	</div>
    </div>
    <br/>
    <div class="row">
    	<div class="col-lg-12">
    		<?php 
    foreach ($feedbacks as $key => $value) {
      if ($value['type']==='admin') {
        ?>
        <div class="col-offset-2 col-lg-10">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <?php 
          echo "$value[name] | $value[timestamp]";
           ?>
        </div>
        <div class="panel-body">
          <?php echo "$value[message]"; ?>
        </div>
      </div>
    </div>

        <?php
      }else {
        ?>

          <div class="col-lg-10 col-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <?php 
          echo "$value[name] | $value[timestamp]";
           ?>
        </div>
        <div class="panel-body">
          <?php echo "$value[message]"; ?>
        </div>
      </div>
    </div>
        <?php
      }
    }
   ?>
    	</div>
    </div>
</div>
</section>
<!-- FOOTER -->
<footer id="foot-sec">
<div class="footerdivide">
</div>
<div class="container ">
<div class="row">
	<div class="text-center color-white col-sm-12 col-lg-12">
		
		<p>
			 © Your Website.com. Template by WowThemes.net
		</p>
		<p>
			<a href="http://www.wowthemes.net/premium-themes-templates/">Official Website</a> | <a href="http://www.wowthemes.net/support/">Theme Support</a> | <a href="http://www.wowthemes.net/frequently-asked-questions/">F.A.Q.</a>
		</p>
	</div>
</div>
</div>
</footer>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
<script src="assets/js/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
<script src="assets/js/jquery.scrollTo-1.4.6-min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.placeholder.js"></script>
<script src="assets/js/modernizr.custom.js"></script>
<script src="assets/js/toucheffects.js"></script>
<script src="assets/js/animations.js"></script>
<script src="assets/js/init.js"></script>
</body>
</html>