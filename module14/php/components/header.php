<div class="header-container">
    <div class="countdown">Ваша персональная скидка 10% действует еще <span id="hours"></span>ч <span
            id="minutes"></span>м <span id="seconds"></span>с</div>
    <div id="header-background"></div>
    <header>
        <img src="./assets/logo.svg" alt="Лого">
        <div class="account">
            <img src="./assets/account_icon.svg" alt="" width="20" height="20" fill="currentColor">
            <?php if ($auth) {
                echo "<div>$userName</div>";
            } else {
                echo "<div>Войти</div>";
            }
            ?>
        </div>
        <?php if ($auth) {
            include_once __DIR__ . '/../components/tooltip_authorized.php';
        } ?>
    </header>
</div>