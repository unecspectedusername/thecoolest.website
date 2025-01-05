<?php

session_start();

// получаем день рождения пользователя из сессии и приводим в формат для сравнения
$userBirthDate = $_SESSION['birthDate'];
$userBirthDate = substr($userBirthDate, 5);

// 
$date = new DateTimeImmutable();
$date = $date->format('m-d');
// $arr = explode('-', $date);

$result = $userBirthDate == $date;

echo var_export($result);

// // echo var_export($date);

// $parsed = date_parse($userBirthDate);

// echo var_dump($arr);


$arr1 = [1, 2, 3];
$arr1 = ['year' => $arr1[0], 'month' => $arr1[1], 'day' => $arr1['2']];
print_r($arr1);