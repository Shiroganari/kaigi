<?php
    $groupID = $groupData['id'];
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

<section class="group">
    <div class="group-header" style="background-image: url('/images/background.jpg');">
        <div class="group-header__logo">
            <img class="group-header__img" src="/images/mongol.jpg" alt="Logotype">
        </div>

        <label for="user-id">
            <input id="user-id" type="text" value="<?php echo $userID; ?>" hidden>
        </label>
        <label for="entity-id">
            <input id="entity-id" type="text" value="<?php echo $groupID; ?>" hidden>
        </label>
        <label for="is-member">
            <input id="is-member" type="text" value="<?php echo $isMember; ?>" hidden>
        </label>
        <label for="url">
            <input id="url" name="url" type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden>
        </label>

        <button class="button entity-participation entity-participation--group <?php echo $activeClass; ?>" id="entity-participation">
            <?php
                if ($isMember) {
                    echo 'Вы участник';
                } else {
                    echo 'Вступить в группу';
                }
            ?>
        </button>

        <?php echo $reportButton; ?>
    </div> <!-- /.group-header -->

    <div class="container">
        <h1 class="group__title">
            <?php echo $groupData['title']; ?>
        </h1>

        <div class="group__content">
            <div class="group-block group-information">
                <div class="group-block-header tab-header">
                    <h2 class="group-block-header__title tab-link active"
                        onclick="tabMenu(event, 'group-about')">О группе</h2>
                    <h2 class="group-block-header__title tab-link"
                        onclick="tabMenu(event, 'group-members')">Участники</h2>
                    <h2 class="group-block-header__title tab-link">Организаторы</h2>
                </div> <!-- /.group-block-header -->

                <div class="group-block-content">
                    <div class="group-block-content__about tab-content active" id="group-about">
                        <div class="group-block-content__item">
                            <h3 class="group-block-content__title">Описание:</h3>
                            <p class="group-block-content__description">
                                <?php echo $groupData['description']; ?>
                            </p>
                        </div>

                        <div class="group-block-content__item">
                            <h3 class="group-block-content__title">Локация:</h3>
                            <span class="group-block-content__location">
                                <?php echo $groupData['country']; ?>
                            </span>
                        </div>

                        <div class="group-block-content__item">
                            <h3 class="group-block-content__title">Категории:</h3>
                            <div class="group-block-content__categories">
                                <?php echo $category; ?>
                            </div>
                        </div>

                        <div class="group-block-content__item">
                            <h3 class="group-block-content__title">Количество участников:</h3>
                            <div class="group-block-content__members-count">
                                <?php echo ' ' . $groupData['membersCount']; ?>
                            </div>
                        </div>

                        <div class="group-block-content__item">
                            <h3 class="group-block-content__title">Топики:</h3>
                            <div class="group-block-content__topics event-topics__inner">
                                <?php echo $topicsList; ?>
                            </div>
                        </div>
                    </div> <!-- /.group-block-content__about -->

                    <div class="group-block-content__members members-list tab-content" id="group-members">
                        <?php echo $membersList; ?>
                    </div> <!-- /.group-block-content__members -->
                </div><!-- /.group-block-content -->
            </div> <!-- /.group-block -->
        </div> <!-- /.group__content -->
    </div> <!-- /.container -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php ROOT ?>/scripts/entityParticipation.js"></script>
<script src="<?php ROOT ?>/scripts/tabMenu.js"></script>
<script src="<?php ROOT ?>/scripts/report-popup.js"></script>