<?php
header("Access-Control-Allow-Origin: *");
header("Access-Contol-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Contol-Allow-Methods, Content-Type");

require_once "./create.php";
require_once "./delete.php";
require_once "./read_all.php";
require_once "./read_one.php";
require_once "./update.php";


switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        if (isset($_GET['ID'])) {
            read_one();
        }
        else read_all();
        break;
    case "POST":
        create();
        break;
    case "DELETE":
        if (!isset($_GET['ID'])) {
            http_response_code(400);
            echo createMsg("Невозможно удалить материал. Не указан ID материала");
            die();
        }
        delete();
        break;
    case "PUT":
        update();
        break;
    default:
        http_response_code(400);
        echo createMsg("Неверный запрос");
}
?>