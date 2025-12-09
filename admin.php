<?php
require("config.php");

// --- Lisamine ---
if (isset($_POST['lisamine'])) {
    if (!empty($_POST['toode'])) {
        $paring = $connect->prepare("INSERT INTO kohvik (toode, price, image) VALUES (?, ?, ?)");
        $paring->bind_param("sss", $_POST['toode'], $_POST['price'], $_POST['image']);
        $paring->execute();
        $paring->close();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
}

// --- Kustutamine ---
if (isset($_GET["kustutusid"])) {
    $paring = $connect->prepare("DELETE FROM kohvik WHERE id=?");
    $paring->bind_param("i", $_GET["kustutusid"]);
    $paring->execute();
    header("Location: " . $_SERVER["PHP_SELF"]);
}

// --- Muutmine ---
if (isset($_POST["muutmisid"])) {
    $paring = $connect->prepare("UPDATE kohvik SET toode=?, price=?, image=? WHERE id=?");
    $paring->bind_param("sssi",
        $_POST["toode"],
        $_POST["price"],
        $_POST["image"],
        $_POST["muutmisid"]
    );
    $paring->execute();
    header("Location: " . $_SERVER["PHP_SELF"] . "?id=" . $_POST["muutmisid"]);
}

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Kohvik "KAVA" admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Admin kohvik "KAVA"</h1>

<div id="menu">
    <ul>
        <?php
        $kask = $connect->prepare("SELECT id, toode FROM kohvik");
        $kask->bind_result($id, $toode);
        $kask->execute();
        while ($kask->fetch()) {
            echo "<li><a href='?id=$id' id='sisu'>" . htmlspecialchars($toode) . "</a></li>";
        }
        ?>
    </ul>

    <a href="?lisamine=jah" class='submit'>Lisa ...</a>
</div>

<div id="sisukiht">

<?php
// --- Ühe toote kuvamine ---
if (isset($_GET["id"])) {
    $kask = $connect->prepare("SELECT id, toode, price, image FROM kohvik WHERE id=?");
    $kask->bind_result($id, $toode, $price, $image);
    $kask->bind_param("i", $_GET["id"]);
    $kask->execute();

    if ($kask->fetch()) {

        // Kui MUUTMINE
        if (isset($_GET["muutmine"])) {
            ?>
            <form method="post">
                <h2>Toode muutmine</h2>
                <input type="hidden" name="muutmisid" value="<?=$id?>"/>

                <label>Toode:</label><br>
                <input type="text" name="toode" value="<?=htmlspecialchars($toode)?>"><br><br>

                <label>Hind:</label><br>
                <input type="text" name="price" value="<?=htmlspecialchars($price)?>"><br><br>

                <label>Pilt (URL):</label><br>
                <textarea name="image"><?=htmlspecialchars($image)?></textarea><br><br>

                <input type="submit" value="Muuda">
            </form>
            <?php
        }

        // --- Tavaline vaatamine ---
        else {
            echo "<h2>" . htmlspecialchars($toode) . "</h2>";
            echo "Hind: " . htmlspecialchars($price) . " €<br>";
            echo "<img src='" . htmlspecialchars($image) . "' alt='pilt' height='150'><br><br>";

            echo "<a class='submit' href='?kustutusid=$id'>kustuta</a> ";
            echo "<a class='submit' href='?id=$id&muutmine=jah'>muuda</a>";
        }
    } else {
        echo "Vigased andmed.";
    }
}

// --- Lisamisvorm ---
elseif (isset($_GET['lisamine'])) {
    ?>
    <h2>Lisa uus toode</h2>

    <form method="post">
        <input type="hidden" name="lisamine" value="jah">

        <label>Toode:</label><br>
        <input type="text" name="toode"><br><br>

        <label>Hind:</label><br>
        <input type="text" name="price"><br><br>

        <label>Pildi URL:</label><br>
        <textarea name="image"></textarea><br><br>

        <input type="submit" value="Sisesta">
    </form>
    <?php
}

?>
</div>
</body>
<footer>
    Lehe tegi Oleksandra Ryshniak
</footer>
</html>

<?php 
$connect->close(); 
?>
