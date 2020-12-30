import { $, createFileFormData, fetchPost } from './utils.js';


//$('body').addEventListener('dragenter dragover dragleave', dragEventHandler);

//update drag item when drag starts


/* //update when a dragged item enter, goes over and exits from a droppable item
function dragEventHandler(e) {
    e.stopPropagation();
    e.preventDefault();
    //if event is enter kind update drop item
    if (e.type === 'dragenter') {

        //
    }
} */

//on drop listener
export function dropHandler(e) {
    e.stopPropagation();
    e.preventDefault();

    //get the data when dropped
    var dataTransfer = e.dataTransfer || (e.originalEvent && e.originalEvent.dataTransfer);

    //In case it is a file coming from the Operative System
    dataTransfer.effectAllowed = 'move';
    var file = dataTransfer.files[0];
    console.log(file);
    //use same function declared in crud.js
    fetchPost(
        '/add-post',
        createFileFormData([
            ['file', file],
            ['description', $('#modal-new-post textarea').value]
        ])
    ).then(text => console.log(text));
}

export function dragEventHandler(e) {
    e.stopPropagation();
    e.preventDefault();
}