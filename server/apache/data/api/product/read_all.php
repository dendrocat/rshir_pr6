<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/product.php";

function read_all() {
    $product = new Product();

    $res = $product->readAll();

    if ($res->num_rows) {
        $products = array();

        foreach ($res as $row)
            array_push($products, Product::createArr($row));

        http_response_code(200);
        echo encodeMsg($products);
    }
    else {
        http_response_code(404);
        echo createMsg("Записи отсутствуют");
    }
}
?>