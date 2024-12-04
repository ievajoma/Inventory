<?php
require("motors.php");
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
        }
        ?>
    </form>

    <h3>Pārskatīt un rediģēt noliktavu:</h3>

    <button><a href="http://localhost/inventory/inventory.php">Rediģēt</a></button>

</body>

</html>