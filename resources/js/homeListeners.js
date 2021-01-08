import {
    createFormData,
    fetchPost,
} from './utils.js';
import { handleFollowClick } from './listeners';


export function handleHomeSubmit(e) {
    e.preventDefault();

    if (e.target.classList.contains('article-add-comment')) {
        let postId = e.target.closest('article').id;
        let formData = createFormData(e.target, [['postId', postId]]);

        fetchPost('/comment', formData)
            .then(text => console.log(text));
    }
}
export function handleHomeClick(e) {
    console.log('fired');
    console.log(e.target.classList);
    if (e.target.closest('.article-header') || e.target.closest('.article-user-name')) {
        let userId = e.target.closest('article').id;
        if (userId) window.location.href = `/profile/${userId}`;
    }
}
export function handleSidebarClick(e) {
    if (e.target.closest('.follow-avatar') || e.target.closest('.follow-name')) {
        let userId = e.target.closest('.follow').dataset['userId'];
        if (userId) window.location.href = `/profile/${userId}`;
    }
    if (e.target.closest('.follow-button')) {
        handleFollowClick(e, e.target.closest('.suggestion'));
    }
}