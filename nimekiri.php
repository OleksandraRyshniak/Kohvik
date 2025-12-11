<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__,1));}?>

<?php
require ("config.php");
global $connect;
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <title>Kohvikuhindade nimekiri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Kohvikuhindade nimekiri</h1>
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
<div class="check">
    <?php
    global $connect;

    $paring=$connect->prepare("SELECT toode, price, image FROM kohvik WHERE avalik=1");
    $paring->bind_result($toode, $price, $image);
    $paring->execute();

    while($paring->fetch()){
        echo "<tr>";
        echo "<img src='$image' alt='kohv'>"."<br>";
        echo "$toode"." : ".$price."€"."<br>";
        echo "</tr>";
    }
    ?>
    <br><br>
    <a href="Avaleht.php" class='submit'>Tagasi</a>
</div>
<footer>
    Lehe tegi Oleksandra Ryshniak
</footer>
