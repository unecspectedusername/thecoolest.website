<?php
$arr = [
    "id" => 4,
    "name" => "Ivan",
    'birthDate' => '21.12.1988',
    "email" => "1@2.com",
    "password" => "123456",
];

// получаем базу данных
$database = __DIR__.'/database/users.json';

// декодируем JSON в массив
$data = json_decode(file_get_contents($database), true);

// добавляем данные в массив
array_push($data, $arr);

// кодируем обратно в JSON
$data = json_encode($data);

// записываем данные в файл
$f = fopen($database,'w');
fwrite($f, $data);


$some = "";

$b = isset($some);

echo var_dump($b);