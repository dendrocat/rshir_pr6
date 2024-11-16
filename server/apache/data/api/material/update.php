<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/material.php";

function update() {
    $mat = new Material($db);

    $data = getInput();
    $mat->id = $data->ID;
    $mat->name = $data->name;

    if ($mat->update()) {
        http_response_code(200);
        echo createMsg("Запись была успешно изменена");
    }
    else {
        http_response_code(404);
        echo createMsg("Невозможно изменить запись с ID = {$data->ID}");
    }
}
?>