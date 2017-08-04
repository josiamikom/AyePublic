<div class="row">
         <div class="col-lg-12">
           <form action="deletesub.php" method="post">
           
           <?php echo "<input type='hidden' name='parent' value='".$_GET['name']."'>"; ?>
             <button type="submit" class="btn btn-danger pull-right">Delete Sub Kriteria</button>
           </form>
         </div>
       </div>
       <!-- /. ROW  --> 
       <div class="row">
        <div class="col-lg-12 ">
          <h3>Bobot</h3>
          <button class="btn btn-info pull-right" onClick="addColumn()">Add</button>
          <form action="editsub.php" method="post">
          
          

          <?php
          echo "<input type='hidden' name='parent' value='".$_GET['name']."'>";
          echo "<table id='bobot' class='table table-striped table-bordered table-hover'>";
          echo "<tr><td></td>";
          $pv=$child->getPV();
          foreach ($child->name as $key => $value) {
            echo "<td><div class='col-lg-9'>";
            echo "<input class='form-control' type='text' name='name[]'  value='".$value."'>";
            echo "</div>";echo "<div class='col-lg-1'>";
            echo "<button onClick='deleteRowCol(".($key+1).")' type='button' class='btn btn-danger'>-</button>";echo "</div></td>";
          }
          echo "</tr>";
          foreach ($child->values as $i => $value) { 
            echo "<tr>";
            echo "<td>".$child->name[$i]."</td>";
            for ($j=0; $j < sizeof($child->values); $j++) { 
              if ($i==$j) {
                echo "<td><input id='$i-$j' class='form-control' type='text' name='value[".$i."][]'  value='".$child->values[$i][$j]."'readonly></td>";
              }else {
                echo "<td><input id='$i-$j' class='form-control' type='text' name='value[".$i."][]' onKeyUp='updateInverse(\"$i-$j\")' value='".$child->values[$i][$j]."'></td>";
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
          foreach ($child->name as $key => $value) {
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
          if ($child->getCR()['value']<=0.1) {
            echo "<tr class='success'><td>".$child->getCR()["status"]."</td></tr>";
          }else {
            echo "<tr class='danger'><td>".$child->getCR()['status']."</td></tr>";
          }
          echo "<tr><td>".$child->getCR()['value']."</td></tr>";

          echo "</table>";
          ?>

        </div>
      </div>