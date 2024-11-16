<?php
require_once "../core/util_pr5.php";
?>

<html lang="ru">
    <head>
        <title>Page READ</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
    </head>
    <body class="<?php echo getTheme() ?>">
        <div class="nav">
            <a class="<?php echo getTheme() ?>"  href="../nav.html">Назад</a>
        </div>
        <h1>Таблица товаров</h1>
        <div class="cont">
            <?php 
                $q = "SELECT products.ID as ID, products.name as name, price, materials.name as mat FROM products JOIN materials on products.matID = materials.ID";

                $heads = array("ID", "Наименование", "Цена", "Материал");
                $columns = array("ID", "name", "price", "mat");
                $rows = DatabaseSQL::query($q);


                echo createHTMLTable($heads, $rows, $columns); 
            ?>
        </div>
    </body>
</html>