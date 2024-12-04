<?php
require "motors.php";
$product = getInventory();
$atbilde = null;
if (isset($_GET['deletion'])) {
    $array_key = $_GET['key'];
    $atbilde = deleteProduct($product, $array_key);
}
if (isset($_GET['change_unit'])) {
    $array_key = $_GET['key'];
    $new_unit = $_GET['new_unit'];
    $atbilde = changeUnit($product, $array_key, $new_unit);
}
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krājumi</title>
</head>

<body>

    <h1>Krājumi</h1>

    <p>
        <?php
        $prices = array_column($product, 'price');
        $total = null;
        foreach ($prices as $price) {
            $total += $price;
        }
        echo "Kopējā krājumu vērtība ir:  " . $total . "<br>";
        ?>
    </p>

    <h3>Visi produkti:</h3>

    <?php
    foreach ($product as $key => $value) {
    ?>
        <p>
            Produkts: <?php echo $value["product"] ?><br>
            Cena: <?php echo $value["price"] ?><br>
            Daudzums: <?php echo $value["unit"] ?><br>
        </p>

        <p>
            <?php
            if ($value["unit"] < 10) {
                echo "!!!!! Krājumam ir palikušas mazāk par 10 vienībām !!!!!!";
            }
            ?>
        </p>

        <form action="inventory.php" method="get">
            Mainīt daudzumu:
            <input type="text" name="new_unit" value="<?php echo @$_GET['new_unit'] ?>">
            <input type="hidden" name="key" value="<?php echo $key ?>">
            <input type="submit" name="change_unit" value="Mainīt">
        </form>

        <form action="inventory.php" method="get">
            Vai dzēst produktu?
            <input type="hidden" name="key" value="<?php echo $key ?>">
            <input type="submit" name="deletion" value="Dzēst">

        </form>

        <p>----------------------------<br></p>

    <?php
    }
    ?>

    <button><a href="http://localhost/inventory/index.php">Pievienot jaunu produktu</a></button>

</body>

</html>