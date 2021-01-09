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
    isProfileSection
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

export function handleInteraction(e) {
    let icon = e.target;
    let postId = getPostId(icon);
    let siblingIcon = getSiblingIcon(icon);
    //TODO: In case is comment icon.

    // In case Icon clicked was like
    if (icon.classList.contains('fa-heart')) {
        if (!isFill(icon)) {

            if (isFill(siblingIcon)) {
                fetchInteraction('deleteDislike', postId);
            }
            fetchInteraction('like', postId);
        }

        fetchInteraction('deleteLike', postId);
    }

    // In case Icon clicked was dislike
    if (!isFill(icon)) {

        if (isFill(siblingIcon)) {
            fetchInteraction('deleteLike', postId);
        }
        fetchInteraction('dislike', postId);
    }

    fetchInteraction('deleteDislike', postId);
}

function fetchInteraction(interaction, postId) {
    let formData = new FormData();
    formData.append('postId', postId);
    //TODO: Interaction Url Builder
    //fetchPost('InteractionUrl', formData);
}

function isFill(icon) {
    return icon.classList.contains('fas') ? true : false;
}

function getSiblingIcon(icon) {
    if (icon.classList.contains('fa-heart')) {
        if (isHomeSection()) return icon.closest('.interaction-row').querySelector('fa-dizzy');

        return icon.closest('.icon-layer').querySelector('fa-dizzy');
    }

    if (isHomeSection()) return icon.closest('.interaction-row').querySelector('fa-heart');

    return icon.closest('.icon-layer').querySelector('fa-heart');
}

function getPostId(elem) {
    if (isHomeSection()) return elem.closest('article').id;
    if (isProfileSection()) return elem.closest('.profile-post').dataset['postId'];
}