<?php
require_once "../core/util_pr5.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Page Delete File</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
    </head>
    <body class="<?php echo getTheme() ?>">
        <div class="nav">
            <a class="<?php echo getTheme() ?>"  href="../nav.html">Назад</a>
        </div>
        <h1>Страница удаления файлов</h1>
        <div class="cont">
            <form method="post">
                <label for="ID">Введите ID файла:</label>
                <input type="number" name="ID" id="ID">
                <button type="submit" name="delBtn">Удалить</button>
            </form>
        </div>
        <div style="margin: 40px"></div>
        <?php

            if (isset($_POST['delBtn'])) {
                if (!isset($_POST['ID'])) {
                    echo "Поле ID должно быть заполнено";
                    die();
                }
                $sql = "DELETE FROM pdf_files WHERE ID={$_POST['ID']}";
                if (DatabaseSQL::query($sql)) {
                    echo "Файл с ID = {$_POST['ID']} был успешно удален";
                }
                else echo "Операция удаления провалена";
            }
        ?>
    </body>
</html>