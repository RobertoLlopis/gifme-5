
require('./bootstrap');
require('alpinejs');

import { $ } from './utils.js';
import { handleModalDisplay, handleModalClick, handleNewPostFileChange, handleCustomUrlChange, handleNewPostSubmit, handleFollowClick } from './listeners';
import { handleHomeSubmit, handleHomeClick, handleSidebarClick } from './homeListeners';
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
if (window.location.href.includes('home') || window.location.href.split('/').pop() == '') {
    //Handle any form submit from home section as new comments or likes
    $('.home').addEventListener('submit', handleHomeSubmit);
    $('.home').addEventListener('click', handleHomeClick);
    $('.sidebar').addEventListener('click', handleSidebarClick);
};

/*============================
======= Profile Section 
=============================*/
if (window.location.href.includes('profile')) {
    $('#profile-posts-container').addEventListener('mouseover', showIconLayer);
    $('#profile-posts-container').addEventListener('mouseout', hideIconLayer);
    $('#profile-follow').addEventListener('click', (e) => handleFollowClick(e, $('#profile-info')));
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



