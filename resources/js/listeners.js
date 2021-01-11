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
    fadeIn
} from './utils.js';

export const newGifCnt = $('#last-load-img');
const gifUrlInput = $('input[name="custom-gif-url"]');

export function handleFollowClick(e, infoElem) {
    fetchPost(`/follow/${infoElem.dataset['userId']}`);
}

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
    console.log(formData);
    fetchPost('/post', formData)
        .then(text => console.log(text));
    hideModal();
}

export const handleProfileSearch = debounceEvent(function (e) {
    //Fetch for users result
    //fetchProfiles()
    //then
    //Create component for users
    manageSearchResultsPopup(e, users);
}, 800);

export function handleInteraction(e) {
    let icon = e.target;
    let parentElement = getParentElement(icon);
    let siblingIcon = getSiblingIcon(icon);
    let postId = getPostId(icon);
    let formData = new FormData();
    formData.append('post_id', postId);
    //TODO: In case is comment icon.

    let status = getPostStatus(icon);
    formData.append('post_status', status);
    fetchPost('updateLikeStatus', formData).then(res => {
        //If 0 ---> icons empty
        if (res == 0) {
            removeFill(icon);
            removeFill(siblingIcon);
            return;
        }
        if (res == 1) {
            fillIcon(parentElement.querySelector('fa-heart'));
            removeFill(parentElement.querySelector('fa-dizzy'));
            return;
        }
        if (res == 2) {
            fillIcon(parentElement.querySelector('fa-dizzy'));
            removeFill(parentElement.querySelector('fa-heart'));
            return;
        }

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
function getSiblingIcon(icon) {
    if (icon.classList.contains('fa-heart')) {
        if (isHomeSection()) return icon.closest('.interaction-row').querySelector('fa-dizzy');

        return icon.closest('.icon-layer').querySelector('fa-dizzy');
    }

    if (isHomeSection()) return icon.closest('.interaction-row').querySelector('fa-heart');

    return icon.closest('.icon-layer').querySelector('fa-heart');
}
function getParentElement(elem) {
    if (isHomeSection()) return elem.closest('article');
    if (isProfileSection()) return elem.closest('.profile-post');
}
function getPostId(elem) {
    if (isHomeSection()) return elem.closest('article').id;
    if (isProfileSection()) return elem.closest('.profile-post').dataset['postId'];
}
function getPostStatus(elem) {
    if (isHomeSection()) return elem.closest('article').dataset['status'];
    if (isProfileSection()) return elem.closest('.profile-post').dataset['status'];
}