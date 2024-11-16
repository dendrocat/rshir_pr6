<?php require_once "../core/util_pr5.php" ?>

<!DOCTYPE html>
<html lang="ru">
<head>
        <title>Page Upload</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="./css/apache-style.css" type="text/css"/>
</head>
<body class="<?php echo getTheme() ?>">
    <div class="nav">
        <a class="<?php echo getTheme() ?>" href="../nav.html">Назад</a>
    </div>
    <h1>Страница загрузки файлов на сервер</h1>

    <form method="post" enctype="multipart/form-data">
        <label for="file">Выберите файл:</label>
        <input type="file" name="upfile" id="upfile" accept=".pdf">
        <button type="submit" name="upload">Загрузить файл</button>
    </form>

    <?php
        if (isset($_POST['upload'])) {
            $filename = $_FILES['upfile']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if (in_array($ext, ["pdf"])) {
                $file = file_get_contents($_FILES['upfile']['tmp_name']);
                if ($file === false) {
                    die("Ошибка чтения файла");
                }
                $filetype = $_FILES['upfile']['type'];
                $filesize = $_FILES['upfile']['size'];

                $mysql = DatabaseSQL::getConnection();
                $stmt = $mysql->prepare("INSERT INTO pdf_files (name, type, size, data) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssis", $filename, $filetype, $filesize, $file);
                
                if ($stmt->execute())
                    echo "Файл {$filename} успешно загружен";
                else 
                    echo "Ошибка загрузки файла" . $stmt->error;
                $stmt->close();
                $mysql->close();
            }
            else {
                echo "Неправильное расширение файла. Поддерживаются только pdf";
            }
        }
    ?>

</body>
</html>