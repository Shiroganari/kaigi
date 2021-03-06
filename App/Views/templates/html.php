<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/styles/pages/<?php echo $cssFileName . '/' . $cssFileName . '.css'?>">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <?php
        foreach ($styles as $style) {
            echo "<link rel='stylesheet' href='$style'>";
        }
    ?>
</head>
<body>
    <?php
        use Core\View;

        View::render('layout:header');
        echo $content;
    ?>
</body>
</html>