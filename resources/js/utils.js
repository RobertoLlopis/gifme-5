const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
const username = document.head.querySelector("[name~=username]").content;

export function $(selector) {
    return document.querySelector(selector);
}

export function fetchPost(url, formData = null) {

    return fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            "X-CSRF-Token": csrfToken
        }
    })
        .then(response => {
            return response.text();
        })
        .catch(error => console.error(error));
};

export function uploadFileToImgur(file) {
    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Client-ID b1ea4f940c54efd");

    var formData = createFileFormData(file);

    var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: formData,
        redirect: 'follow'
    };

    return fetch("https://api.imgur.com/3/image", requestOptions)
        .then(response => response.json())
        .catch(error => console.log('error', error));
}

export function createFileFormData(file, toAppend = null) {
    var form_data = new FormData();
    form_data.append('image', file);
    toAppend && toAppend.forEach(elem => form_data.append(elem[0], elem[1]));
    return form_data;
}

export function createFormData(form, toAppend = null) {
    let formData = new FormData(form);
    toAppend && toAppend.forEach(e => formData.append(e[0], e[1]));
    return formData;
}

export function dissapear(element) {
    //Element should have transition: opacity property in css
    element.style.opacity = '0';
    setTimeout(() => element.style.display = 'none', 300);

}
export function fadeIn(element) {
    //Element should have transition: opacity property in css
    element.style.display = 'flex'
    element.style.opacity = '1';
}

export function showModal(submodal) {
    const modal = $('#modal-background-layer');
    fadeIn(modal);
    submodal.style.display = 'flex';
}
export function debounceEvent(callback, time) {
    let interval;
    return (...args) => {
        clearTimeout(interval);
        interval = setTimeout(() => {
            interval = null;
            callback(...args);
        }, time);
    };
};

export function testImage(url, callback, timeout) {
    timeout = timeout || 5000;
    var timedOut = false, timer;
    var img = new Image();
    img.onerror = img.onabort = function () {
        if (!timedOut) {
            clearTimeout(timer);
            callback(url, "");
        }
    };
    img.onload = function () {
        if (!timedOut) {
            clearTimeout(timer);
            callback(url, "success");
        }
    };
    img.src = url;
    timer = setTimeout(function () {
        timedOut = true;
        // reset .src to invalid URL so it stops previous
        // loading, but doesn't trigger new load
        img.src = "//!!!!/test.jpg";
        callback(url, "");
    }, timeout);
}

export function isHomeSection() {
    return window.location.href.includes('dashboard') || window.location.href.split('/').pop() == '' ? true : false;
}
export function isProfileSection() {
    return window.location.href.includes('profile') ? true : false;
}

export function manageSearchResultsPopup(e, users) {
    let url;
    if (e.target.id != 'search-profile') {
        e.target.insertAdjacentHTML('afterend', '<div class="searchPopup hidden absolute w-full h-max bg-white pt-3 pb-1 px-1 rounded-b-lg"></div>')
        url = '#';
    }
    let searchPopup = e.target.parentElement.querySelector('.searchPopup');
    users.forEach(u => searchPopup.insertAdjacentHTML('beforeend', createSearchResultContainer(u, !url && `/profile/${u.id}`)));
    fadeIn(searchPopup);
}

function createSearchResultContainer(user, endpoint) {
    return `<a href="${endpoint}" class="flex items-center mb-2">
    <div class="cursor-pointer flex-shrink-0 h-15 w-15">
        <img class="h-15 w-15 rounded-full border-purple-900 border-2" src="${user['photo_url_path']}" alt="avatar">
    </div>
    <div class="ml-4">
        <div class="cursor-pointer text-lg font-medium text-purple-900">
            ${user.username}
        </div>
    </div>
</a>`
}

export function createFollowingUser(user) {
    return `<div data-user-id="${user['id']}" class="follow flex items-center mb-2">
            <div class="follow-avatar cursor-pointer flex-shrink-0 h-20 w-20">
                <img class="h-20 w-20 rounded-full border-purple-900 border-2" src="${user['profile_photo_url']}" alt="user-avatar">
            </div>
            <div class="ml-4">
                <div class="follow-name cursor-pointer text-lg font-medium text-purple-900">
                   ${user['user_name']}
                </div>
                <div class="text-md text-gray-500">
                    ${user['name']}
                </div>
            </div>
        </div>`
}