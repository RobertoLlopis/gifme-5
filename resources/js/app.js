require('./bootstrap');

require('alpinejs');

$('.home').on('submit', handleHomeSubmit);

/* function handleHomeSubmit(e) {
    if (e.target.classList.includes('article-add-comment')) {
        fetch()
    }
} */

function $(selector) {
    return document.querySelector(selector);
}
function on(eventKind, callback) {
    return addEventListener(eventKind, callback);
}