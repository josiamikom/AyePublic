<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
	if (!empty($_GET['brand'])&&!empty($_GET['name'])) {
		include_once '../lib/fonoApi/fonoApi.php';
		include_once '../lib/phoneClass.php';
		require_once '../lib/AHP.php';

	$token='d0275c61dc28964d454ba894f521d8815d5d612c779195c0';
		$hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
		foreach ($hierarki1->child as $key => $value) {
			$ruless[$key]=$value['name'];
		}
		$keys=$_GET['brand'].$_GET['name'];
		$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
		$phone=$phoneList[$keys];
		$fonoApi=fonoApi::debug($token);
		try {
			$result=$fonoApi::getDevice($_GET['name'],0,$_GET['brand']);
			$phonespec=new phoneClass($result[0]);
			$spec=$phonespec->specs;
		} catch (Exception $e) {
			$spec=array('Connection Error'=>array('Error'=>"Couldn't reach phone server"));
		}
		require_once 'header.php';
	}
 ?>
 <body>

   

   <div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="adjust-nav">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>


        </div>

        <span class="logout-spn" >
          <a href="logout.php" style="color:#fff;">LOGOUT</a>  

        </span>
      </div>
    </div>
    <!-- /. NAV TOP  -->
    <?php require_once 'sidebar.php'; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
      <div id="page-inner">
      <div class="row">
      <div class="col-lg-12">
      	<form action="deletephone.php" method="post">
      		<input type="hidden" name="key" value=<?php echo "'$keys'"; ?>></input>
      		<button type="submit" class="btn btn-danger pull-right">Delete This Phone</button>
      	</form>
      </div>
          <div class="col-lg-4">
      <div class="panel panel-primary">
      <div class="panel-heading"><?php echo "$_GET[brand] | $_GET[name]"; ?></div>
      <div class="panel-body">

      <?php 
      	
      	foreach ($spec as $name => $value) {
      		echo "<h3>$name</h3>";
      		echo "<table class='table table-striped'>";
      		foreach ($value as $valname => $val) {
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
<div class="col-lg-8">
<form action="update.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="Brand" value=<?php echo "'$_GET[brand]'"; ?>>
<input type="hidden" name="Name" value=<?php echo "'$_GET[name]'"; ?>>
<div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
    <img src=<?php echo "'../lib/phone/img/$phone[imagepath]'"; ?> alt=<?php echo "'$phone[Name]'"; ?>>
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
<?php foreach ($ruless as $key => $value) {
	
 ?>
	<div class="form-group">
		<label><?php echo "$key :"; ?></label>
		<select name=<?php echo "'rule"."[$key]'"; ?> class="form-control">
		<?php foreach ($value as $key1 => $value1) {
			if (array_key_exists($key, $phone['rule'])) {
				$val=$phone['rule'][$key];
			}
		 ?>
			<option value=<?php echo "'$value1'"; ?><?php echo ($value1===$val) ? 'selected' : '' ; ?>><?php echo "$value1"; ?></option>
			<?php  }?>
		</select>
	</div>


<?php 
	
	}
 ?>
 <button type="Submit" class="btn btn-success">Submit</button>
 </form>
</div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- /. PAGE WRAPPER  -->
</div>
<div class="footer">


  <div class="row">
    <div class="col-lg-12" >
      &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
    </div>
  </div>
</div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
<!-- js SCRIPTS -->
<script src="../assets/js/js.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>


</body>
</html>