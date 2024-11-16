<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/product.php";

function create() {
    $product = new Product();

    $data = getInput();

    if (
        !empty($data->name) &&
        !empty($data->price) &&
        !empty($data->matID)
    ) {
        $product->name = $data->name;
        $product->price = $data->price;
        $product->matID = $data->matID;

        if ($product->create()) {
            http_response_code(201);
            echo createMsg("Запись о товаре успешно создана");
        }
        else {
            http_response_code(400);
            echo createMsg("Невозможно создать запись о товаре");
        }
    }
    else {
        http_response_code(400);
        echo createMsg("Невозможно создать запись о товаре. Данные неполные");
    }
}
?>