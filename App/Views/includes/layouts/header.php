<header class="header">
    <div class="container">
        <div class="header__inner">
            <a class="header__logo logo" href="/">Kaigi</a>

            <nav class="header__nav nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a class="nav__link" href="/events/index">События</a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="/groups/index">Группы</a>
                    </li>
                </ul>
            </nav>

            <div class="header__buttons">
                <?php
                    session_start();

                    if (isset($_SESSION['active'])) {
                        echo '<div class="header-buttons__item">';
                            echo '<a class="header-buttons__button" href="/events/new">Создать событие</a>';
                            echo '<a class="header-buttons__button" href="#">Создать группу</a>';
                        echo '</div>';

                        echo '<div class="header-buttons__item">';
                            echo '<a class="header-buttons__button" href="/profile/index">Профиль</a>';
                            echo '<a class="header-buttons__button" href="/profile/logout">Выйти</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="header-buttons__item">';
                            echo '<a class="header__button" href="/login/index">Войти</a>';
                            echo '<a class="header__button" href="/register/index">Регистрация</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div> <!-- /.header__inner -->
    </div> <!-- /.header -->
</header>