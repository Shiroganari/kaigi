<section class="login">
    <h1 class="login__title">Вход в аккаунт</h1>

    <form class="form" method="post" action="auth/login">
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