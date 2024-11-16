<?php
require_once "../../core/util_pr4.php";
require_once "../../core/database.php";
require_once "../objects/material.php";

function read_all() {
    $mat = new Material();

    $res = $mat->readAll();

    if ($res->num_rows) {
        $mats = array();

        foreach ($res as $row)
            array_push($mats, Material::createArr($row));

        http_response_code(200);
        echo encodeMsg($mats);
    }
    else {
        http_response_code(404);
        echo createMsg("Записи отсутствуют");
    }
}
?>