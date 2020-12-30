
require('./bootstrap');
require('alpinejs');

import { $ } from './utils.js';
import { handleHomeSubmit, handleModalDisplay, handleModalClick } from './listeners';
import { dropHandler, dragEventHandler } from './dragAndDrop';

const modal = $('#modal-background-layer');

['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave'].forEach(evt =>
    $('body').addEventListener(evt, dragEventHandler)
);
$('body').addEventListener('drop', dropHandler);
modal.addEventListener('click', handleModalClick);
$('.home').addEventListener('submit', handleHomeSubmit);
$('#add-post').addEventListener('click', handleModalDisplay);






