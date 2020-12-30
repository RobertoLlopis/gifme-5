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

export function createFileFormData(toAppend) {
    var form_data = new FormData();
    toAppend.forEach(elem => form_data.append(elem[0], elem[1]));
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