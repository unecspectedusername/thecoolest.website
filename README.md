# Модуль 14 Вебсайт спа-салона Randomspa

Разработан в качестве практического задания на курсе "Профессия Fullstack веб-разработчик на JavaScript и PHP"

## Используемые ткхнологии

* HTML
* CSS
* JavaScript
* PHP

## Как открыть проект

Сайт доступен по адресу [thecoolest.website/module14/index.php](https://thecoolest.website/module14/index.php)

Файл с функциями для решения задач по заданию [thecoolest.website/module14/php/functions.php](https://thecoolest.website/module14/php/functions.php)

## Пояснения по проекту

### Авторизация и регистрация

В описании задания было предложено сдетать основную страницу сайта по адресу index.php и страницу авторизации login.php. При успешной аутентификации пользователь должен быть перенаправлен на главную страницу и в сессии должна быть записана информация о том, что пользователь авторизован.

Мне хотелось сделать так же возможность регистрации новых пользователей, а так же добавить дополнительные проверки данных при авторизации / регистрации. При этом предусмотреть вывод ошибок при вводе неверных даннных в формы без перезагрузки страницы и редиректов.

Поэтому я немного отошел от условий задания и сделал формы регистрации и авторизации в рамках одной страницы index.php в модальных окнах, а запросы к серверу отправляются не по submit формы, а с помощью fetch.

При попытке авторизации пользователя, скрипт check_credentials.js посылает запрос к файлу check_credentials.php, который проверяет есть ли пользователь в базе, и ввел ли он верный пароль. В зависимости от ответа сеервера, происходит либо авторизация, либо выводится сообщение об ошибке.

В форме регистрации нового пользователя так же производится проверка по базе, если пользователь с таким email уже зарегистрирован, выводится сообщение об ошибке.

### Хранение данных пользователей

Данные храняться в JSON формате в файле /module14/database/users.json

Пароли шифруются с помощью функции password_hash

### Акция со скидкой в течение суток после первого входа на сайт

В задании была поставлена задача вывести на главной странице акцию, в которой будет выводиться персональная скидка для пользователя в течение суток после первого входа на сайт. В акции должен присутствовать таймер обратного отсчета на 24 часа. При обновлении страницы время должно обновляться.

Я вывел баннер с этой акцией в шапке сайта, но отображение обратного отсчета сделал динамическим с помощью JS, чтобы таймер отсчитывал время динамически.

Для этого время первого входа на сайт записывается в куки, скрипт countdown.js получает эту информацию и выводит в баннере, обновляя время каждую секунду.

Если с момента входа на сайт прошло более 24 часов, баннер не выводится. Куки живут 30 дней, затем акция будет показана снова.

На всякий случай оставил решение на PHP в файле countdown.php и закомментировал.

### Скидка на день рождения пользователя

При регистрации на сайте пользователь указывает дату рождения. При авторизации на сайте в сессию записывается информация о дате рождения. Количество дней до дня рождения вычисляет функция countHowManyDaysLeft, которая находится в файле birthday_dialog.php. Функция учитывает был ли уже день рождения пользователя в этом году или только будет. При расчете так же учитывается високосный ли теккущий, либо следующий год.

Информация о количестве дней до дня рождения выводится на сайте в модальном окне (для авторизованных пользователей). Если текущий день совпадает с днем рождения пользователя, выводится модальное окно со скидкой 5%.
