<?php
require("motors.php");
$product = getInventory();
$atbilde = null;
if (isset($_POST['submit'])) {
    $atbilde = storeInventory($_POST['product'], $_POST['price'], $_POST['unit']);
    if ($atbilde == "saved") {
        unset($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noliktava</title>
</head>

<body>

    <h2>Lietotāja izvēles:</h2>

    <form action="index.php" method="post">
        <h3>Pievienot jaunu produktu:</h3>
        Produkts: <input type="text" name="product" value="<?php echo @$_POST['product'] ?>"><br>
        Cena: <input type="text" name="price" value="<?php echo @$_POST['price'] ?>"><br>
        Daudzums: <input type="text" name="unit" value="<?php echo @$_POST['unit'] ?>"><br>
        <input type="submit" name="submit" value="Pievienot">

        <?php
        if ($atbilde == "saved") {
            echo "Saglabāts!";
        } elseif ($atbilde == "not_saved") {
            echo "Saglabāt neizdevās!";
        } elseif ($atbilde == "tuksh") {
            echo "Nav saglabāts! Jāaizpilda visi logi.";
        } elseif ($atbilde == "int_not_valid") {
            echo "Cena un daudzums jānorāda skaitļos.<br>Daudzums tikai veselās vienībās.";
        }
        ?>
    </form>

    <h3>Pārskatīt un rediģēt noliktavu:</h3>

    <button><a href="http://localhost/inventory/inventory.php">Rediģēt</a></button>

    <h3>Meklēt produktu:</h3>

    <form action="index.php" method="get">
        <input type="text" name="search" value="<?php echo @$_GET['search'] ?>">
        <input type="submit" name="mekleet" value="Meklēt"><br>
    </form>

    <?php
    if (isset($_GET['mekleet'])) {
        $search = $_GET['search'];
        foreach ($product as $key => $value) {
            if ($value["product"] == $search) {
                echo "Produkts: " . $value["product"] . "<br>
                Cena: " . $value["price"] . "<br>
                Daudzums: " . $value["unit"] . "<br>";
            }
        }
    }
    ?>

</body>

</html>