<?php

// ------------------------------------------------------
// Функции для выполнения практического задания

// в задании было указано, что функция должна возвращать "пользователей и хеши их паролей"
// поэтому я настроил возврат только логинов и хешей паролей, опустив остальные данные (имя, дата рождения, id)
function getUsersList()
{
    $users = getUsers();
    $userData = [];
    foreach ($users as $user => $data) {
        $temp = [
            'user' => $user,
            'password' => $data['password'],
        ];
        array_push($userData, $temp);
    }
    return $userData;
}

echo <<<'MESSAGE'
<pre>
-----------------------------------------------------
ПРОВЕРКА ФУНКЦИИ getUsersList()
-----------------------------------------------------
</pre>
MESSAGE;

echo '<pre>', var_dump(getUsersList()), '</pre>';

function existsUser($login)
{
    $users = getUsers();
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

function checkPassword($login, $password)
{
    $users = getUsers();
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

function getCurrentUser()
{
    session_start();
    return $_SESSION['userName'] ?? null;
}

echo <<<'MESSAGE'
<pre>
-----------------------------------------------------
ПРОВЕРКА ФУНКЦИИ getCurrentUser()
-----------------------------------------------------
</pre>
MESSAGE;

echo var_export(getCurrentUser());

// вспомогательная функция

function getUsers()
{
    $database = __DIR__ . '/../database/users.json';
    return json_decode(file_get_contents($database), true);
}
