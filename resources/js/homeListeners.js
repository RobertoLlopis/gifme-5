import {
    $,
    fetchPost,
    debounceEvent,
    createFollowingUser,
    manageSearchResultsPopup,
    dissapear
} from './utils.js';
import { handleInteraction } from './listeners';
const mentionRegEx = /([@#])([a-z\d_]+)/ig;
const finalFormatRegEx = /([_#])([a-z\d_]+)/ig;

export function handleHomeSubmit(e) {
    e.preventDefault();

    if (e.target.classList.contains('article-add-comment')) {
        let commentInputValue = e.target.querySelector('input').value;
        let finalComment = '';
        let _users = commentInputValue.match(finalFormatRegEx);
        _users.forEach(_user => {
            let user = _user.slice(1);
            finalComment == ''
                ? finalComment = commentInputValue.replace(_user, `<a href="/profile/${user}" class="bg-yellow-300 font-black font-bold">${user}</a>`)
                : finalComment = finalComment.replace(_user, `<a href="/profile/${user}" class="bg-yellow-300 font-black font-bold">${user}</a>`);
        });

        let postId = e.target.closest('article').id;
        let formData = new FormData();
        formData.append('postId', postId);
        formData.append('comment', finalComment);

        fetchPost('/comment', formData)
            .then(text => console.log(text));
    }
}
export function handleHomeClick(e) {
    if (e.target.classList.contains('interactive-icon')) {
        handleInteraction(e);
    }
    if (e.target.closest('.searchPopup')) {
        //TODO: Logic of mention (maybe add info in form element)
    }
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
        let user = e.target.closest('.follow');
        fetch(`/user/${user.dataset['userId']}`).then(res => res.json())
            .then(users => $('#following-container').insertAdjacentHTML('beforeend', createFollowingUser(users[0])));
        fetchPost(`/follow/${user.dataset['userId']}`);
        dissapear(user);
        user.remove();
    }
}

export const handleHomeInputKeyup = debounceEvent(function (e) {
    const input = e.target;
    if (mentionRegEx.test(input.value)) {
        let matched = input.value.match(mentionRegEx);

        let formData = new FormData();
        formData.append('search', matched[0].slice(1));
        fetchPost('/search', formData).then(res => {
            let users = JSON.parse(res);
            console.log(users);
            manageSearchResultsPopup(e, users);
            input.parentElement.querySelector('.searchPopup').addEventListener('click', (e) => replaceWithAnchor(e, input));
        });
    }
}, 500);

function replaceWithAnchor(e, input) {
    e.preventDefault();
    let username = e.target.closest('a').querySelector('.username').textContent.trim();

    // let inputValueReplaced = input.value.replace(mentionRegEx, `<a href="/profile/${userMentionId}" class="bg-yellow-300 font-black font-bold">${username}</a>`);
    input.value = input.value.replace(mentionRegEx, '_' + username);

    // commentMentionsBuffer.comment = inputValueReplaced;
    dissapear(e.target.closest('form').querySelector('.searchPopup'));
    input.focus();
    console.log(commentMentionsBuffer);
}