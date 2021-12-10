$(document).ready(function () {
    const profileMainTitles = document.getElementsByClassName('profile-main-header__title');
    const profileMainHeader = document.getElementById('profile-main-header');

    profileMainHeader.addEventListener('click', function (e) {
        const target = e.target;
        Array.from(profileMainTitles).forEach(item => {
            item.classList.remove('active');
        })
        target.classList.add('active');

        if ($(target).hasClass('profile-main-header__title--description')) {
            $('.profile-main-content__item').removeClass('active');
            $('.profile-main-content__item--description').addClass('active');
        } else if ($(target).hasClass('profile-main-header__title--groups')) {
            $('.profile-main-content__item').removeClass('active');
            $('.profile-main-content__item--groups').addClass('active');
        }
    })
})