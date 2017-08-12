<?php 
	if (!empty($_POST)) {
		$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
		require_once '../lib/AHP.php';
		$hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
		$subhierarki1=$hierarki1->child;

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
				$formula[$key][$rule]['kriteria']=$main[$rule]['pv'];
				$formula[$key][$rule]['sub']=$main[$rule]['sub'][$value]['pv'];
				$formula[$key][$rule]['value']=$calculate[$key][$rule];
			}
			$result[$key]=array_sum($calculate[$key]);
		}
		foreach ($result as $key => $value) {
			$finalresult["$value"][]=$key;
		}
		arsort($finalresult);
		foreach ($finalresult as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$explain[$value1]=$formula[$value1];
			}
		}
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
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a href="#ahp" data-toggle="collapse" style="text-decoration: none;">
						<div class="col-lg-12" style="color: white;">
							<i class="fa fa-chevron-down "></i><strong> Perhitungan AHP</strong>
						</div>
					</a>
				</div>
				<div id="ahp" class="panel-collapse collapse">
					<div class="panel-body" style="align-content: center;">
					<?php
						$pv=$hierarki1->getPV();
									          echo "<table class='table table-striped table-bordered '>";
									          echo "<tr>";
									          foreach ($hierarki1->name as $key => $value) {
									            echo "<td>".$value."</td>";
									          }
									          echo "</tr><tr>";
									          foreach ($pv as $key => $value) {
									            echo "<td>".$value."</td>";
									          }
									          echo "</tr>";
									          echo "</table>";
									          ?>
									          <div  style="text-align: center;"><i class="fa fa-arrow-down fa-5x"></i>
									          	
									          </div>
									          <?php
			          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
			          echo "<tr><td>Name</td>";
			          $pv=$hierarki1->getPV();
			          foreach ($hierarki1->name as $key => $value) {
			            echo "<td colspan='2'><strong>$value</strong></td>";
			          }
			          echo "</tr>";
			          foreach ($printspec as $key => $value) {
			          	foreach ($value as $key1 => $value1) {
			          		$index=str_replace(' | ', '', $key1);
			          		?>
			          		<tr>
			          			<td><?php echo "$key1"; ?></td>
			          			<?php 
			          			foreach ($phones[$index] as $key => $value) {
			          				?>
			          				<td><strong><?php echo substr($explain[$index][$key]['kriteria'], 0,6); ?></strong></td>
			          			<td><?php echo $value; ?></td>
			          				<?php
			          			}
			          			 ?>
			          		</tr>
			          		<?php
			          	}
			          }
			          
			          echo "</table>";
			          ?>	
			          <div  style="text-align: center;"><i class="fa fa-arrow-down fa-5x"></i>
									          	
									          </div>
					<?php 
						foreach ($subhierarki1 as $key => $value) {
							$hierarki12=new Kriteria($value);
							
										          $pv=$hierarki12->getPV();
										          
										          ?>
										          <h3><?php echo "$key"; ?></h3>

										          <?php
										          echo "<table class='table table-striped table-bordered '>";
										          echo "<tr>";
										          foreach ($hierarki12->name as $key => $value) {
										            echo "<td>".$value."</td>";
										          }
										          echo "</tr><tr>";
										          foreach ($pv as $key => $value) {
										            echo "<td>".$value."</td>";
										          }
										          echo "</tr>";
										          echo "</table>";
										          
						}
						 ?>
						 <div  style="text-align: center;"><i class="fa fa-arrow-down fa-5x"></i>
									          	
									          </div>
					<?php
			          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
			          echo "<tr><td>Name</td>";
			          $pv=$hierarki1->getPV();
			          foreach ($hierarki1->name as $key => $value) {
			            echo "<td colspan='2'><strong>$value</strong></td>";
			          }
			          echo "</tr>";
			          foreach ($printspec as $key => $value) {
			          	foreach ($value as $key1 => $value1) {
			          		$index=str_replace(' | ', '', $key1);
			          		?>
			          		<tr>
			          			<td><?php echo "$key1"; ?></td>
			          			<?php 
			          			foreach ($explain[$index] as $keyx => $valuex) {
			          				?><td><strong><?php echo substr($valuex['kriteria'], 0,6); ?></strong></td>
			          				<td><strong><?php echo substr($valuex['sub'], 0,6); ?></strong></td><?php
			          			}
			          			 ?>
			          		</tr>
			          		<?php
			          	}
			          }
			          
			          echo "</table>";
			          ?>
			          <div  style="text-align: center;"><i class="fa fa-arrow-down fa-5x"></i>
									          	
									          </div>
									          <?php
			          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
			          echo "<tr><td>Name</td>";
			          $pv=$hierarki1->getPV();
			          foreach ($hierarki1->name as $key => $value) {
			            echo "<td><strong>$value</strong></td>";
			          }
			          echo "</tr>";
			          foreach ($printspec as $key => $value) {
			          	foreach ($value as $key1 => $value1) {
			          		$index=str_replace(' | ', '', $key1);
			          		?>
			          		<tr>
			          			<td><?php echo "$key1"; ?></td>
			          			<?php 
			          			foreach ($explain[$index] as $keyx => $valuex) {
			          				?><td><strong><?php echo substr($valuex['value'], 0,6); ?></strong></td>
			          				<?php
			          			}
			          			 ?>
			          		</tr>
			          		<?php
			          	}
			          }
			          
			          echo "</table>";
			          ?>
			          <div  style="text-align: center;"><i class="fa fa-arrow-down fa-5x"></i>

									          </div>
									          <?php
			          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
			          echo "<tr><td>Name</td><td></td><td><strong>Result</strong></td>";

			          echo "</tr>";
			          foreach ($printspec as $key => $value) {
			          	foreach ($value as $key1 => $value1) {
			          		$index=str_replace(' | ', '', $key1);
			          		?>
			          		<tr>
			          			<td><?php echo "$key1"; ?></td>
			          			<?php
			          			$totalstr='';
			          			$total=0;
			          			foreach ($explain[$index] as $keyx => $valuex) {
			          				$totalstr[]=substr($valuex['value'], 0,6);
			          				$total+=$valuex['value'];
			          			}
			          			 ?>
											 <td><?php echo implode(' + ', $totalstr); ?></td>
											 <td><strong><?php echo $total; ?></strong></td>
			          		</tr>
			          		<?php
			          	}
			          }

			          echo "</table>";
			          ?>
						<div class="row">
							<div class="col-lg-12">
							<h3>Kriteria</h3>
								<div class="panel panel-success">
									<div class="panel-heading">
										<a href="#kriteria" data-toggle="collapse" style="text-decoration: none;">
											<div class="col-lg-12" >
												<i class="fa fa-chevron-down "></i>Kriteria
											</div>
										</a>
									</div>
									<div id="kriteria" class="panel-collapse collapse">
										<div class="panel-body">
											<h3>Priorities</h3>
											<?php
									          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
									          echo "<tr><td></td>";
									          $pv=$hierarki1->getPV();
									          foreach ($hierarki1->name as $key => $value) {
									            echo "<td>$value</td>";
									          }
									          echo "</tr>";
									          foreach ($hierarki1->values as $i => $value) { 
									            echo "<tr>";
									            echo "<td>".$hierarki1->name[$i]."</td>";
									            for ($j=0; $j < sizeof($hierarki1->values); $j++) { 
									              echo "<td>".$hierarki1->values[$i][$j]."</td>";

									            }

									          }
									          echo "</table>";
									          ?>
									          <h3>Priority Vector (PV)</h3>

									          <?php
									          echo "<table class='table table-striped table-bordered '>";
									          echo "<tr>";
									          foreach ($hierarki1->name as $key => $value) {
									            echo "<td>".$value."</td>";
									          }
									          echo "</tr><tr>";
									          foreach ($pv as $key => $value) {
									            echo "<td>".$value."</td>";
									          }
									          echo "</tr>";
									          echo "</table>";
									          ?>
									          <h3>Consistency Ratio (CR)</h3>

									          <?php
									          echo "<table class='table table-bordered '>";
									          if ($hierarki1->getCR()['value']<=0.1) {
									            echo "<tr class='success'><td>".$hierarki1->getCR()["status"]."</td></tr>";
									          }else {
									            echo "<tr class='danger'><td>".$hierarki1->getCR()['status']."</td></tr>";
									          }
									          echo "<tr><td>".$hierarki1->getCR()['value']."</td></tr>";

									          echo "</table>";
									          ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<h3>Sub Kriteria</h3>
						<?php 
						foreach ($subhierarki1 as $key => $value) {
							$hierarki12=new Kriteria($value);
							$index=str_replace(' ', '_', $key);
							?>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-warning">
										<div class="panel-heading">
											<a href=<?php echo "'#$index'"; ?> data-toggle="collapse" style="text-decoration: none;">
												<div class="col-lg-12" >
													<i class="fa fa-chevron-down "></i><?php echo "$key"; ?>
												</div>
											</a>
										</div>
										<div id=<?php echo "'$index'"; ?> class="panel-collapse collapse">
											<div class="panel-body">
												<h3>Priorities</h3>
												<?php
										          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
										          echo "<tr><td></td>";
										          $pv=$hierarki12->getPV();
										          foreach ($hierarki12->name as $key => $value) {
										            echo "<td>$value</td>";
										          }
										          echo "</tr>";
										          foreach ($hierarki12->values as $i => $value) { 
										            echo "<tr>";
										            echo "<td>".$hierarki12->name[$i]."</td>";
										            for ($j=0; $j < sizeof($hierarki12->values); $j++) { 
										              echo "<td>".$hierarki12->values[$i][$j]."</td>";

										            }

										          }
										          echo "</table>";
										          ?>
										          <h3>Priority Vector (PV)</h3>

										          <?php
										          echo "<table class='table table-striped table-bordered '>";
										          echo "<tr>";
										          foreach ($hierarki12->name as $key => $value) {
										            echo "<td>".$value."</td>";
										          }
										          echo "</tr><tr>";
										          foreach ($pv as $key => $value) {
										            echo "<td>".$value."</td>";
										          }
										          echo "</tr>";
										          echo "</table>";
										          ?>
										          <h3>Consistency Ratio (CR)</h3>

										          <?php
										          echo "<table class='table table-bordered '>";
										          if ($hierarki12->getCR()['value']<=0.1) {
										            echo "<tr class='success'><td>".$hierarki12->getCR()["status"]."</td></tr>";
										          }else {
										            echo "<tr class='danger'><td>".$hierarki12->getCR()['status']."</td></tr>";
										          }
										          echo "<tr><td>".$hierarki12->getCR()['value']."</td></tr>";

										          echo "</table>";
										          ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						 ?>
					</div>
				</div>
			</div>
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