<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  $error=0;
  $credential=json_decode(file_get_contents('../login/accounts.json'),true);
  if (!empty($_POST['type'])) {
  	if ($_POST['type']==='info') {
  		$credential[$_COOKIE['session']]['name']=$_POST['name'];
  		$credential[$_COOKIE['session']]['email']=$_POST['email'];
  		file_put_contents('../login/accounts.json', json_encode($credential));
  	}else {
  	$data=$_POST;
  	if ($data['old']===$credential[$_COOKIE['session']]['password']) {
  		if ($data['new']===$data['verify']) {
  			$credential[$_COOKIE['session']]['password']=$data['new'];
  			file_put_contents('../login/accounts.json', json_encode($credential));
  		}else {
  			$error=2;
  		}
  	}else {
  		$error=1;
  	}
  }
  }
  $credential=$credential[$_COOKIE['session']];
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
                     <h2>My Account</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                
                  <!-- /. ROW  --> 
                <div class="row">
                	<div class="col-lg-6">
                		<h3>Account Info</h3>
                		<div class="col-lg-12">
                			<form action="myaccount.php" method="post">
                				<input type="hidden" name="type" value="info">
                				<div class="form-group">
                					<label for="name">Name:</label>
                					<input class="form-control" type="text" name="name" value=<?php echo "'$credential[name]'"; ?> required>
                				</div>
                				<div class="form-group">
                					<label for="email">Email Address:</label>
                					<input type="text" name="email" class="form-control" required="" value=<?php echo "'$credential[email]'"; ?>>
                				</div>
                				<div class="form-group">
                					<button type="submit" class="btn btn-success pull-right">Save</button>
                				</div>
                			</form>
                		</div>
                	</div>
                	<div class="col-lg-6">
                		<h3>Change Password</h3>
                		<form action="myaccount.php" method="post">
                			<input type="hidden" name="type" value="password">
                			<div class="form-group">
                				<label for="old">Old Password</label>
                				<input type="password" name="old" required="" class="form-control">
                			</div>
                			<div class="form-group">
                				<label for="new">New Password</label>
                				<input type="password" name="new" required="" class="form-control">
                			</div>
                			<div class="form-group">
                				<label for="verify">Verify New Password</label>
                				<input type="password" name="verify" required="" class="form-control">
                			</div>
                			<?php 
                				if ($error===1) {
                					?>

                					<div class="form-group">
                				<div class="alert alert-danger">
                					Wrong Password!
                				</div>
                			</div>

                					<?php
                				}elseif ($error===2) {
                					?>
<div class="form-group">
                				<div class="alert alert-danger">
                					New and Verify Password didn't match!
                				</div>
                			</div>

                					<?php
                				}
                			 ?>
                			
                			
                			<div class="form-group">
                					<button type="submit" class="btn btn-success pull-right">Save</button>
                				</div>
                		</form>
                	</div>
                </div>            
                 <!-- /. ROW  --> 
                
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