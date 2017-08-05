<?php
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
  /**
  * 
  */
  require_once '../lib/AHP.php';


  $hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));
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
           <h2>Kriteria</h2>   
         </div>
       </div>              
       <!-- /. ROW  -->
       <hr />

       <!-- /. ROW  --> 
       <div class="row">
        <div class="col-lg-12 ">
          <h3>Bobot</h3>
          <button class="btn btn-info pull-right" onClick="addColumn()">Add</button>
          <form action="edit.php" method="post">
          
          

          <?php
          echo "<table id='bobot' class='table table-striped table-bordered table-hover table-responsive'>";
          echo "<tr><td></td>";
          $pv=$hierarki1->getPV();
          foreach ($hierarki1->name as $key => $value) {
            echo "<td><div class='col-lg-9'>";
            echo "<input id='x".$key."' class='form-control' type='text' name='name[]'  value='".$value."' onKeyUp='updateName(\"x".$key."\")'>";
            echo "</div>";echo "<div class='col-lg-1'>";
            echo "<button onClick='deleteRowCol(".($key+1).")' type='button' class='btn btn-danger'>-</button>";echo "</div></td>";
          }
          echo "</tr>";
          foreach ($hierarki1->values as $i => $value) { 
            echo "<tr>";
            echo "<td id='".$i."x'>".$hierarki1->name[$i]."</td>";
            for ($j=0; $j < sizeof($hierarki1->values); $j++) { 
              if ($i==$j) {
                echo "<td><input id='$i-$j' class='form-control' type='text' name='value[".$i."][]'  value='".$hierarki1->values[$i][$j]."'readonly></td>";
              }else {
                echo "<td><input id='$i-$j' class='form-control' type='text' name='value[".$i."][]' onKeyUp='updateInverse(\"$i-$j\")' value='".$hierarki1->values[$i][$j]."'></td>";
              }


            }

          }
          echo "</table>";
          ?>
          <input type="submit" value="Save" class="btn btn-success">
          </form>
        </div>
      </div>
      <!-- /. ROW  --> 
      <div class="row">
        <div class="col-lg-12 ">
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

        </div>
      </div>
      <!-- /. ROW  --> 
      <div class="row">
        <div class="col-lg-12 ">
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
