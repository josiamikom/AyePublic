<?php 
require_once '../lib/AHP.php';
	$phoneList=json_decode(file_get_contents('../lib/phone/phoneList.json'),true);
	$rule=array_keys( reset($phoneList)['rule']);
	$hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
	$kriteria=$hierarki1->name;
require_once 'header.php'; ?>
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
          <a href="#" style="color:#fff;">LOGOUT</a>  

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
           <h2>Informasi Smartphone</h2>   
         </div>
       </div>              
       <!-- /. ROW  -->
       <hr />
       <?php 
       		if ($kriteria!==$rule) {
       			?>
       			<div class="col-lg-12">
       		<div class="panel panel-danger">
       			<div class="panel-heading">
       				Warning
       			</div>
       			<div class="panel-body">
       				<div class="col-lg-12">
                Terdapat kriteria yang tidak sesuai pada kriteria smartphone. 
              </div>
              <br/>
              <div class="col-lg-6">
                <table class="table table-responsive">
                  <tr>
                    <th>Kriteria</th>
                  </tr>
                  <?php 
                    foreach ($kriteria as $key => $value) {
                      ?>
                        <tr>
                          <td><?php echo "$value"; ?></td>
                        </tr>
                      <?php
                    }
                   ?>
                </table>
              </div>
              <div class="col-lg-6">
                <table class="table table-responsive">
                  <tr>
                    <th>Kriteria Smartphone</th>
                  </tr>
                  <?php 
                    foreach ($rule as $key => $value) {
                      ?>
                        <tr>
                          <td><?php echo "$value"; ?></td>
                        </tr>
                      <?php
                    }
                   ?>
                </table>
              </div>
       			</div>
       		</div>
       </div>
       			<?php
       		}
        ?>
       
       <div class="col-lg-12">
       	<form action="search.php" method="post">
           
           
             <button type="submit" class="btn btn-info pull-right">Tambah Smartphone</button>
        </form>
       </div>
       

        <div class="col-lg-12">
        <div class="table-responsive">
        	<table class="table table-bordered table-hovered table-condensed">
        	<tr>
        		<th>Action</th>
        		<th>Brand</th>
        		<th>Device Name</th>
        		<?php 
        			foreach ($rule as $key => $value) {
        				echo "<th>$value</th>";
        			}
        		 ?>
        	</tr>
        	<?php 
        		foreach ($phoneList as $key => $value) {
        			?>
        			<tr>
        				<td><a href=<?php echo "'editphone.php?brand=$value[Brand]&name=$value[Name]'"; ?>><i class="fa fa-edit"></i>Edit</a></td>
        				<td><?php echo "$value[Brand]"; ?></td>
        				<td><?php echo "$value[Name]"; ?></td>
        				<?php 
        					foreach ($value['rule'] as $key1 => $value1) {
        						# code...
        					
        				 ?>
        				 <td><?php echo "$value1"; ?></td>
        				 <?php } ?>
        			</tr>

        			<?php
        		}
        	 ?>
        </table>
        </div>
        
        	<?php echo "<pre>";print_r($kriteria);print_r($rule);print_r($phoneList);echo "</pre>"; ?>
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


</body>
</html>
