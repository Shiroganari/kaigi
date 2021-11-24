<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Создание аккаунта</title>
    <link rel="stylesheet" href="/styles/pages/account/account.css">
</head>
<body>
    <!-- HEADER -->
    <?php require_once(dirname(__DIR__) . '/layouts/header.php'); ?>
    <!-- HEADER END -->

    <!-- REGISTER -->
    <section class="register">
        <h1 class="register__title">Создание аккаунта</h1>

        <form class="form" method="post" action="http://kaigi.loc/register/signup">
            <div class="form__item">
                <label class="form__label" for="name">Введите ваш никнейм:</label>
                <input class="form__input" id="name" name="username" type="text" placeholder="Никнейм">
            </div>

            <div class="form__item">
                <label class="form__label" for="email">Введите ваш Email:</label>
                <input class="form__input" id="email" name="email" type="email" placeholder="Email">
            </div>

            <div class="form__item">
                <label class="form__label" for="pass">Придумайте пароль:</label>
                <input class="form__input" id="pass" name="pass" type="password" placeholder="Пароль">
            </div>

            <input class="form__button button" type="submit" value="Создать аккаунт">
        </form>
    </section>
    <!-- REGISTER END -->
</body>
</html>