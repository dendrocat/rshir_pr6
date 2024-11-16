<?php
require_once "../core/util_pr5.php";
?>

<html lang="en">
<head>
    <title>Page Read Users</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
</head>
    <body class="<?php echo getTheme() ?>">
        <div class="nav">
            <a class="<?php echo getTheme() ?>"  href="../nav.html">Назад</a>
        </div>
        <h1>Таблица всех пользователей</h1>
        <?php
            $q = "SELECT users.ID as ID, users.name as name, passwd, user_group.name as group_name FROM users JOIN user_group ON users.groupID = user_group.ID";

            $heads = array("ID", "Логин", "Пароль", "Группа");
            $columns = array("ID", "name", "passwd", "group_name");
            $rows = DatabaseSQL::query($q);

            echo createHTMLTable($heads, $rows, $columns);
        ?>
    </body>
</html>