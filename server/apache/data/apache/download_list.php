<?php require_once "../core/util_pr5.php" ?>

<!DOCTYPE html>
<html lang="ru">
<head>
        <title>Page Download</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
</head>
<body class="<?php echo getTheme() ?>">
    <div class="nav">
        <a class="<?php echo getTheme() ?>"  href="../nav.html">Назад</a>
    </div>
    <h1>Страница загрузки файлов с сервера</h1>

    <?php 
        $q = "SELECT * FROM pdf_files";

        $head = array("ID", "Имя файла", "Тип файла", "Размер файла", "Ссылка");
        $columns = array("ID", "name", "type", "size", "ref");
        $rows = DatabaseSQL::query($q);

        $replace = array("ref" => 
                            array(
                                "replaceKey" => "ID",
                                "stmt" => "<a href='./download.php?FILE_ID={ID}'>Загрузить</a>"));
        
        $rows = replaceKeysFromMySqlRes($rows, $columns, $replace);

        echo createHTMLTable($head, $rows, $columns);
    ?>
</body>
</html>