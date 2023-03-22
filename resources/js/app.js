import './bootstrap';

const searchPopup = document.querySelector('.search-popup');
const searchToggle = document.querySelectorAll('.search-toggle');
const innerSearchContainer = document.querySelector('.inner-search-container');

function openSearch(el) {
    el.addEventListener('click', function (event) {
        setTimeout(() => document.body.classList.toggle('overflow-hidden'), 120);
        searchPopup.classList.toggle('search-open');
    });
}


searchToggle.forEach(el => openSearch(el) );

[...searchToggle, innerSearchContainer].forEach((el) => {
    el.addEventListener('click', function (event) {
        if(event.target !== event.currentTarget) return;
        
        searchPopup.classList.toggle('search-open');
        setTimeout(() => document.body.classList.toggle('overflow-hidden'), 120);
    });
});


// mobile search toggle
const navToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.nav-list-mobile');

navToggle.addEventListener('click', (event) => {
    nav.classList.toggle('shown');
});