<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Создать событие</title>
    <link rel="stylesheet" href="/styles/pages/events/events.css"">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
</head>
<body>
    <!-- HEADER -->
    <?php
        require_once(dirname(__DIR__) . LAYOUTS . 'header.php');
    ?>
    <!-- HEADER END -->

    <!-- NEW-EVENT -->
    <section class="new-event">
        <h1 class="new-event__title">Создание новой встречи</h1>

        <div class="progress-bar" id="progress-bar">
            <div class="progress-bar__item progress-bar__item--first active">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--second">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--third">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--fourth">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--fifth">
            </div> <!-- /.progress-bar__item-->
        </div> <!-- /.progress-bar -->

        <div class="container">
            <div class="new-event__inner">
                <form class="new-event__form" action="event/createEvent" method="post">
                    <div class="new-event__step new-event__step--first active">
                        <div class="new-event-header">
                            <h2 class="new-event-header__title">1. Придумайте название для вашей встречи</h2>
                            <p class="new-event-header__description">Название очень важно для того, чтобы люди легко могли найти ваше
                                мероприятие</p>
                        </div>

                        <div class="new-event-content">
                            <label for="event-title"></label>
                            <input class="form__input" id="event-title" type="text" name="event-title" placeholder="Введите название встречи">
                        </div>
                    </div> <!-- /.new-event__step -->

                    <div class="new-event__step new-event__step--second">
                        <div class="new-event-header">
                            <h2 class="new-event-header__title">2. Укажите категорию и тематику вашей встречи</h2>
                            <p class="new-event-header__description">Категория и тематика очень важны для того, чтобы люди понимали цель
                                вашего мероприятия</p>
                        </div>

                        <div class="new-event-content">
                            <label class="new-event-content__title" for="event-category">Выберите категорию:</label>
                            <select class="form__select topics-to-div" name="event-category" id="event-category">
                                <option selected>Выберите категорию</option>
                                <?php \Core\View::render('includes/components/categories-list.php', ['categories' => $categories]) ?>
                            </select>

                            <div class="new-event-content__title" >Выберите по крайней мере один топик:</div>
                            <div class="topics" id="topics"></div>
                        </div>
                    </div> <!-- /.new-event__step -->

                    <div class="new-event__step new-event__step--third">
                        <div class="new-event-header">
                            <h2 class="new-event-header__title">3. Придумайте краткое описание вашей встречи</h2>
                            <p class="new-event-header__description">Описание очень важно для того, чтобы люди понимали, какова цель
                            Вашего мероприятие</p>
                        </div>
                        
                        <div class="new-event-content">
                            <label class="form__label" for="event-description">Описание:</label>
                            <textarea class="form__textarea" name="event-description" id="event-description"
                                      placeholder="Данная встреча будет посвящена следующей тематике ..."></textarea>
                        </div>
                    </div> <!-- /.new-event__step -->

                    <div class="new-event__step new-event__step--fourth">
                        <div class="new-event-header">
                            <h2 class="new-event-header__title">4. Укажите дату и время вашей встречи</h2>
                            <p class="new-event-header__description">Эта информация очень важна для пользователей, чтобы они понимали,
                            смогу ли они посетить Ваше мероприятие или нет</p>
                        </div>

                        <div class="new-event-content">
                            <div class="new-event-content__item">
                                <label class="form__label"  for="event-date">Выберите дату вашей встречи:</label>
                                <input class="form__input" name="event-date" type="text" id="event-date">
                            </div>

                            <div class="new-event-content__item">
                                <label class="form__label"  for="event-time">Укажите время вашей встречи</label>
                                <input class="form__input" name="event-time" type="text" id="event-time">
                            </div>
                        </div>
                    </div> <!-- /.new-event__step -->

                    <div class="new-event__step new-event__step--fifth">
                        <div class="new-event-header">
                            <h2 class="new-event-header__title">5. Укажите формат и локацию вашей встречи</h2>
                            <p class="new-event-header__description">Эта информация очень важна для пользователей, чтобы они понимали,
                                смогу ли они посетить Ваше мероприятие или нет</p>
                        </div>

                        <div class="new-event-content">
                            <div class="new-event-content__formats">
                                <label class="label-choice">
                                    <input class='label-choice__checkbox event-format' name='event-format' type='radio' value='Онлайн'>
                                    <span class='label-choice__title'>Онлайн</span>
                                </label>

                                <label class="label-choice">
                                    <input class='label-choice__checkbox event-format' name='event-format' type='radio' value='Офлайн'>
                                    <span class='label-choice__title'>Офлайн</span>
                                </label>
                            </div>

                            <div class="new-event-content__item">
                                <div class="new-event-content__location">
                                    <div class="form__item">
                                        <label class="form__label" for="countryId">Выберите страну</label>
                                        <select class="form__select countries order-alpha" id="countryId" name="event-country" >
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>

                                    <div class="form__item">
                                        <label class="form__label" for="stateId">Выберите область</label>
                                        <select class="form__select states" id="stateId" name="event-state">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="form__item">
                                        <label class="form__label" for="cityId">Выберите город</label>
                                        <select class="form__select cities" id="cityId" name="event-city">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                    <div class="form__item">
                                        <label class="form__label" for="streetId">Укажите улицу</label>
                                        <input class="form__input" type="text" name="event-street" id="streetId" placeholder="Демакова д. 27">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="step-button step-button--create" type="submit">Создать событие</button>
                    </div> <!-- /.new-event__step -->
                </form> <!-- /.new-event__form -->

                <button class="step-button step-button--previous" id="previous-step">Назад</button>
                <button class="step-button step-button--next" id="next-step">Далее</button>
            </div> <!-- /.new-event__inner -->
        </div> <!-- /.container -->
    </section>
    <!-- NEW-EVENT END -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="//geodata.solutions/includes/countrystatecity.js"></script>
    <script src="<?php ROOT ?>/scripts/createEvent.js"></script>
    <script src="<?php ROOT ?>/scripts/topics.js"></script>
</body>
</html>