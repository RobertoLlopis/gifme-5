import { createFormData, fetchPost } from './utils.js';

export function handleHomeSubmit(e) {
    e.preventDefault();

    if (e.target.classList.contains('article-add-comment')) {
        let postId = e.target.closest('article').id;
        let formData = createFormData(e.target, [['postId', postId]]);

        fetchPost('/add-comment', formData)
            .then(text => console.log(text));
    }
}
