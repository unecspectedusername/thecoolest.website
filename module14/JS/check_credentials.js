// форма окна входа на сайт
const loginEmailInput = document.querySelector('#login_email');
const loginPasswordInput = document.querySelector('#login_password');
const loginButton = document.querySelector('#login_button');

// форма регистрации
const registrationNameInput = document.querySelector('#registration_user_name');
const registrationBirthDateInput = document.querySelector('#registration_birth_date');
const registrationEmailInput = document.querySelector('#registration_email');
const registrationPasswordInput = document.querySelector('#registration_password');
const registrationButton = document.querySelector('#registration_button');

// Проверка данных формы входа на сайт
loginButton.addEventListener('click', (event) => {

    event.preventDefault();

    const email = loginEmailInput.value;
    const password = loginPasswordInput.value;

    if (email.length !== 0 && password.length !== 0) {

        (async () => {
            const serverResponse = await fetch('./php/check_credentials.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: JSON.stringify({
                'email': email,
                'password': password,
                'mode': 'verify_credentials'
              })
            });
            await serverResponse.json()
            .then((response) => processLoginResponse(response.status));
          })();
    }
});

// Проверка существования пользователя в форме регистрации

registrationButton.addEventListener('click', (event) => {

    event.preventDefault();

    const email = registrationEmailInput.value;

    if (email.length !== 0) {
        (async () => {
            const serverResponse = await fetch('./php/check_credentials.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: JSON.stringify({
                'email': email,
                'password': null,
                'mode': 'check_user_existence'
              })
            });
            await serverResponse.json()
            .then((response) => processRegisterResponse(response.status));
          })();
    }
});

function processLoginResponse(statusCode) {
    // сервер может вернуть 3 статуса:
    // 0 - email не найден
    // 1 - email есть в базе, но пароль не подходит
    // 2 - данные прошли проверку, можно авторизовать пользователя

    if (statusCode == 0) {
        removeErrors();
        showError(loginEmailInput, 'Пользователь с таким email не найден');
    } else if (statusCode == 1) {
        removeErrors();
        showError(loginPasswordInput, 'Неверный пароль');
    } else if (statusCode == 2) {
        removeErrors();
        window.location.reload();
    }
}

function processRegisterResponse(statusCode) {
    // сервер может вернуть 2 статуса:
    // 0 - пользователь с таким email не найден
    // 1 - пользователь уже существует
    if (statusCode == 1) {
        removeErrors();
        showError(registrationEmailInput, 'Пользователь с таким email уже существует');
    } else if (statusCode == 0) {
        removeErrors();
        const userName = registrationNameInput.value;
        const birthDate = registrationBirthDateInput.value;
        const email = registrationEmailInput.value;
        const password = registrationPasswordInput.value;

        (async () => {
            const serverResponse = await fetch('./php/registration.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: JSON.stringify({
                'userName': userName,
                'birthDate': birthDate,
                'email': email,
                'password': password
              })
            });
            await serverResponse.json()
            .then((response) => response.status == 1 ? window.location.reload() : alert('Произошла ошибка'));
          })();

    }
}

function showError (input, message) {
    let errorMessage = document.createElement('small');
    errorMessage.innerHTML = message;
    input.after(errorMessage);
    input.style.borderBottom = '1px solid red';
}

function removeErrors () {
    const errors = document.querySelectorAll('.form-inputs small');
    errors.forEach(element => {
        element.remove();
    });
    const inputs = document.querySelectorAll('.form-inputs input');
    inputs.forEach(element => {
        element.style.borderBottom = '1px solid grey';
    });
}