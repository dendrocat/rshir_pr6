<?php 
require_once "../core/util_pr5.php";
?>

<html lang="ru">
    <head>
        <title>Page Create</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
    </head>
    <body class="<?php echo getTheme() ?>">
        <div class="nav">
            <a class="<?php echo getTheme() ?>" href="../nav.html">Назад</a>
        </div>
        <h1>Страница создания товара</h1>
        <div class="cont">
            <form method="post">
                <label for="name">Введите наименование товара:</label>
                <input type="text" name="name" id="name">
                <label for="price">Введите цену товара:</label>
                <input type="number" name="price" id="price">
                <label for="mat">Введите идентификатор материала:</label>
                <input type="number" name="mat" id="mat">
                <button type="submit" name="addBtn">Добавить запись</button>
            </form>
        </div>  
        
        <?php
            if (isset($_POST['addBtn'])) {
                if (!isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['mat'])) {
                    echo "Все поля должны быть заполнены";
                    die();
                }

                $name = $_POST['name'];
                $price = $_POST['price'];
                $mat = $_POST['mat'];
                $sql = "INSERT INTO products (name, price, matID) VALUES ('{$name}', {$price}, {$mat})";
                
                if (DatabaseSQL::query($sql)) {
                    echo "Товар {$name} - {$price} ₽ был успешно добавлен";
                }
                else echo "Добавление записи провалено";
            }
        ?>

    </body>
</html>