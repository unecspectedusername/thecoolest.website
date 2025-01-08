<?php

// записываем время входа пользователя на сайт в куки
// куки живут 30 дней, затем акцию можно будет показать снова
$cookieSet = $_COOKIE['firstVisitTime'] ?? null;
$currentTime = strtotime('now');

if (!$cookieSet) {
    setcookie("firstVisitTime", $currentTime, strtotime('+30 days'));
}

// в задании было сказано, что нужно выводить время при обновлении страницы
// вместо этого, я решил получать данные из COOKIE в JS и сделать на основании этого таймер с обратным отсчетом
// Если для решения задачи нужно именно решение на PHP, то оно ниже:

// $firstVisitTime = $_COOKIE['firstVisitTime'];

// $timeRemaining = 86400 - ($currentTime - $firstVisitTime); // вычисляем сколько секунд осталось до конца акции (24часа - (текущее время - время входа на сайт))

// $isCookieRotten = $timeRemaining < 0 ? true : false;

// if ($isCookieRotten) return; // если куки установлены более 24 часов назад, останавливаем программу

// // function countRemainingTime ($time) {
// //     $hours = intdiv($time, 3600);
// //     $time = $time - ($hours * 3600);
// //     $minutes = intdiv($time, 60);
// //     $seconds = $time - ($minutes * 60);
// //     return [
// //         'hours' => $hours,
// //         'minutes' => $minutes,
// //         'seconds'=> $seconds
// //     ];
// // }

// // $timeRemaining = countRemainingTime($timeRemaining);

// // echo <<<EOT
// // <div class="countdown">
// //     Ваша персональная скидка 10% действует еще <span id="hours">{$timeRemaining['hours']}</span>ч <span id="minutes">{$timeRemaining['minutes']}</span>м <span id="seconds">{$timeRemaining['seconds']}</span>с
// // </div>
// // EOT;



