<?php
  /**
  * 
  */
  require_once 'AHP.php';

  if (isset($_GET['name'])) {
    $hierarki1=new Kriteria(json_decode(file_get_contents('lib/kriteria/kriteria.json'),true));

    if (in_array($_GET['name'], $hierarki1->name)) {
      if (isset($hierarki1->child[$_GET['name']])) {
        $child=new Kriteria($hierarki1->child[$_GET['name']]);

      }else{
        $child=array();
      }
      
    }else {
      header('location:admin.php');
    }
  }else {
    header('location:admin.php');
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
           <h2>Sub Kriteria dari <?php echo $_GET['name']; ?></h2>   
         </div>
       </div>              
       <!-- /. ROW  -->
       <hr />
       <?php 
        if (!empty($child)) {
          require_once 'exist.php';
        }else {
          require_once 'notexist.php';
        }
        ?>
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
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
<!-- js SCRIPTS -->
<script src="assets/js/js.js"></script>


</body>
</html>
