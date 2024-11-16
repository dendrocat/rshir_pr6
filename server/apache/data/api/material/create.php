<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/material.php";

function create() {
    $mat = new Material();

    $data = getInput();

    if (!empty($data->name)) {
        $mat->name = $data->name;
        
        if ($mat->create()) {
            http_response_code(201);

            echo createMsg("Запись о материале успешно создана");
        }
        else {
            http_response_code(503);
            echo createMsg("Невозможно создать запись о материале");
        }
    }
    else {
        http_response_code(400);
        echo createMsg("Невозможно создать запись о материале. Данные неполные");
    }
}
?>