<?php 
require_once "../core/util_pr5.php";
?>

<html lang="ru">
    <head>
        <title>Page Settings</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
    </head>
    <body class="<?php echo getTheme() ?>">
        <div class="nav">
            <a class="<?php echo getTheme() ?>" href="../nav.html">Назад</a>
        </div>
        <h1>Настройки</h1>
        <div class="last-user-data">
            <p>Последний логин: <?php echo getLogin(); ?> </p>
            <p>Последний пароль: <?php echo getPasswd() ?> </p>
        </div>
        <div class="cont">
            <form method="post">
                <label for="theme">Темная тема</label>
                <input type="checkbox" name="theme" id="theme" <?php 
                    if (getTheme() == 'dark')
                        echo "checked";                
                ?> >
                <button type="submit" name="applyBtn">Применить</button>
            </form>
        </div>  
        
        <?php
            if (isset($_POST['applyBtn'])) {
                if (isset($_POST['theme']))
                    setTheme("dark");
                else setTheme("light");
                echo "<meta http-equiv='refresh' content='0'>";
            }
        ?>

    </body>
</html>