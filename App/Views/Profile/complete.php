<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Завершение регистрации</title>
    <link rel="stylesheet" href="/styles/pages/profile/profile.css"">
</head>
<body>
    <!-- HEADER -->
    <?php require_once(dirname(__DIR__) . '/layouts/header_authorized.php'); ?>
    <!-- HEADER END -->

    <!-- REGISTER -->
    <section class="register complete">
        <h1 class="register__title">Завершение регистрации</h1>

        <form class="form" method="post" action="http://kaigi.loc/register/completeRegister">
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
                <textarea class="form__textarea" name="description" id="description" cols="30" rows="10"></textarea>
            </div> <!-- /.form__item -->

            <div class="form__item">
                <label for="countryId" class="form__label">Выберите страну</label>
                <select class="form__select countries order-alpha" id="countryId" name="country" >
                    <option value="">Select Country</option>
                </select>
            </div> <!-- /.form__item -->

            <div class="form__item">
                <label for="stateId" class="form__label">Выберите область</label>
                <select class="form__select states" id="stateId" name="state" >
                    <option value="">Select State</option>
                </select>
            </div> <!-- /.form__item -->

            <div class="form__item">
                <label for="cityId" class="form__label">Выберите город</label>
                <select class="form__select cities" id="cityId" name="city">
                    <option value="">Select City</option>
                </select>
            </div> <!-- /.form__item -->

            <div class="form__item">
                <h2 class="form__title">Выберите темы, которые вас интересуют:</h2>

                <div class="topics" id="topics">
                    <?php
                        $topics = App\Models\Topic::getAll();

                        foreach($topics as $topic) {
                            $topic_name = $topic['name'];
                            echo "<div class='topics__item'>";
                                echo "<input class='topics__choice' name='topics[]' type='checkbox' value='$topic_name'>";
                                echo "<span class='topics__text'>$topic_name</span>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div> <!-- /.form__item -->

            <input class="form__button button" type="submit" value="Завершить регистрацию">
        </form> <!-- /.form -->
    </section>
    <!-- REGISTER END -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//geodata.solutions/includes/countrystatecity.js"></script>
</body>
</html>