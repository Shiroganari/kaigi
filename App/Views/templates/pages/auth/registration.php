<section class="registration">
    <h1 class="registration__title">Создание аккаунта</h1>

    <form class="form" method="post" action="auth/registration">
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