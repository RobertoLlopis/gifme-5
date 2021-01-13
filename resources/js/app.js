
require('./bootstrap');
require('alpinejs');

import { $, isHomeSection, isProfileSection, fetchPost } from './utils.js';
import { handleModalDisplay, handleModalClick, handleNewPostFileChange, handleCustomUrlChange, handleNewPostSubmit, handleInteraction, handleProfileSearch, updateCounters } from './listeners';
import { handleHomeSubmit, handleHomeClick, handleSidebarClick, handleHomeInputKeyup } from './homeListeners';
import { showIconLayer, hideIconLayer, handleProfileFollow } from "./profileListeners";
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
======= Search Profile 
=============================*/
$('#search-profile').addEventListener('keyup', handleProfileSearch);

/*============================
======== Home Section 
=============================*/
if (isHomeSection()) {
    //Handle any form submit from home section as new comments or likes
    $('.home').addEventListener('submit', handleHomeSubmit);
    $('.home').addEventListener('click', handleHomeClick);
    $('.home').addEventListener('keyup', handleHomeInputKeyup);
    $('.sidebar').addEventListener('click', handleSidebarClick);
};


/*============================
======= Profile Section 
=============================*/
if (isProfileSection()) {
    $('#profile-posts-container').addEventListener('mouseover', showIconLayer);
    $('#profile-posts-container').addEventListener('mouseout', hideIconLayer);
    $('#profile-posts-container').addEventListener('click', handleInteraction);
    $('#profile-follow').addEventListener('click', handleProfileFollow);
};

/*============================
=== Dis/Like - Comment Icons 
=============================*/
$('.interactive-icon').addEventListener('click', handleInteraction);

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

setInterval(() => {
    let renderedPost = Array.from(document.querySelectorAll('article'));
    let rendered_ids = renderedPost.map(p => p.id);
    let formData = new FormData();
    formData.append('rendered_posts', JSON.stringify(rendered_ids));
    fetchPost('/updateLikes', formData).then(res => JSON.parse(res).forEach(post => {
        updateCounters(post, document.getElementById(post['id']))
    }));
}, 10000);


// JSON.parse(res).forEach(post => uploadFileToImgur(post, $(`article[id="${post.id}"]`)))
// Object.keys(JSON.parse(res)).forEach(key => uploadFileToImgur(res[key], $(`article[id="${res[key].id}"]`)))