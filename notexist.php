<div class="panel panel-primary">
<div class="panel-heading">
  
</div>
  <div class="panel-body">
    <p>Sub Kriteria <?php echo $_GET['name'] ?> belum memiliki sub kriteria. Silahkan buat sub kriteria di bawah.</p>
  </div>
  
</div>
<button class="btn btn-info pull-right" onclick="addColumn()">Add</button>
<form action="editsub.php" method="post">



    <?php echo "<input type='hidden' name='parent' value='".$_GET['name']."'>"; ?>
    <table id="bobot" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td></td>
                <td>
                    <div class="col-lg-9">
                        <input id="x0" class="form-control" type="text" name="name[]" value="Sub 1" onkeyup="updateName('x0')">
                    </div>
                    <div class="col-lg-1">
                        <button onclick="deleteRowCol(1)" type="button" class="btn btn-danger">-</button>
                    </div>
                </td>
                <td>
                    <div class="col-lg-9">
                        <input id="x1" class="form-control" type="text" name="name[]" value="Sub 2" onkeyup="updateName('x1')">
                    </div>
                    <div class="col-lg-1">
                        <button onclick="deleteRowCol(2)" type="button" class="btn btn-danger">-</button>
                    </div>
                </td>
                <td>
                    <div class="col-lg-9">
                        <input id="x2" class="form-control" type="text" name="name[]" value="Sub 3" onkeyup="updateName('x2')">
                    </div>
                    <div class="col-lg-1">
                        <button onclick="deleteRowCol(3)" type="button" class="btn btn-danger">-</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td id="0x">Sub 1</td>
                <td>
                    <input id="0-0" class="form-control" type="text" name="value[0][]" value="1" readonly="">
                </td>
                <td>
                    <input id="0-1" class="form-control" type="text" name="value[0][]" onkeyup="updateInverse('0-1')" value="0">
                </td>
                <td>
                    <input id="0-2" class="form-control" type="text" name="value[0][]" onkeyup="updateInverse('0-2')" value="0">
                </td>
            </tr>
            <tr>
                <td id="1x">Sub 2</td>
                <td>
                    <input id="1-0" class="form-control" type="text" name="value[1][]" onkeyup="updateInverse('1-0')" value="0">
                </td>
                <td>
                    <input id="1-1" class="form-control" type="text" name="value[1][]" value="1" readonly="">
                </td>
                <td>
                    <input id="1-2" class="form-control" type="text" name="value[1][]" onkeyup="updateInverse('1-2')" value="0">
                </td>
            </tr>
            <tr>
                <td id="2x">Sub 3</td>
                <td>
                    <input id="2-0" class="form-control" type="text" name="value[2][]" onkeyup="updateInverse('2-0')" value="0">
                </td>
                <td>
                    <input id="2-1" class="form-control" type="text" name="value[2][]" onkeyup="updateInverse('2-1')" value="0">
                </td>
                <td>
                    <input id="2-2" class="form-control" type="text" name="value[2][]" value="1" readonly="">
                </td>
            </tr>
        </tbody>
    </table>
    <input type="submit" value="Buat Sub Kriteria" class="btn btn-primary">
</form>