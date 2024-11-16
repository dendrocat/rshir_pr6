<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/material.php";

function read_one() {
    $mat = new Material();

    $mat->id = $_GET['ID'];

    $mat->readOne();
    if ($mat->name) {
        http_response_code(200);
        echo encodeMsg($mat->getArr());
    }
    else {
        http_response_code(404);
        echo createMsg("Невозможно найти запись с ID = {$mat->id}");
    }
}
?>