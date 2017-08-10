<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  $noterror=0;
  if (!empty($_POST['username'])) {
  	$data=$_POST;
  	$credential=json_decode(file_get_contents('../login/accounts.json'),true);
  	$credential[$data['username']]=array('name'=>$data['name'],'email'=>$data['email'],'password'=>$data['password']);
  	file_put_contents('../login/accounts.json', json_encode($credential));
  	$noterror=1;
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
                     <h2>Create New Admin</h2>   
                    </div>
                </div> 
                <hr />
                <div class="row">
                	<div class="col-lg-12">
                	<?php 
                		if ($noterror===1) {
                			?>
                				<div class="alert alert-info">
                		New Admin Created!
                	</div>
                			<?php
                		}
                	 ?>
                	
                		<div class="col-lg-4 col-offset-8">
                			<form action="createadmin.php" method="post">
	                			<div class="form-group">
	                				<label for="username" class="control-label">Username:</label>
	                				<input type="text" name="username" class="form-control" required="" id="username">
	                			</div>
	                			<div class="form-group">
	                				<label for="name" class="control-label">Name:</label>
	                				<input type="text" name="name" class="form-control" required="" id="name">
	                			</div>
	                			<div class="form-group">
	                				<label for="email" class="control-label">Email:</label>
	                				<input type="text" name="email" class="form-control" required="" id="email">
	                			</div>
	                			<div class="form-group">
	                				<label for="password" class="control-label">Initial Password:</label>
	                				<input type="text" name="password" class="form-control" required="" id="password">
	                				
	                			</div>
	                			<div class="alert alert-success">
	                					I will inform the admin to change the password immediately.<br/>
	                					<button type="submit" class="btn btn-success">Submit</button>
	                				</div>
	                		</form>
                		</div>
	                		
                	</div>
                </div>
                  <!-- /. ROW  --> 
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
    
   
</body>
</html>