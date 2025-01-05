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

function key_compare_func($a, $b)
{
    if ($a === $b) {
        return 0;
    }
    return $a <=> $b;
}

function isBirthday (array $arr) {
    $currentDate['month'] = date('m');
    $currentDate['day'] = date('d');
    $result = array_diff_uassoc($arr, $currentDate, "key_compare_func");
    $result = count($result);
    return !$result > 0;
}