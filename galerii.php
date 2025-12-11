<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__,1));}
require ('config.php');
global $connect;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Galerii</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Pildigalerii kohvik "KAVA"</h1>
<nav>
    <ul>
        <li>
            <a href="Avaleht.php">Avaleht</a>
        </li>
        <li>
            <a href="nimekiri.php">Kohvikuhindade nimekiri</a>
        </li>
        <li>
            <a href="admin.php">Administraator</a>
        </li>
        <li>
            <a href="galerii.php">Pildigalerii</a>
        </li>
    </ul>
</nav>
<div class="main-content">
<div id="menu1">
    <?php
    global $connect;
    $paring=$connect->prepare("Select id, image from kohvik where avalik=1");
    $paring->bind_result($id,$image);
    $paring->execute();
    while($paring->fetch()){
        echo "<ul><li><a href='?id=$id'>"."<img width='200' src='$image' alt='pilt'> "."</a></li></ul>";
    }
    echo "<br>";
    ?>
    </div>
    <div id="sisukiht">
        <?php
        global $connect;
        if(isset($_REQUEST['id'])){
            $paring=$connect->prepare(
                "Select id, toode, price, avalik from kohvik WHERE id=?");
            $paring->bind_result($id, $toode, $price, $avalik);
            $paring->bind_param("i", $_REQUEST['id']);
            $paring->execute();

            if($paring->fetch()){
                echo "<strong>Toode: </strong>".htmlspecialchars($toode)."<br>";
                echo "<strong>Hind: </strong>".htmlspecialchars($price)."<br>";
                $tekst='Peidetud';
                if($avalik==1){
                    $tekst='Näidatud';
                    echo "<strong>Staatus: </strong>"."$tekst"."<br>";
                }else{
                    echo "<strong>Staatus: </strong>"."$tekst"."<br>";
                }
            }
        }?>
    </div>
</div>
</body>
<footer>
    Lehe tegi Oleksandra Ryshniak
</footer>
</html>
