<?php 
	if (!empty($_POST)) {
		$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
		require_once '../lib/AHP.php';
		$hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));

		foreach ($hierarki1->getPV() as $key => $value) {
			$main[$key]['pv']=$value;
			$child=new Kriteria($hierarki1->child[$key]);
			foreach ($child->getPV() as $key1 => $value1) {
				$main[$key]['sub'][$key1]['pv']=$value1;
			}
		}
		foreach ($_POST['phones'] as $key => $value) {
			if (!empty($value)) {
				$phones[$value]=$phoneList[$value]['rule'];
			}
		}

		foreach ($phones as $key => $rules) {
			foreach ($rules as $rule => $value) {
				$calculate[$key][$rule]=$main[$rule]['pv']*$main[$rule]['sub'][$value]['pv'];
			}
			$result[$key]=array_sum($calculate[$key]);
		}
		foreach ($result as $key => $value) {
			$finalresult["$value"][]=$key;
		}
		arsort($finalresult);
		$rank=array_keys($finalresult);
		rsort($rank);
		foreach ($rank as $key => $value) {
			foreach ($finalresult["$value"] as $key1 => $value1) {
				$print[$key+1][]=$phoneList[$value1]['Name'];
			}
		}
		include_once '../lib/fonoApi/fonoApi.php';
		include_once '../lib/phoneClass.php';
		$token='d0275c61dc28964d454ba894f521d8815d5d612c779195c0';
		$fonoApi=fonoApi::debug($token);

		foreach ($print as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$get=$fonoApi::getDevice($value1,0);
				$spec=new phoneClass($get[0]);
				$printspec[$key]["$spec->Brand | $spec->DeviceName"]=$spec->specs;
			}
			
		}
	}
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
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
		<?php 
		$counter=0;
		$outercounter=0;
		foreach ($printspec as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$index=str_replace(' ', '', $key1);
				$index=str_replace('|', '_', $index);
				$counter++;
				$outercounter++;
				if ($counter===1) {
					?><div class="row"><?php
				}
				?>
				<div class="col-lg-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<a href=<?php echo "'#$index'"; ?> data-toggle="collapse" style="text-decoration: none;">
								<div class="col-lg-12" style="color: white;">
									<i class="fa fa-chevron-down "></i><?php echo " <strong style='font-size:150%;'>#$key.</strong> $key1"; ?>
								</div>
							</a>
						</div>
						<div id=<?php echo "'$index'"; ?> class="panel-collapse collapse">
							<div class="panel-body">
								<?php 
						      	$specs=$value1;
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
		}
		if ($outercounter%3!=0) {
				?></div><?php
			}
		 ?>
		
		</div>
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