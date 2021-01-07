
require('./bootstrap');
require('alpinejs');

import { $ } from './utils.js';
import { handleModalDisplay, handleModalClick, handleNewPostFileChange, handleCustomUrlChange, handleNewPostSubmit, handleFollowClick } from './listeners';
import { handleHomeSubmit } from './homeListeners';
import { showIconLayer, hideIconLayer } from "./profileListeners";
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
if (window.location.href.includes('home')) {
    //Handle any form submit from home section as new comments or likes
    $('.home').addEventListener('submit', handleHomeSubmit);
};

/*============================
======= Profile Section 
=============================*/
if (window.location.href.includes('profile')) {
    $('#profile-posts-container').addEventListener('mouseover', showIconLayer);
    $('#profile-posts-container').addEventListener('mouseout', hideIconLayer);
    $('#profile-follow').addEventListener('click', handleFollowClick);
};

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



