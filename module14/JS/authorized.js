const tooltip = document.querySelector('.tooltip--authorized');
const headerUserButton = document.querySelector('.account');
const logoutButton = document.querySelector('#logout--button');

headerUserButton.addEventListener('click', () => {
    if (tooltip.style.visibility == 'hidden') {
        tooltip.style.visibility = 'visible';
    } else {
        tooltip.style.visibility = 'hidden';
    }
});