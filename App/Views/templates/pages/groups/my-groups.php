<section class="my-groups">
    <div class="container">
        <div class="my-groups__inner">
            <div class="my-groups__filters">
                <h2 class="my-groups__title">Фильтры</h2>
                <label class="form__label" for="groups-title">
                    <input class="form__input groups-filter groups-filter--title" id="groups-title" type="text"
                           placeholder="Введите название события">
                </label>

                <label for="groups-filter--my-groups">
                    <input class="groups-filter--my-groups" id="groups-filter--my-groups" type="text" hidden>
                </label>

                <div class="form-item">
                    <label class="form__label" for="groups-filter--organizer">Группы, которые я создал</label>
                    <input class="groups-filter groups-filter--organizer" id="groups-filter--organizer" name="groups-filter--organizer" type="checkbox">
                </div>

            </div>
            <div class="my-groups__content">
                <h1 class="my-groups__title">Мои группы</h1>
                <div class="groups-content" id="groups-content"></div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php ROOT ?>/scripts/groups.js"></script>