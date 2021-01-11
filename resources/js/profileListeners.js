import { $, fetchPost } from './utils';
export function handleProfileFollow(e) {
    fetchPost(`/follow/${$('#profile-info').dataset['userId']}`).then(res => res == 0 ? convertToFollowBtn() : convertToUnfollowBtn());
}

function convertToFollowBtn() {
    const btn = $('#profile-follow');
    if (btn.classList.contains('bg-yellow-300')) return;

    btn.classList.remove('bg-purple-900', 'hover:bg-yellow-300');
    btn.classList.add('bg-yellow-300', 'hover:bg-purple-900');
    btn.textContent = 'Follow';
    btn.insertAdjacentHTML('afterbegin', '<i class="fas fa-plus  mr-3"/>');
}

function convertToUnfollowBtn() {
    const btn = $('#profile-follow');
    if (btn.classList.contains('bg-purple-300')) return;

    btn.classList.remove('bg-yellow-300', 'hover:bg-purple-900');
    btn.classList.add('bg-purple-900', 'hover:bg-yellow-300');
    btn.textContent = 'Following';
    btn.insertAdjacentHTML('afterbegin', '<i class="fas fa-minus mr-3" />');
}

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