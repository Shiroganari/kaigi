<?php
    $eventID = $eventData['id'];
    $activeClass = '';

    if ($isMember) {
        $activeClass = 'entity-participation--active';
    }

    $senderID = null;
    $isSender = null;

    if (isset($_SESSION['userID'])) {
        $senderID = $_SESSION['userID'];
    }
?>

<section class="event">
    <div class="container">
        <div class="event__inner">
            <div class="event-header">
                <div class="event-header__avatar">
                    <img class="event-header__img" src="<?php ROOT ?>/images/mongol.jpg" alt="Event Picture">
                </div>

                <div class="event-header__information">
                    <h1 class="event-header__title">
                        <?php echo $eventData['title']; ?>
                    </h1>

                    <div class="event-header__organizer">
                        Организатор:
                        <?php
                            echo($organizerName['first_name'] . ' ' . $organizerName['last_name'] . ' [' .
                                $organizerName['username'] . ']');
                        ?>
                    </div>

                    <div class="event-header__format">
                        Формат:
                        <?php echo $eventFormat['name']; ?>
                    </div>

                    <?php if ($eventData['location_country']): ?>
                        <div class="event-header__location">
                            Локация:
                            <div class="event-header__country">
                                <?php echo $eventData['location_country']; ?>
                            </div>

                            <div class="event-header__city">
                                <?php
                                    if ($eventData['location_city']) {
                                        echo ', ' . $eventData['location_city'];
                                    }
                                ?>
                            </div>

                            <div class="event-header__street">
                                <?php
                                    if ($eventData['location_street']) {
                                        echo ', ' . $eventData['location_street'];
                                    }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="event-header__date">
                        Дата начала:
                        <?php echo date('Y-m-d', strtotime($eventData['date_start'])); ?>
                    </div>

                    <div class="event-header__time">
                        Время начала:
                        <?php echo date('H:i', strtotime($eventData['date_start'])); ?>
                    </div>

                    <div class="event-header__category">
                        Категория:
                        <?php echo $eventCategory['name']; ?>
                    </div>

                    <div class="event-header__members">
                        Количество участников:
                        <?php echo ' ' . $eventMembersCount; ?>
                    </div>

                    <div class="event-header__participation">
                        <label for="user-id">
                            <input id="user-id" type="text" value="<?php echo $userID; ?>" hidden>
                        </label>
                        <label for="entity-id">
                            <input id="entity-id" type="text" value="<?php echo $eventID; ?>" hidden>
                        </label>
                        <label for="is-member">
                            <input id="is-member" type="text" value="<?php echo $isMember; ?>" hidden>
                        </label>
                        <label for="url">
                            <input id="url" name="url" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden>
                        </label>

                        <button class="button entity-participation entity-participation--event <?php echo $activeClass; ?>"
                                id="entity-participation">
                            <?php
                                if ($isMember) {
                                    echo 'Вы участвуете';
                                } else {
                                    echo 'Стать участником';
                                }
                            ?>
                        </button>

                        <?php echo $reportButton; ?>
                    </div>
                </div>
            </div> <!-- /.event-header -->

            <div class="event-content">
                <div class="event-content__header tab-header">
                    <div class="event-content__title tab-link active"
                    onClick="tabMenu(event, 'event-about')">Описание</div>
                    <div class="event-content__title tab-link"
                    onClick="tabMenu(event, 'event-members')">Участники</div>
                    <div class="event-content__title tab-link">Комментарии</div>
                </div>

                <div class="event-content__description tab-content active" id="event-about">
                    <?php echo $eventData['description']; ?>
                </div>

                <div class="event-content__members members-list tab-content" id="event-members">
                    <?php echo $membersList; ?>
                </div>

            </div> <!-- /.event-content -->

            <div class="event-topics">
                <div class="event-topics__title">Топики:</div>

                <div class="event-topics__inner">
                    <?php echo $topicsList; ?>
                </div>
            </div> <!-- /.event-topics -->
        </div> <!-- /.event__inner -->
    </div> <!-- /.container -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php ROOT ?>/scripts/entityParticipation.js"></script>
<script src="<?php ROOT ?>/scripts/tabMenu.js"></script>
<script src="<?php ROOT ?>/scripts/report-popup.js"></script>