<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noliktava</title>
</head>

<body>

    <h2>Lietotāja izvēles:</h2>

    <h3>Pievienot jaunu produktu:</h3>

    <form action="index.php" method="post">
        Produkts: <input type="text" name="prodName"><br>
        Cena: <input type="text" name="prodPrice"><br>
        Daudzums: <input type="text" name="prodUnit"><br>
        <input type="submit" name="submit" value="Pievienot">
    </form>

    <h3>Izvadīt info par produktu:</h3>

    <h3>Mainīt produkta cenu:</h3>

    <h3>Mainīt produkta daudzumu:</h3>

    <h3>Dzēst produktu:</h3>

</body>

</html>

<?php

$json = file_get_contents('inventory.json');
$json_data = json_decode($json, true);

$newar = array(
    'produkts' => $_POST['prodName'],
    'cena' => $_POST['prodPrice'],
    'daudzums' => $_POST['prodUnit']
);

array_push($json_data['noliktava'], $newar);

$json = json_encode($json_data);

file_put_contents('inventory.json', $json);

// pievienots jauns produkts

?>