<?php

$d = $_POST['birthDate'];
$d = DateTimeImmutable::createFromFormat('Y-m-d', $d);
$date['month'] = date_format($d,"m");
$date['day'] = date_format($d,"d");

$currentDate['month'] = date('m');
$currentDate['day'] = date('d');
// echo var_export(array_diff($date, $currentDate));

function key_compare_func($a, $b)
{
    if ($a === $b) {
        return 0;
    }
    return $a <=> $b;
}

$result = array_diff_uassoc($date, $currentDate, "key_compare_func");

echo print_r($result);

// $currentDate = getDate();
// echo var_export($currentDate, true);
// echo $currentDate['mon'];