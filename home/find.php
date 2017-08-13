<?php 
	$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
	if (!empty($_POST)) {
		include_once '../lib/fonoApi/fonoApi.php';
		include_once '../lib/phoneClass.php';
		$noresult=0;
	require_once '../lib/AHP.php';
		$token='d0275c61dc28964d454ba894f521d8815d5d612c779195c0';

	$fonoApi=fonoApi::debug($token);
		foreach ($phoneList as $key => $value) {
			if ($_POST['value']===$value['rule']) {
				$result[$key]=$value;
				$imgpath[$key]=$value['imagepath'];
			}
		}
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				
				try {
					$get=$fonoApi::getDevice($value['Name']);
					foreach ($get as $aa => $bb) {
						if ($bb->DeviceName===$value['Name']) {
							$devices[]=new phoneClass($get[$aa]);
						}
					}
					
					
				} catch (Exception $e) {

				}
			}
		}else {
			$noresult=1;
		}

	}	
	print_r($imgpath);

	//echo "<pre>";
	//print_r($result);
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>AyeAye - AHP</title>
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
<body d>
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
			<li class="active"><a href="compare.php">Perbandingan</a></li>
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
			<h1>Hasil Pencarian</h1>
			<?php 
				if ($noresult==1) {
					?>
					<div class="alert alert-info">
						Tidak ada smartphone dengan kriteria tersebut dalam database.<br/>
						<a href="compare.php" style="text-decoration: none;"><button class="btn btn-success">Ulangi</button></a>
					</div>
					<?php
				}
			 ?>
		</div>
	</div>
	<?php if ($noresult!=1) {
		
	 ?>
	<div class="row">
		<div class="col-lg-12">
		<?php 
			$counter=0;
			foreach ($devices as $key => $value) {

				$counter++;
				if ($counter===1) {
					?><div class="row"><?php
				}
				$imgindex=$value->Brand.$value->DeviceName;
				?>
				<div class="col-lg-4">
					<div class="panel panel-primary" style="border-radius: 25px"> 
						<div class="panel-heading" style="border-radius: 25px">
							<div style="background-color: white;border-radius: 25px">
								<div style="width: 150px;height: 150px;display: block;margin: 0 auto;">
									<img src=<?php echo "'../lib/phone/img/$imgpath[$imgindex]'"; ?> alt=<?php echo "'$value->DeviceName'"; ?> class="img-responsive img-rounded" style="">
								</div>
							</div>
							<hr style="margin-bottom: 5px;margin-top: 10px">
							<a href=<?php echo "'#$key'"; ?> data-toggle="collapse" style="text-decoration: none;">
								<div class="col-lg-12" style="color: white;">
									<strong><i class="fa fa-chevron-down "></i><?php echo " $value->Brand </strong> | $value->DeviceName"; ?>
								</div>
							</a>
						</div>
						<div id=<?php echo "'$key'"; ?> class="panel-collapse collapse">
							<div class="panel-body">
								<?php 
						      	$specs=$value->specs;
						      	foreach ($specs as $name => $value1) {
						      		echo "<h3>$name</h3>";
						      		echo "<table class='table table-striped table-responsive'>";
						      		foreach ($value1 as $valname => $val) {
						      			echo "<tr>";
						      			echo "<td style='width:100px'>$valname</td>";
						      			echo "<td>$val</td>";
						      			echo "</tr>";
						      		}
						      		echo "</table>";
						      	}

						       ?>
							</div>
						</div>
					</div>
				</div>

				<?php
				if ($counter===3) {
					$counter=0;
					?></div><?php
				}
			}
			if (sizeof($devices)%3!=0) {
				?></div><?php
			}


		 ?>
		
		</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			
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