<?php 

	include_once '../lib/fonoApi/fonoApi.php';
	$token='d0275c61dc28964d454ba894f521d8815d5d612c779195c0';
	$fonoApi=fonoApi::debug($token);
	try {
		if (!empty($_GET['keyword'])) {
			$result=$fonoApi::getDevice($_GET['keyword']);
		}
		
	} catch (Exception $e) {
		echo "ERROR : " . $e->getMessage();
	}
require_once 'header.php';
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
           <h2>Cari Smartphone</h2>
           <p>Cari smartphone untuk ditambahkan</p>   
         </div>
       </div>              
       <!-- /. ROW  -->
       <hr />
       <form action="search.php" method="get">
           	<input class="form-control col-lg-" type="text" name="keyword" placeholder="Search here..." value=<?php echo (!empty($result)) ? $_GET['keyword'] : '' ; ?>>
           
             
        </form>
        <br>
        <div>
        
        
        	<?php $spec=''; if (!empty($result)) {
        		?><table class='table table-striped  table-hover' >
        	<tr>
        		<th>Brand</th>
        		<th>Device Name</th>
        		<th>Status</th>
        		<th>Action</th>
        	</tr><?php 
        		foreach ($result as $value) {
        			echo "<tr>";
        			echo "<td>$value->Brand</td>";
        			echo "<td>$value->DeviceName</td>";
        			echo "<td>$value->status</td>";
        			echo "<td><a href='add.php?name=$value->DeviceName'><button class='btn btn-success'>+</button></a></td>";
        			echo "</tr>";
        		}
        	} ?>
        	</table>
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
