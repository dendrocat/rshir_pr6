<?php

require_once "../core/util_pr5.php";
require_once "../core/util_graphics.php";
require_once "../core/util_watermark.php";
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
        $graphics = [
            'line' => [
                'path' => 'graphics/line.png',
                'name' => 'Линейный график'],
            'bar' => [
                'path' => 'graphics/bar.png',
                'name' => 'Столбчатая диаграмма'],
            'pie' => [
                'path' => 'graphics/pie.png',
                'name' => 'Круговая диаграмма']
        ];
        $watermark_path = "graphics/water.png";

        generateGraphics($graphics);
        addWatermarks($graphics, $watermark_path);

        $heads = array("Название", "График");
        $columns = ["name", 'img'];

        $rows = [];
        foreach ($graphics as $graph) {
            $rows[] = [
                'name' => $graph['name'], 
                'img' => "<img src='/server/apache/graphics/line.png'>"
            ];
        }
        
        echo 1;
        echo createHTMLTable($heads, $rows, $columns);
    ?>
</body>
</html>
<?php

?>