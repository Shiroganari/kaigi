function tabMenu (e, tabTitle) {
    const tabs = document.getElementsByClassName('tab-link');
    const tabContent = document.getElementsByClassName('tab-content');

    for (let i = 0; i < tabContent.length; i++) {
        tabContent[i].classList.remove('active');
    }

    for (let i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove('active');
    }

    document.getElementById(tabTitle).classList.add('active');
    e.currentTarget.classList.add('active');
}