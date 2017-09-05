<?php 
	$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
	ksort($phoneList);
	require_once '../lib/AHP.php';
	$hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
	foreach ($hierarki1->child as $key => $value) {
      		foreach ($value['name'] as $key1 => $value1) {
      			$choice[$key][]=$value1;
      		}
      	}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>SmartDec - AHP</title>
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
		<a class="navbar-brand" href="../home">SmartDec</a>
	</div>
	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="../home">Home</a></li>
			<li class="active"><a href="#">Perbandingan</a></li>
			<li><a href="smartphones.php">Daftar Smartphone</a></li>
			<li><a href="feedback.php">Buku Tamu</a></li>
			
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</div>
</nav>
<!-- HOMEPAGE -->
<br/>
<br/>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>Perbandingan Smartphone</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h3>Cari berdasar kriteria</h3>
			<form action="find.php" method="post">
				<?php foreach ($choice as $key => $value) {
	
 ?>
	<div class="form-group">
		<label><?php echo "$key :"; ?></label>
		<select name=<?php echo "'value"."[$key]'"; ?> class="form-control">
		<?php foreach ($value as $key1 => $value1) {
			# code...
		 ?>
			<option value=<?php echo "'$value1'"; ?>><?php echo "$value1"; ?></option>
			<?php  }?>
		</select>
	</div>


<?php 
	
	}
 ?>
				<div class="form-group pull-right">
					<button type="submit" class="btn btn-success">Cari</button>
				</div>
			</form>
		</div>
		<br>
		<div class="col-lg-6">
			<h3>Cari berdasar smartphone</h3>
			<p>Dengan metode AHP. (min. 2 smartphone, maks. 6 smartphone)</p>
			<form action="process.php" method="post">
				<div class="form-group">
					<select class="form-control" name="phones[]" required="">
						<option value="">Select Smartphone</option>
						<?php 
						foreach ($phoneList as $key => $value) {
							?>
							<option value=<?php echo "'$value[Brand]$value[Name]'"; ?>><?php echo "$value[Name]"; ?></option>
							<?php
						}
						 ?>
					</select>
					<select class="form-control" name="phones[]" required="">
						<option value="">Select Smartphone</option>
						<?php 
						foreach ($phoneList as $key => $value) {
							?>
							<option value=<?php echo "'$value[Brand]$value[Name]'"; ?>><?php echo "$value[Name]"; ?></option>
							<?php
						}
						 ?>
					</select>
					<select class="form-control" name="phones[]" >
						<option value="">Select Smartphone</option>
						<?php 
						foreach ($phoneList as $key => $value) {
							?>
							<option value=<?php echo "'$value[Brand]$value[Name]'"; ?>><?php echo "$value[Name]"; ?></option>
							<?php
						}
						 ?>
					</select>
					<select class="form-control" name="phones[]" >
						<option value="">Select Smartphone</option>
						<?php 
						foreach ($phoneList as $key => $value) {
							?>
							<option value=<?php echo "'$value[Brand]$value[Name]'"; ?>><?php echo "$value[Name]"; ?></option>
							<?php
						}
						 ?>
					</select>
					<select class="form-control" name="phones[]" >
						<option value="">Select Smartphone</option>
						<?php 
						foreach ($phoneList as $key => $value) {
							?>
							<option value=<?php echo "'$value[Brand]$value[Name]'"; ?>><?php echo "$value[Name]"; ?></option>
							<?php
						}
						 ?>
					</select>
					<select class="form-control" name="phones[]" >
						<option value="">Select Smartphone</option>
						<?php 
						foreach ($phoneList as $key => $value) {
							?>
							<option value=<?php echo "'$value[Brand]$value[Name]'"; ?>><?php echo "$value[Name]"; ?></option>
							<?php
						}
						 ?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success pull-right">Submit</button>
				</div>
			</form>
			<br>
			<br>
		</div>
	</div>
</div>

<!-- SECTION-6 (contact) -->

<!-- FOOTER -->
<footer id="foot-sec">
<div class="footerdivide">
</div>
<div class="container ">
<div class="row">
	<div class="text-center color-white col-sm-12 col-lg-12">
		
		<p>
			 © Galvani Natasya. Template by WowThemes.net
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