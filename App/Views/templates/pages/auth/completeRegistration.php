<section class="registration complete">
    <h1 class="registration__title">Завершение регистрации</h1>

    <form class="form" method="post" action="auth/completeRegistration">
        <div class="form__item">
            <label class="form__label" for="firstName">Введите ваше имя:</label>
            <input class="form__input" id="firstName" name="first_name" type="text" placeholder="Имя" required>
        </div> <!-- /.form__item -->

        <div class="form__item">
            <label class="form__label" for="lastName">Введите вашу фамилию:</label>
            <input class="form__input" id="lastName" name="last_name" type="text" placeholder="Фамилия" required>
        </div> <!-- /.form__item -->

        <div class="form__item">
            <label class="form__label" for="description">Расскажите что-нибудь о себе: </label>
            <textarea class="form__textarea" name="description" id="description" cols="30" rows="10" required></textarea>
        </div> <!-- /.form__item -->

        <div class="form__item">
            <label for="countryId" class="form__label">Выберите страну</label>
            <select class="form__select countries order-alpha" id="countryId" name="country" required>
                <option value="">Select Country</option>
            </select>
        </div> <!-- /.form__item -->

        <div class="form__item">
            <label for="stateId" class="form__label">Выберите область</label>
            <select class="form__select states" id="stateId" name="state" required>
                <option value="">Select State</option>
            </select>
        </div> <!-- /.form__item -->

        <div class="form__item">
            <label for="cityId" class="form__label">Выберите город</label>
            <select class="form__select cities" id="cityId" name="city" required>
                <option value="">Select City</option>
            </select>
        </div> <!-- /.form__item -->

        <div class="form__item">
            <h2 class="form__title">Выберите темы, которые вас интересуют:</h2>

            <div class="topics" id="topics">
                <?php echo $topicsList; ?>
            </div>
        </div> <!-- /.form__item -->

        <input class="form__button button" type="submit" value="Завершить регистрацию">
    </form> <!-- /.form -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>