<?php
function getUsersList()
{
    $database = __DIR__ . '/../database/users.json';
    return json_decode(file_get_contents($database), true);
}

function checkIfEmpty($request)
{
    return empty($request) ? null : $request;
}

function keyCompare($a, $b)
{
    if ($a === $b) {
        return 0;
    }
    return $a <=> $b;
}
