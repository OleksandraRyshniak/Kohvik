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
<div class="check">
    <?php
    global $connect;
    $paring=$connect->prepare("SELECT toode, price, image FROM kohvik");
    $paring->bind_result($toode, $price, $image);
    $paring->execute();

    while($paring->fetch()){
        echo "<tr>";
        echo "<img src='$image' alt='kohv'>"."<br>";
        echo "$toode"." : ".$price."€"."<br>";
        echo "</tr>";
    }
    ?>
</div>
<footer>
    Lehe tegi Oleksandra Ryshniak
</footer>