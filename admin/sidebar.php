<?php 
require_once '../lib/AHP.php';
$hierarki1=new Kriteria(json_decode(file_get_contents('../lib/kriteria/kriteria.json'),true));


if (isset($_GET['name'])) {
    $names=$_GET['name'];
}else{
    $names='';
}
?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">



            <li <?php echo (end(explode("/", $_SERVER['REQUEST_URI']))==='index.php') ? 'class="active-link"' : '' ; ?>>
                <a href="index.php" ><i class="fa fa-home "></i>Home</a>
            </li>


            <li <?php echo (end(explode("/", $_SERVER['REQUEST_URI']))==='kriteria.php') ? 'class="active-link"' : '' ; ?>>
                <a href="kriteria.php"><i class="fa fa-table "></i>Kriteria</a>
            </li>
            

            </li>
            <?php 
            if (isset($hierarki1->child)   ) {
                foreach ($hierarki1->name as $key => $value) {
                    ?>
                    <?php echo ($names===$value) ? '<li class="active-link">' : '<li>' ; 
                    echo "<a href='subkriteria.php?name=".$value."' >  ---<i class='fa fa-edit'></i>".$value."</a></li>";
                    ?>
                    <?php 
                }
            }
            ?>
            <li <?php echo (end(explode("/", $_SERVER['REQUEST_URI']))==='info.php') ? 'class="active-link"' : '' ; ?>>
                <a href="info.php"><i class="fa fa-mobile "></i>Informasi Smartphone</a>
            </li>
            <li <?php echo (end(explode("/", $_SERVER['REQUEST_URI']))==='blank.php') ? 'class="active-link"' : '' ; ?>>
                <a href="tamu.php"><i class="fa fa-flag "></i>Tamu</a>
            </li>


        </ul>
    </div>

</nav>