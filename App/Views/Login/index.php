<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Войти в аккаунт</title>
    <link rel="stylesheet" href="/styles/pages/account/account.css">
</head>
<body>
    <!-- HEADER -->
    <?php require_once(dirname(__DIR__) . '/layouts/header.php'); ?>
    <!-- HEADER END -->

    <!-- LOGIN -->
    <section class="login">
        <h1 class="login__title">Вход в аккаунт</h1>

        <form class="form" method="post" action="http://kaigi.loc/login/signin">
            <div class="form__item">
                <label class="form__label" for="email">Введите ваш Email:</label>
                <input class="form__input" id="email" name="email" type="email">
            </div>

            <div class="form__item">
                <label class="form__label" for="pass">Введите пароль:</label>
                <input class="form__input" id="pass" name="pass" type="password">
            </div>

            <input class="form__button button" type="submit" value="Войти в аккаунт">
        </form>
    </section>
    <!-- LOGIN END -->
</body>
</html>