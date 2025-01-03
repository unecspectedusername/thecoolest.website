<?php

require_once 'helpers.php';

$email = checkIfEmpty($_POST['email']);
$password = checkIfEmpty($_POST['password']);

if (null !== $email || null !== $password) {

    try {
        
        $users = getUsersList();
    
        if (!array_key_exists($email, $users)) {
            echo 'No matching user found';
            throw new Exception('No matching user found');
        }

        if (!password_verify($password, $users[$email]['password'])) {
            echo 'Incorrect password';
            throw new Exception('Incorrect password');
        }

        session_start();

        $_SESSION['auth'] = true;

        $_SESSION['name'] = $users[$email]['name'];
        $_SESSION['birthDate'] = $users[$email]['birthDate'];

    } catch(Exception $ex){
        echo 'Caught exception: ',  $ex->getMessage(), "\n";
        clean_all_processes();
    }
}

$auth = $_SESSION['auth'] ?? null;

if ($auth) {
    header('Location: ../index.php');
}
