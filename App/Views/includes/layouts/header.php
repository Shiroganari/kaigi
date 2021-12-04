<header class="header">
    <div class="container">
        <div class="header__inner">
            <a class="header__logo logo" href="/">Kaigi</a>

            <nav class="header__nav nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a class="nav__link" href="/events">События</a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="/groups">Группы</a>
                    </li>
                </ul>
            </nav>

            <div class="header-buttons">
                <?php
                    if (isset($_SESSION['active'])) {
                        echo '<div class="header-buttons__item">';
                            echo '<a class="header-buttons__button" href="/new-event">Создать событие</a>';
                            echo '<a class="header-buttons__button" href="#">Создать группу</a>';
                        echo '</div>';

                        echo '<div class="header-buttons__item">';
                            echo '<a class="header-buttons__button" href="/profile">Профиль</a>';
                            echo '<a class="header-buttons__button" href="/profile/logout">Выйти</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="header-buttons__item">';
                            echo '<a class="header-buttons__button" href="/login">Войти</a>';
                            echo '<a class="header-buttons__button" href="/registration">Регистрация</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div> <!-- /.header__inner -->
    </div> <!-- /.header -->
</header>