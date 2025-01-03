<?php

// ------------------------------------------------------
// Функции для выполнения практического задания

function getUsersList()
{
    $database = __DIR__ . '/../database/users.json';
    $users = json_decode(file_get_contents($database), true);
    return $users;
}

echo <<<'MESSAGE'
<pre>
-----------------------------------------------------
ПРОВЕРКА ФУНКЦИИ getUsersList()
-----------------------------------------------------
</pre>
MESSAGE;

echo '<pre>' , var_dump(getUsersList()) , '</pre>';

function existsUser($login) {
    $users = getUsersList();
    return array_key_exists($login, $users);
}

echo <<<'MESSAGE'
<pre>
-----------------------------------------------------
ПРОВЕРКА ФУНКЦИИ existsUser($login)
-----------------------------------------------------
</pre>
MESSAGE;

echo '<pre>С правильными данными (existsUser("admin@admin.com")</pre>';
echo var_export(existsUser('admin@admin.com'));
echo '<pre>С НЕправильными данными (existsUser("invaliduser@domain.com")</pre>';
echo var_export(existsUser('invaliduser@domain.com'));

function checkPassword($login, $password) {
    $users = getUsersList();
    if (existsUser($login)) {
        return password_verify($password, $users[$login]['password']);
    } else {
        return false;
    }
}

echo <<<'MESSAGE'
<pre>
-----------------------------------------------------
ПРОВЕРКА ФУНКЦИИ checkPassword($login, $password)
-----------------------------------------------------
</pre>
MESSAGE;

echo '<pre>С правильными данными (checkPassword("admin@admin.com" , "123456")</pre>';
echo var_export(checkPassword('admin@admin.com', '123456'));
echo '<pre>С неправильным паролем (checkPassword("admin@admin.com" , "654321")</pre>';
echo var_export(checkPassword('admin@admin.com', '654321'));
echo '<pre>С неправильным логином (checkPassword("invaliduser@domain.com" , "654321")</pre>';
echo var_export(checkPassword('invaliduser@domain.com', '654321'));

function getCurrentUser() {
    session_start();
    $user = $_SESSION['userName'] ?? null;

    if ($user) {
        return $user;
    } else {
        return false;
    }
}

echo <<<'MESSAGE'
<pre>
-----------------------------------------------------
ПРОВЕРКА ФУНКЦИИ getCurrentUser()
-----------------------------------------------------
</pre>
MESSAGE;

echo var_export(getCurrentUser());