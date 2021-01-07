import {
    $,
    createFormData,
    fetchPost,
    dissapear,
    showModal,
    uploadFileToImgur,
    debounceEvent,
    testImage
} from './utils.js';

export const newGifCnt = $('#last-load-img');
const gifUrlInput = $('input[name="custom-gif-url"]');

export function handleFollowClick(e) {
    fetchPost(`/follow/${$('#profile-info').dataset['userId']}`);
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


