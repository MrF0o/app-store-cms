import './bootstrap';

const searchPopup = document.querySelector('.search-popup');
const searchToggle = document.querySelector('.search-toggle');
const innerSearchContainer = document.querySelector('.inner-search-container');

searchToggle.addEventListener('click', function (event) {
    setTimeout(() => document.body.classList.toggle('overflow-hidden'), 120);
    searchPopup.classList.toggle('search-open');
});

[searchToggle, innerSearchContainer].forEach((el) => {
    el.addEventListener('click', function (event) {
        if(event.target !== event.currentTarget) return;
        
        searchPopup.classList.toggle('search-open');
        setTimeout(() => document.body.classList.toggle('overflow-hidden'), 120);

        onSearchClose(event);
    });
});

function onSearchClose(event) {

}

