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


export function createFormData(form, toAppend = null) {
    let formData = new FormData(form);
    toAppend && toAppend.forEach(e => formData.append(e[0], e[1]));
    return formData;
}