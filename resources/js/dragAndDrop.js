import { $, uploadFileToImgur } from './utils.js';

//on drop listener
export function dropHandler(e) {
    e.stopPropagation();
    e.preventDefault();

    //get the data when dropped
    var dataTransfer = e.dataTransfer || (e.originalEvent && e.originalEvent.dataTransfer);

    //In case it is a file coming from the Operative System
    dataTransfer.effectAllowed = 'move';
    var file = dataTransfer.files[0];
    uploadFileToImgur(file).then(data => console.log(data));
}

export function dragEventHandler(e) {
    e.stopPropagation();
    e.preventDefault();
}