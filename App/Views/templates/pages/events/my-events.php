<section class="my-events">
    <div class="container">
        <div class="my-events__inner">
            <div class="my-events__filters">
                <h2 class="my-events__title">Фильтры</h2>
                <label class="form__label" for="event-title">
                    <input class="form__input event-filter event-filter--title" id="event-title" type="text"
                           placeholder="Введите название события">
                </label>

                <label for="event-filter--my-events">
                    <input class="event-filter--my-events" id="event-filter--my-events" type="text" hidden>
                </label>

                <div class="form-item">
                    <label class="form__label" for="event-filter--organizer">События, которые я организовал</label>
                    <input class="event-filter event-filter--organizer" id="event-filter--organizer" name="event-filter--organizer" type="checkbox">
                </div>

            </div>
            <div class="my-events__content">
                <h1 class="my-events__title">Мои события</h1>
                <div class="events-content" id="events-content"></div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php ROOT ?>/scripts/events.js"></script>