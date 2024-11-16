<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/product.php";

function read_one() {
    $product = new Product();

    $product->id = $_GET['ID'];

    $product->readOne();

    if ($product->name) {
        http_response_code(200);
        echo json_encode($product->getArr());
    }
    else {
        http_response_code(404);
        echo createMsg("Невозможно найти запись с ID = {$product->id}");
    }
}
?>