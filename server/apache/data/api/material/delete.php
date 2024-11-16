<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/material.php";

function delete() {
    $mat = new Material();


    $mat->id = $_GET['ID'];

    if ($mat->delete()) {
        http_response_code(200);
        echo createMsg("Запись успешно удалена");
    }
    else {
        http_response_code(404);
        echo createMsg("Невозможно удалить запись c ID = {$mat->id}");
    }
}
?>