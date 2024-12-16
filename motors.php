<?php
function storeInventory($product, $price, $unit)
{

    $filter_price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
    $filter_unit = filter_input(INPUT_POST, "unit", FILTER_VALIDATE_INT);
    if (!empty($filter_price) && !empty($filter_unit)) {
        $new_product = [
            "product" => $product,
            "price" => $price,
            "unit" => $unit
        ];
    }else{
        return "int_not_valid";
    }

    foreach ($new_product as $value) {
        if ($value == "") {
            return "tuksh";
        }
    }

    $sanitized_product = array_map(function ($item) {
        return htmlspecialchars($item);
    }, $new_product);

    if (filesize("inventory.json") == 0) {
        $data_to_save = array($sanitized_product);
    } else {
        $old_records = json_decode(file_get_contents("inventory.json"), true);
        array_push($old_records, $sanitized_product);
        $data_to_save = $old_records;
    }

    $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (!file_put_contents("inventory.json", $encoded_data, LOCK_EX)) {
        return "not_saved";
    } else {
        return "saved";
    }
}

function getInventory()
{
    $product = file_get_contents("inventory.json");
    $decoded_product = json_decode($product, true);

    return $decoded_product;
}

function deleteProduct($product, $key)
{
    unset($product[$key]);

    $encoded_data = json_encode($product, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $atbilde = file_put_contents("inventory.json", $encoded_data, LOCK_EX);
    if (!$atbilde) {
        return "error";
    } else {
        return header("Location: inventory.php");
    }
}

function changeUnit($product, $key, $new_unit)
{
    if (!empty($new_unit)) {

        $new_unit = filter_input(INPUT_GET, "new_unit", FILTER_VALIDATE_INT);

        if (!empty($new_unit)) {

            $product[$key]["unit"] = $new_unit;

            $encoded_data = json_encode($product, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $atbilde = file_put_contents("inventory.json", $encoded_data, LOCK_EX);
            if (!$atbilde) {
                return "error";
            } else {
                return header("Location: inventory.php");
            }

        } else {
            $_GET["new_unit"] = null;
            return "new_unit_not_valid";
        }
    }
}
