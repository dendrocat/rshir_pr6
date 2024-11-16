<?php 
require_once "../core/util_pr5.php";

if (isset($_GET['FILE_ID'])) {
    $id = $_GET['FILE_ID'];
    
    $sql = DatabaseSQL::getConnection();
    
    $stmt = $sql->prepare("SELECT name, type, size, data FROM pdf_files where ID=?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $stmt->bind_result($name, $type, $size, $data);
        if ($stmt->fetch()) {             
            header("Content-Type: " . $type);
            header("Content-Disposition: attachment; filename=\"" . basename($name) . "\"");
            header("Content-Length: " . strlen($data));
        
            echo $data;
        }
    }

    $sql->close();
}
?>