import { $, createFormData, fetchPost, dissapear, fadeIn } from './utils.js';

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
        if (modal.querySelector('div').style.display != 'none') modal.querySelector('div').style.display = 'none';
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
