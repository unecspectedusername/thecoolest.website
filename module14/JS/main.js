// меняем цвет фона header при скролле

const headerBackground = document.querySelector('#header-background');
document.addEventListener('scroll', () => {
    const offset = window.pageYOffset;
    if(offset > 100) {
        headerBackground.style.opacity = (offset - 100) / 100;
    } else {
        headerBackground.style.opacity = 0;
    }
});

// включаем воспроизведение видео

const video = document.querySelector('div.description--one-frame > img');
let rickrolled = false;
video.addEventListener('click', () => {
    if (!rickrolled) {
        video.src = './assets/rickrolling.gif';
        rickrolled = true;
    } else {
        video.src = './assets/description-frame-main.jpg';
        rickrolled = false;
    }
});

// открываем диалоговое окно для ввода логина / пароля по нажатию на кнопку "Войти"

const loginDialog = document.querySelector('#login-dialog');
const loginDialogButton = document.querySelector('#account');

loginDialogButton.addEventListener('click', () => {
    loginDialog.showModal();
});

// открываем модальное окно регистрации

const registerDialog = document.querySelector('#register-dialog');
const registerLink = document.querySelector('.registration-link a');

registerLink.addEventListener('click', (event) => {
    event.preventDefault();
    loginDialog.close();
    registerDialog.showModal();
});

// настраиваем закрытие диалоговых окон при клике мимо диалогового окна

document.querySelectorAll('dialog').forEach(dialog => {
    dialog.addEventListener('mousedown', (event) => { // mousedown вместо click. чтобы событие не срабатывало при выделении текста в инпутах, если выделение заканчивается за пределами диалогового окна
        if(event.target === event.currentTarget) {
            dialog.close();
        }
    });
});