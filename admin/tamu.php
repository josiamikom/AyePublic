<?php
  if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  
  $feedbacks=json_decode(file_get_contents('../home/feedback.json'),true);
  if (!empty($_POST['message'])&& isset($_POST['message'])) {
    date_default_timezone_set('Asia/Jakarta'); // CDT


    $put=$_POST;
    $put['timestamp']=date('d M Y, h:ia O');
    $feedbacks[]=$put;
    file_put_contents('../home/feedback.json', json_encode($feedbacks)); 
  }
  $feedbacks=array_reverse($feedbacks,true);
  date_default_timezone_set('Asia/Jakarta'); // CDT

$current_date = date('d M Y, h:ia O');
$name=$_COOKIE['name'];
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
                      <h2>Reply</h2>
                      <form action="tamu.php" method="post">
                      
                      <input type="hidden" name="name" value=<?php echo "'$name'"; ?>>
                      <input type="hidden" name="type" value="admin">
                        <textarea class="col-lg-12" name="message" rows="6" placeholder="Write your message here..." required=""></textarea>

                        <button type="submit" class="btn btn-success pull-right" style="margin-top:10px;">Submit</button>
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
        <div class="col-lg-10 pull-right">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <?php 
          echo "$value[name] | $value[timestamp] | ";
           ?>
           <a href=<?php echo "'deletefeed.php?id=$key'"; ?>>Delete</a>
        </div>
        <div class="panel-body">
          <?php echo "$value[message]"; ?>
        </div>
      </div>
    </div>

        <?php
      }else {
        ?>

          <div class="col-lg-10 pull-left">
      <div class="panel panel-info">
        <div class="panel-heading">
          <?php 
          echo "$value[name] | $value[timestamp] |";
           ?>
           <a href=<?php echo "'deletefeed.php?id=$key'"; ?>>Delete</a>
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
                 <!-- /. ROW  -->
                 
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
				&copy;  2017 Galvani Natasya | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
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
