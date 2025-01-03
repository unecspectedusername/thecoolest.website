<?php
function getUsersList()
{
    $database = __DIR__ . '/../database/users.json';
    $users = json_decode(file_get_contents($database), true);
    return $users;
}

function checkIfEmpty($request)
{
    return empty($request) ? null : $request;
}