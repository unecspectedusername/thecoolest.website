<?php

function countHowManyDaysLeft(array $birthdayDate)
{
    $now = time();
    $birthdayDate = ['year' => date('Y')] + $birthdayDate;
    $birthday = mktime(0, 0, 0, $birthdayDate
    ['month'], $birthdayDate['day'], $birthdayDate['year']);
    $diff = ceil(($birthday - $now) / 86400);
    if ($diff < 0) {
        // выполняем расчет заново, увеличив год дня рождения на 1
        // просто прибавить 365 к $diff не получится т.к. год может быть високосным
        $birthday = mktime(0, 0, 0, $birthdayDate
        ['month'], $birthdayDate['day'], $birthdayDate['year'] + 1);
        return ceil(($birthday - $now) / 86400);
    } else {
        return $diff;
    }
}

// функция по склонению слова 'день' для баннера
function echo_days($days)
{
    if ($days % 10 == 1 && ($days % 100 > 19 || $days < 11)) {
        return "день";
    } elseif ($days % 10 > 1 && $days % 10 < 5 && ($days % 100 > 19 || $days < 11)) {
        return "дня";
    } else {
        return "дней";
    }
}

$daysLeft = countHowManyDaysLeft($birthDate);
$isBirthday = $daysLeft == 0 ? true : false;
// склонение слова "день"
$declension = echo_days($daysLeft);

?>

<dialog class="dialog" id="birthday_dialog">

    <?php
    if ($isBirthday) {
        echo
            <<<ITEM
            <h2>
                С днем рождения,<br>$userName!
            </h2>
            <p>В честь вашего дня рождения мы дарим Вам скидку 5% на все услуги салона.</p>
        ITEM;
    } else {
        echo
            <<<ITEM
            <h2>
                Добро пожаловать,<br>$userName!
            </h2>
            <p>До вашего дня рождения<br> $daysLeft $declension</p>
        ITEM;
    }
    ?>
</dialog>

<script script type="text/javascript">
    const banner = document.querySelector('#birthday_dialog');
    banner.showModal();
</script>
