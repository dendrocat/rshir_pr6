<?php
require_once "../core/util_pr5.php";
require_once "../core/database.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
        <title>Page Graphics</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
</head>
<body class="<?php echo getTheme() ?>">
    <div class="nav">
        <a class="<?php echo getTheme() ?>"  href="../nav.html">Назад</a>
    </div>
    <h1>Страница графиков</h1>

    <?php 
        $q = "SELECT * FROM graphs";
        $rows = DatabaseSQL::query($q);

        $heads = array("Название", "График");
        $columns = ["name", 'img'];


        $replace = ["img" => [
                            "replaceKey" => "path",
                            "stmt" => "<img src='{path}' class='graph'>"
                        ]];
        $rows = replaceKeysFromMySqlRes($rows, $columns, $replace);
        echo createHTMLTable($heads, $rows, $columns);
    ?>
</body>
</html>
<?php

?>