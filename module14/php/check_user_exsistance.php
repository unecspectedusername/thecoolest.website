<?php

require_once 'functions.php';

$_POST = json_decode(file_get_contents("php://input"), true);

$email = checkIfEmpty($_POST['email']);

$database = '../database/users.json';
$users = json_decode(file_get_contents($database), true);