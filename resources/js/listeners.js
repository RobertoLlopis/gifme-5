import {
    $,
    createFormData,
    fetchPost,
    dissapear,
    showModal,
    uploadFileToImgur,
    debounceEvent,
    testImage,
    isHomeSection,
    isProfileSection,
    manageSearchResultsPopup,
    fadeIn
} from './utils.js';

export const newGifCnt = $('#last-load-img');
const gifUrlInput = $('input[name="custom-gif-url"]');

export function handleModalClick(e) {
    if (e.target.id == 'modal-background-layer' || e.target.id == 'cancel-new-post') {
        hideModal();
    }
}
function hideModal() {
    const modal = $('#modal-background-layer');
    if (modal.querySelector('div').style.display != 'none') {
        modal.querySelector('div').style.display = 'none';
        newGifCnt.closest('div').style.display = 'none';
        changeNewPostUrl('');
    };
    dissapear(modal);
}
export function handleModalDisplay(e) {
    e.preventDefault();
    if (e.target.closest('#add-post')) {
        showModal($('#modal-new-post'));
    }
}
export function handleNewPostFileChange(e) {
    if (!e.target.files[0]) {
        console.error('Not file finnaly selected or file input error');
        return;
    };
    newGifCnt.closest('div').style.display = 'block';
    uploadFileToImgur(e.target.files[0]).then(res => {
        changeNewPostUrl(res.data.link);
    });
}
export function changeNewPostUrl(url) {
    newGifCnt.src = url;
    gifUrlInput.value = url;
}

export const handleCustomUrlChange = debounceEvent(function (e) {

    testImage(e.target.value, function (url, result) {
        if (!result) {
            alert('custom url of gif not valid');
            return;
        };
        alert('url valid!!');
        newGifCnt.closest('div').style.display = 'block';
        changeNewPostUrl(url);
    });
}, 1000);


export function handleNewPostSubmit(e) {
    e.preventDefault();
    console.log(e.target.elements);
    if (!newGifCnt.src) {
        alert('You need to load at least a gif');
        return;
    }
    let formData = createFormData(e.target);
    formData.delete('file');
    console.log(formData);
    fetchPost('/post', formData)
        .then(text => console.log(text));
    hideModal();
}

export const handleProfileSearch = debounceEvent(function (e) {
    //Fetch for users result
    let formData = new FormData();
    formData.append('search', e.target.value);
    fetchPost('/search', formData).then(data =>
        manageSearchResultsPopup(e, JSON.parse(data))
    );

}, 800);

export function handleInteraction(e) {
    e.preventDefault();
    let icon = e.target;
    let postId = getPostId(icon);
    let formData = new FormData();
    formData.append('post_id', postId);
    //TODO: In case is comment icon.


    let parentElement = getParentElement(icon);
    let siblingIcon = getSiblingIcon(icon, parentElement);
    let status = getPostStatus(icon);
    formData.append('post_status', status);
    fetchPost('/updateLikeStatus', formData).then(res => {
        //If 0 ---> icons empty
        res = JSON.parse(res);

        if (res['like_status'] == 0) {
            removeFill(icon);
            removeFill(siblingIcon);
        }
        if (res['like_status'] == 1) {
            fillIcon(parentElement.querySelector('.fa-heart'));
            removeFill(parentElement.querySelector('.fa-dizzy'));
        }
        if (res['like_status'] == 2) {
            fillIcon(parentElement.querySelector('.fa-dizzy'));
            removeFill(parentElement.querySelector('.fa-heart'));
        }
        updateCounters(res, parentElement);
    });
}
function fillIcon(icon) {
    if (icon.classList.contains('fas')) return;
    icon.classList.remove('far');
    icon.classList.add('fas');
}
function removeFill(icon) {
    if (icon.classList.contains('fas')) {
        icon.classList.remove('fas');
        icon.classList.add('far');
    }
}
function getSiblingIcon(icon, parentElement) {
    if (icon.classList.contains('.fa-heart')) {
        return parentElement.querySelector('.fa-dizzy');
    }

    return parentElement.querySelector('.fa-heart');
}
function getParentElement(elem) {
    if (isHomeSection()) return elem.closest('.interaction-row');
    if (isProfileSection()) return elem.closest('.profile-post');
}
function getPostId(elem) {
    if (isHomeSection()) return elem.closest('article').id;
    if (isProfileSection()) return elem.closest('.profile-post').dataset['postId'];
}
function getPostStatus(elem) {
    if (elem.classList.contains('fa-heart')) return 1;
    return 2;
}
export function updateCounters(res, parentElement) {
    const likesCounter = parentElement.querySelector(`.likes-info`);
    res['likes_count'] > 0 ? likesCounter.textContent = res['likes_count'] + `${isHomeSection() ? ' Likes' : ''}` : likesCounter.textContent = ' ';
    const dislikesCounter = parentElement.querySelector(`.dislikes-info`);
    res['dislikes_count'] > 0 ? dislikesCounter.textContent = res['dislikes_count'] + `${isHomeSection() ? ' Dislikes' : ''}` : dislikesCounter.textContent = ' ';
}
