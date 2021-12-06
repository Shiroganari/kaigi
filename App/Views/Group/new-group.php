<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Создание группы</title>
    <link rel="stylesheet" href="/styles/pages/groups/groups.css">
</head>
<body>
    <!-- HEADER -->
    <?php
        require_once(dirname(__DIR__) . LAYOUTS . 'header.php');
    ?>
    <!-- HEADER END -->

    <!-- NEW-GROUP -->
    <section class="new-entity new-entity--group">
        <h1 class="new-entity__title">Создание новой группы</h1>

        <div class="progress-bar" id="progress-bar">
            <div class="progress-bar__item progress-bar__item--first active">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--second">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--third">
            </div> <!-- /.progress-bar__item-->

            <div class="progress-bar__item progress-bar__item--fourth">
            </div> <!-- /.progress-bar__item-->
        </div> <!-- /.progress-bar -->

        <div class="container">
            <div class="new-entity__inner">
                <form class="new-entity__form" action="group/create-group" method="post">
                    <div class="new-entity__step new-entity__step--first active">
                        <div class="new-entity-header">
                            <h2 class="new-entity-header__title">1. Придумайте название для вашей группы</h2>
                            <p class="new-entity-header__description">Название очень важно для того, чтобы люди легко могли найти вашу
                                группу</p>
                        </div>

                        <div class="new-entity-content">
                            <label for="entity-title"></label>
                            <input class="form__input entity-data" id="entity-title" type="text" name="entity-title" placeholder="Введите название группы">
                        </div>
                    </div> <!-- /.new-entity__step -->

                    <div class="new-entity__step new-entity__step--second">
                        <div class="new-entity-header">
                            <h2 class="new-entity-header__title">2. Укажите категорию и тематику вашей группы</h2>
                            <p class="new-entity-header__description">Категория и тематика очень важны для того, чтобы люди понимали цель
                                Вашей группы</p>
                        </div>

                        <div class="new-entity-content">
                            <label class="new-entity-content__title" for="entity-category">Выберите категорию:</label>
                            <select class="form__select entity-data" name="entity-category" id="entity-category">
                                <option selected>Выберите категорию</option>
                                <?php \Core\View::render('includes/components/categories-list.php', ['categories' => $categories]) ?>
                            </select>

                            <div class="new-entity-content__title" >Выберите по крайней мере один топик:</div>
                            <div class="topics" id="topics"></div>
                        </div>
                    </div> <!-- /.new-entity__step -->

                    <div class="new-entity__step new-entity__step--third">
                        <div class="new-entity-header">
                            <h2 class="new-entity-header__title">3. Придумайте краткое описание вашей группы</h2>
                            <p class="new-entity-header__description">Описание очень важно для того, чтобы люди понимали, какова цель
                                Вашей группы</p>
                        </div>

                        <div class="new-entity-content">
                            <label class="form__label" for="entity-description">Описание:</label>
                            <textarea class="form__textarea entity-data" name="entity-description" id="entity-description"
                                      placeholder="Данная группа будет посвящена следующей тематике ..."></textarea>
                        </div>
                    </div> <!-- /.new-entity__step -->

                    <div class="new-entity__step new-entity__step--fourth last-step">
                        <div class="new-entity-header">
                            <h2 class="new-entity-header__title">4. Укажите локацию вашей группы</h2>
                            <p class="new-entity-header__description">Эта информация очень важна для пользователей, чтобы они понимали,
                                смогу ли они посетить Ваше мероприятие или нет</p>
                        </div>

                        <div class="new-entity-content">
                            <div class="new-entity-content__item">
                                <div class="new-entity-content__location">
                                    <div class="form__item">
                                        <label class="form__label" for="countryId">Выберите страну</label>
                                        <select class="form__select countries order-alpha entity-data" id="countryId" name="entity-country" >
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>

                                    <div class="form__item">
                                        <label class="form__label" for="stateId">Выберите область</label>
                                        <select class="form__select states entity-data" id="stateId" name="entity-state">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="form__item">
                                        <label class="form__label" for="cityId">Выберите город</label>
                                        <select class="form__select cities entity-data" id="cityId" name="entity-city">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="create-entity" type="submit" disabled>Создать группу</button>
                    </div> <!-- /.new-entity__step -->
                </form> <!-- /.new-entity__form -->

                <button class="step-button step-button--previous" id="previous-step">Назад</button>
                <button class="step-button step-button--next" id="next-step" disabled>Далее</button>
            </div> <!-- /.new-entity__inner -->
        </div> <!-- /.container -->
    </section>
    <!-- NEW-GROUP END -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//geodata.solutions/includes/countrystatecity.js"></script>
    <script src="<?php ROOT ?>/scripts/topics.js"></script>
    <script src="<?php ROOT ?>/scripts/createEntity.js"></script>
</body>
</html>