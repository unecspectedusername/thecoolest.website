<?php

$_POST = json_decode(file_get_contents("php://input"), true);

$userName = $_POST['userName'] ?? null;
$birthDate = $_POST['birthDate'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (null !== $userName && null !== $birthDate && null !== $email && null !== $password) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $database = '../database/users.json';

    $data = json_decode(file_get_contents($database), true);

    $newUser = [
        'id' => count($data) + 1, // id равен индексу пользователя в массиве по порядку
        'name' => $userName,
        'birthDate' => $birthDate,
        'password' => $hashedPassword
    ];

    // в качестве ключа в массиве используем email, чтобы было проще проверять пользователя при авторизации
    $data[$email] = $newUser;

    // преобразуем массив в JSON, флаг JSON_UNESCAPED_UNICODE для корректного отображения кириллических символов
    $data = json_encode($data, JSON_UNESCAPED_UNICODE);

    $f = fopen($database, 'w');
    fwrite($f, $data);

    // стартуем сессию
    session_start();

    // Пишем в сессию информацию о том, что мы авторизовались:
    $_SESSION['auth'] = true;

    // Пишем в сессию данные пользователя
    $_SESSION['userName'] = $userName;
    $_SESSION['birthDate'] = $birthDate;

    $response = [
        'status'=> '1',
        'message'=> 'User registered successfully'
    ];
    echo json_encode($response);
}

