<?php

require_once 'helpers.php';

$_POST = json_decode(file_get_contents("php://input"), true);

$email = checkIfEmpty($_POST['email']);
$password = checkIfEmpty($_POST['password']);
$mode = $_POST['mode'];

$users = getUsersList();

if ($mode === 'verify_credentials') {
    // режим проверки данных пользователя
    if ($email === null) {
        echo 'Email is empty';
        die();
    } elseif ($password === null) {
        echo 'Password is empty';
        die();
    }

    if (!array_key_exists($email, $users)) {
        $response = [
            'status' => '0',
            'message' => 'No matching user found'
        ];
        echo json_encode($response);
        die();
    }

    if (!password_verify($password, $users[$email]['password'])) {
        $response = [
            'status' => '1',
            'message' => 'Incorrect password'
        ];
        echo json_encode($response);
        die();
    }

    // в случае успеха, записываем данные в сессию
    session_start();

    $_SESSION['email'] = $email;
    $_SESSION['userName'] = $users[$email]['name'];
    $_SESSION['birthDate'] = $users[$email]['birthDate'];
    $_SESSION['auth'] = true;

    $response = [
        'status' => '2',
        'message' => 'User authorized'
    ];

    echo json_encode($response);

} elseif ($mode === 'check_user_existence') {

    // режим проверки существования пользователя

    if ($email === null) {
        echo 'Email is empty';
        die();
    }

    if (!array_key_exists($email, $users)) {
        $response = [
            'status' => '0',
            'message' => 'No matching user found'
        ];
        echo json_encode($response);
        die();
    } else {
        $response = [
            'status' => '1',
            'message' => 'User already exists'
        ];
        echo json_encode($response);
        die();
    }
}

