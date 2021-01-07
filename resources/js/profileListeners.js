

export function showIconLayer(e) {
    e.stopPropagation();
    if (e.target.closest('.profile-post')) {
        resetIconLayers();

        let cell = e.target.closest('.profile-post');
        cell.querySelector('.icon-layer').classList.remove('hidden');
        cell.querySelector('.icon-layer').classList.add('flex');
    };
}
export function hideIconLayer(e) {
    e.stopPropagation();
    if (e.target.classList.contains('profile-post')) {
        resetIconLayers();
    };
}
function resetIconLayers() {
    let displayedLayers = document.querySelectorAll('.icon-layer');
    displayedLayers.forEach(elem => {
        if (elem.classList.contains('flex')) {
            elem.classList.remove('flex');
            elem.classList.add('hidden');
        }
    });
}