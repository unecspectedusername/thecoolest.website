const tooltip = document.querySelector('.tooltip--authorized');
const headerUserButton = document.querySelector('.account');

headerUserButton.addEventListener('click', () => {
    if (tooltip.style.visibility == 'hidden') {
        tooltip.style.visibility = 'visible';
    } else {
        tooltip.style.visibility = 'hidden';
    }
});