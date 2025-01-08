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

    const allInputsFilled = inputsCheckIfEmpty([loginEmailInput, loginPasswordInput]);

    if (allInputsFilled) {

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

    const allInputsFilled = inputsCheckIfEmpty([registrationNameInput, registrationBirthDateInput, registrationEmailInput, registrationPasswordInput]);

    const email = registrationEmailInput.value;

    if (allInputsFilled) {
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
        removeAllErrors();
        showError(loginEmailInput, 'Пользователь с таким email не найден');
    } else if (statusCode == 1) {
        removeAllErrors();
        showError(loginPasswordInput, 'Неверный пароль');
    } else if (statusCode == 2) {
        removeAllErrors();
        window.location.reload();
    }
}

function processRegisterResponse(statusCode) {
    // сервер может вернуть 2 статуса:
    // 0 - пользователь с таким email не найден
    // 1 - пользователь уже существует
    if (statusCode == 1) {
        removeAllErrors();
        showError(registrationEmailInput, 'Пользователь с таким email уже существует');
    } else if (statusCode == 0) {
        // регистрируем нового пользователя
        removeAllErrors();
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
    const error = input.nextElementSibling;
    const errorShown = error.nodeName == 'SMALL';
    if (!errorShown) {
      let errorMessage = document.createElement('small');
      errorMessage.innerHTML = message;
      input.after(errorMessage);
      input.classList.add('input-invalid');
    }
}

function removeAllErrors () {
    const errors = document.querySelectorAll('.form-inputs small');
    errors.forEach(element => {
        element.remove();
    });
    const inputs = document.querySelectorAll('.form-inputs input');
    inputs.forEach(input => {
        input.classList.remove('input-invalid');
    });
}

function inputsCheckIfEmpty (inputs) {
  const checkResults = [];
  inputs.forEach(input => {
    const error = input.nextElementSibling;
    const errorShown = error.nodeName == 'SMALL';
    if (input.value == '') {
      input.classList.add('input-invalid');
      showError(input, 'Поле не должно быть пустым');
      checkResults.push(false);
    } else {
      input.classList.remove('input-invalid');
      const error = input.nextElementSibling;
        if (errorShown) {
          error.remove();
        }
      checkResults.push(true);
    }
  });
  return checkResults.every(Boolean);
}