<section class="events">
    <div class="container">
        <div class="events__inner">
            <div class="events-header">
                <h1 class="events-header__title">Поиск событий</h1>

                <label class="form__label" for="event-title">
                    <input class="form__input event-filter event-filter--title" id="event-title" type="text"
                           placeholder="Введите название события">
                </label>

                <div class="events-header__top">
                    <label for="event-format">
                        <select class="form__select event-filter event-filter--format" id="event-format"
                                name="event-format">
                            <option selected>Выберите формат события</option>
                            <option value="Офлайн">Офлайн</option>
                            <option value="Онлайн">Онлайн</option>
                        </select>
                    </label>

                    <label for="event-category">
                        <select class="form__select event-filter event-filter--category" name="event-category"
                                id="event-category">
                            <option selected>Выберите категорию</option>
                            <?php echo $categoriesList; ?>
                        </select>
                    </label>
                </div> <!-- /.events-header__top -->

                <div class="events-header__location">
                    <label class="form__label" for="countryId">
                        <select class="form__select countries order-alpha event-filter event-filter--country"
                                id="countryId" name="event-country">
                            <option value="">Select Country</option>
                        </select>
                    </label>

                    <label class="form__label" for="stateId">
                        <select class="form__select states event-filter event-filter--state" id="stateId"
                                name="event-state">
                            <option value="">Select State</option>
                        </select>
                    </label>

                    <label class="form__label" for="cityId">
                        <select class="form__select cities event-filter event-filter--city" id="cityId"
                                name="event-city">
                            <option value="">Select City</option>
                        </select>
                    </label>
                </div> <!-- /.events-header__location -->
            </div> <!-- /.events-header -->

            <div class="events-content" id="events-content"></div>
        </div> <!-- /.events__inner -->
    </div> <!-- /.container -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<script src="<?php ROOT ?>/scripts/events.js"></script>