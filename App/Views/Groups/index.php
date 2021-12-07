<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Все группы</title>
    <link rel="stylesheet" href="/styles/pages/groups/groups.css"">
</head>
<body>
    <!-- HEADER -->
    <?php
        session_start();
        require_once(dirname(__DIR__) . LAYOUTS . 'header.php');
    ?>
    <!-- HEADER END -->

    <!-- GROUPS -->
    <section class="groups">
        <div class="container">
            <div class="groups__inner">
                <div class="groups-header">
                    <h1 class="groups-header__title">Поиск групп</h1>

                    <label class="form__label" for="groups-title">
                        <input class="form__input groups-filter groups-filter--title" id="groups-title" type="text" placeholder="Введите название группы">
                    </label>

                    <div class="groups-header__top">
                        <label for="groups-category">
                            <select class="form__select groups-filter groups-filter--category" name="groups-category" id="groups-category">
                                <option selected>Выберите категорию</option>
                                <?php \Core\View::render('includes/components/categories-list.php', ['categories' => $categories]) ?>
                            </select>
                        </label>
                    </div> <!-- /.groups-header__top -->

                    <div class="groups-header__location">
                        <label class="form__label" for="countryId">
                            <select class="form__select countries order-alpha groups-filter groups-filter--country" id="countryId" name="groups-country">
                                <option value="">Select Country</option>
                            </select>
                        </label>

                        <label class="form__label" for="stateId">
                            <select class="form__select states groups-filter groups-filter--state" id="stateId" name="groups-state">
                                <option value="">Select State</option>
                            </select>
                        </label>

                        <label class="form__label" for="cityId">
                            <select class="form__select cities groups-filter groups-filter--city" id="cityId" name="groups-city">
                                <option value="">Select City</option>
                            </select>
                        </label>
                    </div> <!-- /.groups-header__location -->
                </div> <!-- /.groups-header -->

                <div class="groups-content" id="groups-content"></div>
            </div> <!-- /.groups__inner -->
        </div> <!-- /.container -->
    </section>
    <!-- GROUPS END -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//geodata.solutions/includes/countrystatecity.js"></script>
    <script src="<?php ROOT ?>/scripts/groups.js"></script>
</body>
</html>