<section class="profile">
    <div class="container">
        <div class="profile__inner">
            <div class="profile-about">
                <div class="profile-about__item profile-about__photo" style="width: 100px; height: 100px;">
                    <img class="profile-about__img" src="<?php ROOT ?>/images/mongol.jpg" alt="Photo">
                </div>

                <div class="profile-about__item profile-about__username">
                    <?php echo $user['username']; ?>
                </div>

                <div class="profile-about__item profile-about__name">
                    <?php
                        echo $user['firstName'];
                        echo ' ';
                        echo $user['lastName'];
                    ?>
                </div>

                <div class="profile-about__item profile-about__location">
                    <span>Локация: </span>
                    <?php echo $user['city'] . ', ' . $user['country']; ?>
                </div>
            </div> <!-- /.profile-about -->

            <div class="profile-main">
                <div class="profile-main-header tab-header" id="profile-main-header">
                    <div class="profile-main-header__title tab-link active"
                         onclick="tabMenu(event, 'profile-about')">Описание</div>
                    <div class="profile-main-header__title tab-link"
                         onclick="tabMenu(event, 'profile-groups')">Группы
                    </div>
                </div>

                <div class="profile-main-content">
                    <div class="profile-main-content__item profile-main-content__item--about
                    tab-content active" id="profile-about">
                        <?php echo $user['description']; ?>
                    </div>

                    <div class="profile-main-content__item profile-main-content__item--groups
                    tab-content" id="profile-groups">
                        <?php echo $groupsList; ?>
                    </div>
                </div>
            </div> <!-- /.profile-main -->
        </div> <!-- /.profile__inner -->

        <div class="profile-topics">
            <h2 class="profile-topics__subtitle">Увлекается: </h2>

            <div class="profile-topics__inner">
                <?php echo $topicsList; ?>
            </div>
        </div> <!-- /.profile-topics -->
    </div> <!-- /.container -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php ROOT ?>/scripts/tabMenu.js"></script>