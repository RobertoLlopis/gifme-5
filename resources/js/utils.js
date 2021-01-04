const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
const username = document.head.querySelector("[name~=username]").content;

export function $(selector) {
    return document.querySelector(selector);
}

export function fetchPost(url, formData) {

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