<?php

require_once 'helpers.php';

$_POST = json_decode(file_get_contents("php://input"), true);

$userName = $_POST['userName'] ?? null;
$rawDate = $_POST['birthDate'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (null !== $userName && null !== $rawDate && null !== $email && null !== $password) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $users = getUsersList();
    
    // обрабатываем данные из инпута с датой, чтобы получить месяц и день рождения
    $rawDate = DateTimeImmutable::createFromFormat('Y-m-d', $rawDate);
    $birthDate['month'] = date_format($rawDate,"m");
    $birthDate['day'] = date_format($rawDate,"d");

    $newUser = [
        'id' => count($users) + 1, // id равен индексу пользователя в массиве по порядку
        'name' => $userName,
        'birthDate' => $birthDate,
        'password' => $hashedPassword
    ];

    // в качестве ключа в массиве используем email, чтобы было проще проверять пользователя при авторизации
    $users[$email] = $newUser;

    // преобразуем массив в JSON, флаг JSON_UNESCAPED_UNICODE для корректного отображения кириллических символов
    $users = json_encode($users, JSON_UNESCAPED_UNICODE);

    $database = __DIR__ . '/../database/users.json';
    $f = fopen($database, 'w');
    fwrite($f, $users);

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

