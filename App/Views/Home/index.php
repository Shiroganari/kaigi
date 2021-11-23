<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Главная страница</title>
    <link rel="stylesheet" href="/styles/main.css">
</head>
<body>
    <!-- HEADER -->
    <?php
        session_start();

        if (isset($_SESSION['active'])) {
            require_once(dirname(__DIR__) . '/layouts/header_authorized.php');
        } else {
            require_once(dirname(__DIR__) . '/layouts/header.php');
        }
    ?>
    <!-- HEADER END -->

    <!-- INTRO -->
    <?php require_once(dirname(__DIR__) . '/layouts/intro.php'); ?>
    <!-- INTRO END -->
</body>
</html>