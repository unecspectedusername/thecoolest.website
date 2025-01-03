// открываем диалоговое окно для ввода логина / пароля по нажатию на кнопку "Войти"

const loginDialog = document.querySelector('#login-dialog');
const loginDialogButton = document.querySelector('.account');

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