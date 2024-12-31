// меняем цвет фона header при скролле

console.log('hello')
const headerBackground = document.querySelector('#header-background');
document.addEventListener('scroll', () => {
    const offset = window.pageYOffset;
    if(offset > 1000) {
        console.log(offset);
        headerBackground.style.opacity = offset / 100;
    } else {
        headerBackground.style.opacity = 0;
    }
});