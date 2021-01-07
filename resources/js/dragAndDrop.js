import { $, uploadFileToImgur, showModal } from './utils.js';
import { changeNewPostUrl, newGifCnt } from './listeners';

//on drop listener
export function dropHandler(e) {
    e.stopPropagation();
    e.preventDefault();

    //get the data when dropped
    var dataTransfer = e.dataTransfer || (e.originalEvent && e.originalEvent.dataTransfer);

    //In case it is a file coming from the Operative System
    dataTransfer.effectAllowed = 'move';
    var file = dataTransfer.files[0];
    newGifCnt.closest('div').style.display = 'block';
    showModal($('#modal-new-post'));
    uploadFileToImgur(file).then(res => changeNewPostUrl(res.data.link));
}

export function dragEventHandler(e) {
    e.stopPropagation();
    e.preventDefault();
}