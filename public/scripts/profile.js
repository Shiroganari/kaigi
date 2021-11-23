const profileMainTitles = document.getElementsByClassName('profile-main__title');
const profileMainHeader = document.getElementById('profile-main__header');


profileMainHeader.addEventListener('click', function(e) {
    const target = e.target;
    Array.from(profileMainTitles).forEach(item => {
        item.classList.remove('active');
    })
    target.classList.add('active');
})