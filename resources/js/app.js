
require('./bootstrap');
require('alpinejs');

import { $ } from './utils.js';
import { handleHomeSubmit, handleModalDisplay, handleModalClick, handleNewPostFileChange, handleCustomUrlChange, handleNewPostSubmit } from './listeners';
import { dropHandler, dragEventHandler } from './dragAndDrop';

const modal = $('#modal-background-layer');

/*============================
=========== Body 
=============================*/

['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave'].forEach(evt =>
    $('body').addEventListener(evt, dragEventHandler)
);
$('body').addEventListener('drop', dropHandler);

/*============================
======== Home Section 
=============================*/

//Handle any form submit from home section as new comments or likes
$('.home').addEventListener('submit', handleHomeSubmit);

/*============================
======= Modal Component 
=============================*/

modal.addEventListener('click', handleModalClick);

/*============================
===== Modal - new post 
=============================*/

// plus button
$('#add-post').addEventListener('click', handleModalDisplay);
// input file change
$('#modal-new-post input[type=file]').addEventListener('change', handleNewPostFileChange);
// input custom url change
$('input[name=custom-gif-url]').addEventListener('keyup', handleCustomUrlChange)
// submit
$('#modal-new-post').addEventListener('submit', handleNewPostSubmit);
// Cancel button
$('#cancel-new-post').addEventListener('click', handleModalClick);



