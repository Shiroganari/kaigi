const profileMainTitles = document.getElementsByClassName('profile.sass-main__title');
const profileMainHeader = document.getElementById('profile.sass-main__header');


profileMainHeader.addEventListener('click', function(e) {
    const target = e.target;
    Array.from(profileMainTitles).forEach(item => {
        item.classList.remove('active');
    })
    target.classList.add('active');
})