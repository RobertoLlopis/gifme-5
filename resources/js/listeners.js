import { $, createFormData, fetchPost, dissapear, fadeIn, uploadFileToImgur, debounceEvent, testImage } from './utils.js';
const newGifCnt = $('#last-load-img');
const gifUrlInput = $('input[name="gif-url"]');

export function handleHomeSubmit(e) {
    e.preventDefault();

    if (e.target.classList.contains('article-add-comment')) {
        let postId = e.target.closest('article').id;
        let formData = createFormData(e.target, [['postId', postId]]);

        fetchPost('/add-comment', formData)
            .then(text => console.log(text));
    }
}

export function handleModalClick(e) {
    if (e.target.id == 'modal-background-layer' || e.target.id == 'cancel-new-post') {
        const modal = $('#modal-background-layer');
        if (modal.querySelector('div').style.display != 'none') {
            modal.querySelector('div').style.display = 'none';
            newGifCnt.closest('div').style.display = 'none';
            changeNewPostUrl('');
        };
        dissapear(modal);
    }
}

export function handleModalDisplay(e) {
    const modal = $('#modal-background-layer');
    e.preventDefault();

    if (e.target.closest('#add-post')) {
        fadeIn(modal);
        $('#modal-new-post').style.display = 'flex';

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
function changeNewPostUrl(url) {
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
    if (!newGifCnt.src) {
        alert('You need to load at least a gif');
        return;
    }


}
