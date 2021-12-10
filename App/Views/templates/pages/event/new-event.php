<section class="new-entity">
    <h1 class="new-entity__title">Создание новой встречи</h1>

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
        <div class="new-entity__inner">
            <form class="new-entity__form" action="event/create-event" method="post">
                <div class="new-entity__step new-entity__step--first active">
                    <div class="new-entity-header">
                        <h2 class="new-entity-header__title">1. Придумайте название для вашей встречи</h2>
                        <p class="new-entity-header__description">Название очень важно для того, чтобы люди легко могли найти ваше
                            мероприятие</p>
                    </div>

                    <div class="new-entity-content">
                        <label for="entity-title"></label>
                        <input class="form__input entity-data" id="entity-title" type="text" name="entity-title" placeholder="Введите название встречи">
                    </div>
                </div> <!-- /.new-entity__step -->

                <div class="new-entity__step new-entity__step--second">
                    <div class="new-entity-header">
                        <h2 class="new-entity-header__title">2. Укажите категорию и тематику вашей встречи</h2>
                        <p class="new-entity-header__description">Категория и тематика очень важны для того, чтобы люди понимали цель
                            вашего мероприятия</p>
                    </div>

                    <div class="new-entity-content">
                        <label class="new-entity-content__title" for="entity-category">Выберите категорию:</label>
                        <select class="form__select entity-data" name="entity-category" id="entity-category">
                            <option selected>Выберите категорию</option>
                            <?php echo $categoriesList; ?>
                        </select>

                        <div class="new-entity-content__title" >Выберите по крайней мере один топик:</div>
                        <div class="topics" id="topics"></div>
                    </div>
                </div> <!-- /.new-entity__step -->

                <div class="new-entity__step new-entity__step--third">
                    <div class="new-entity-header">
                        <h2 class="new-entity-header__title">3. Придумайте краткое описание вашей встречи</h2>
                        <p class="new-entity-header__description">Описание очень важно для того, чтобы люди понимали, какова цель
                            Вашего мероприятие</p>
                    </div>

                    <div class="new-entity-content">
                        <label class="form__label" for="entity-description">Описание:</label>
                        <textarea class="form__textarea entity-data" name="entity-description" id="entity-description"
                                  placeholder="Данная встреча будет посвящена следующей тематике ..."></textarea>
                    </div>
                </div> <!-- /.new-entity__step -->

                <div class="new-entity__step new-entity__step--fourth">
                    <div class="new-entity-header">
                        <h2 class="new-entity-header__title">4. Укажите дату и время вашей встречи</h2>
                        <p class="new-entity-header__description">Эта информация очень важна для пользователей, чтобы они понимали,
                            смогу ли они посетить Ваше мероприятие или нет</p>
                    </div>

                    <div class="new-entity-content">
                        <div class="new-entity-content__item">
                            <label class="form__label"  for="entity-date">Выберите дату вашей встречи:</label>
                            <input class="form__input entity-data" name="entity-date" type="text" id="entity-date">
                        </div>

                        <div class="new-entity-content__item">
                            <label class="form__label"  for="entity-time">Укажите время вашей встречи</label>
                            <input class="form__input entity-data" name="entity-time" type="text" id="entity-time">
                        </div>
                    </div>
                </div> <!-- /.new-entity__step -->

                <div class="new-entity__step new-entity__step--fifth last-step">
                    <div class="new-entity-header">
                        <h2 class="new-entity-header__title">5. Укажите формат и локацию вашей встречи</h2>
                        <p class="new-entity-header__description">Эта информация очень важна для пользователей, чтобы они понимали,
                            смогу ли они посетить Ваше мероприятие или нет</p>
                    </div>

                    <div class="new-entity-content">
                        <div class="new-entity-content__formats">
                            <label class="label-choice">
                                <input class='label-choice__checkbox entity-format entity-data' name='entity-format' type='radio' value='Онлайн'>
                                <span class='label-choice__title'>Онлайн</span>
                            </label>

                            <label class="label-choice">
                                <input class='label-choice__checkbox entity-format' name='entity-format' type='radio' value='Офлайн'>
                                <span class='label-choice__title'>Офлайн</span>
                            </label>
                        </div>

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
                                    <select class="form__select states" id="stateId" name="entity-state">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div class="form__item">
                                    <label class="form__label" for="cityId">Выберите город</label>
                                    <select class="form__select cities" id="cityId" name="entity-city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                <div class="form__item">
                                    <label class="form__label" for="streetId">Укажите улицу</label>
                                    <input class="form__input" type="text" name="entity-street" id="streetId" placeholder="Демакова д. 27">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="create-entity" type="submit" disabled>Создать событие</button>
                </div> <!-- /.new-entity__step -->
            </form> <!-- /.new-entity__form -->

            <button class="step-button step-button--previous" id="previous-step">Назад</button>
            <button class="step-button step-button--next" id="next-step" disabled>Далее</button>
        </div> <!-- /.new-entity__inner -->
    </div> <!-- /.container -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<script src="<?php ROOT ?>/scripts/createEntity.js"></script>
<script src="<?php ROOT ?>/scripts/setTime.js"></script>
<script src="<?php ROOT ?>/scripts/topics.js"></script>