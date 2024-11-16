<?php
require_once "consts.php";
require_once "database.php";

session_start();
if (isset($_SERVER['PHP_AUTH_USER'])) {
    if (!DatabaseRedis::$was_logged) {
        DatabaseRedis::loadUserDataTheme();
        DatabaseRedis::saveSessionData();
        DatabaseRedis::$was_logged = true;
    }
}
elseif (!isset($_SESSION[Consts::kTheme])) {
    DatabaseRedis::loadLastUserData();
}

function setTheme($newTheme) {
    $_SESSION[Consts::kTheme] = $newTheme;
    DatabaseRedis::saveTheme();
}

function getTheme() {
    return $_SESSION[Consts::kTheme];
}

function getLogin() {
    return $_SESSION[Consts::kLogin];
}
function getPasswd() {
    return $_SESSION[Consts::kPass];
}

function createHTMLTable($heads, $rows, $columns) {
    $html = '<table class ="' . getTheme() . '">';
    $html .= "<tr>";
    foreach ($heads as $head) {
        $html .= "<th>" . $head . "</th>";
    }
    $html .= "</tr>";
    foreach ($rows as $row) {
        $html .= "<tr>";
        foreach ($columns as $col)
            $html .= "<td>" . $row[$col] . "</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

function replaceKeysFromMySqlRes($rows, $cols, $replace) {
    $new_rows = array();

    foreach ($rows as $row) {
        $new_row = array();
        foreach ($cols as $col) {
            if (array_key_exists($col, $replace)) {
                $key = $replace[$col]['replaceKey'];
                $trans = array("{{$key}}" => $row[$key]);
                
                $new_row += array($col => strtr($replace[$col]["stmt"], $trans));
            }
            else $new_row += array($col => $row[$col]);
        }
        array_push($new_rows, $new_row);
    }

    return $new_rows;
}

?>