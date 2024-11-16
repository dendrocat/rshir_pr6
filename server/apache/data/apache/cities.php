<?php
require_once "../core/util_pr5.php"; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
        <title>Page Cities</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
</head>
<body class="<?php echo getTheme() ?>">
    <div class="nav">
        <a class="<?php echo getTheme() ?>"  href="../nav.html">Назад</a>
    </div>
    <h1>Страница городов</h1>

    <?php 
        $q = "SELECT * FROM cities";
        $rows = DatabaseSQL::query($q);

        $heads = array("Название", "Индекс", "Численность населения", "Мэр", "Страна");
        $columns = array("name", "postcode", "number", "mayor", "country");

        echo createHTMLTable($heads, $rows, $columns);
    ?>
</body>
</html>