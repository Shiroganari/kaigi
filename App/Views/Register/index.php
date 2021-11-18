<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Signup</title>
    <link rel="stylesheet" href="<?php ROOT ?>/styles/main.css">
</head>
<body>
    <?php require_once(dirname(__DIR__) . '/layouts/header.php'); ?>

    <section class="signup">
        <h1 class="signup__title">Создание аккаунта</h1>

        <form class="form" action="">
            <div class="form__item">
                <label class="form__label" for="name">Введите ваше имя:</label>
                <input class="form__input" id="name" type="text">
            </div>

            <div class="form__item">
                <label class="form__label" for="email">Введите ваш Email:</label>
                <input class="form__input" id="email" type="email">
            </div>

            <div class="form__item">
                <label class="form__label" for="pass">Придумайте пароль:</label>
                <input class="form__input" id="pass" type="password">
            </div>

            <button class="form__button button">Создать аккаунт</button>
        </form>
    </section>
</body>
</html>