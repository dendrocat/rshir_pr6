<?php
function encodeMsg($msg) {
    return json_encode($msg, JSON_UNESCAPED_UNICODE);
}

function createMsg($msg) {
    return encodeMsg(array("message" => $msg));
}

function getInput() {
    return json_decode(file_get_contents("php://input"));
}

function tryCatchCreate($db, $q) {
    try {
        if ($db->query($q)) return true;
        return false;
    }
    catch (Exception $e) {
        return false;
    }
}

function tryCatchDelete($db, $q) {
    try {
        $db->query($q);
        if ($db->affected_rows) return true;
        return false;
    }
    catch (Exception $e) {
        return false;
    }
}
?>