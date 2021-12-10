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
                        echo $user['first_name'];
                        echo ' ';
                        echo $user['last_name'];
                    ?>
                </div>

                <div class="profile-about__item profile-about__location">
                    <span>Локация: </span>
                    <?php echo $user['location_city'] . ', ' . $user['location_country']; ?>
                </div>
            </div> <!-- /.profile-about -->

            <div class="profile-main">
                <div class="profile-main-header" id="profile-main-header">
                    <div class="profile-main-header__title profile-main-header__title--description active">Описание
                    </div>
                    <div class="profile-main-header__title profile-main-header__title--groups">Группы</div>
                </div>

                <div class="profile-main-content">
                    <p class="profile-main-content__item profile-main-content__item--description active">
                        <?php echo $user['description']; ?>
                    </p>

                    <div class="profile-main-content__item profile-main-content__item--groups">
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
<script src="<?php ROOT ?>/scripts/profile.js"></script>