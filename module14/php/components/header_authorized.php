<?php
$userName = $_SESSION['userName'] ?? null;
?>

<div id="header-background"></div>
<header>
    <img src="./assets/logo.svg" alt="Лого">
    <div class="account">
        <img src="./assets/account_icon.svg" alt="" width="20" height="20" fill="currentColor">
        <?php echo "<div>$userName</div>"; ?>
    </div>
    <div class="tooltip--authorized">
        <img src="./assets/account_icon_big.svg" alt="" width="80" height="80" fill="currentColor">
        <div>
            <p>Здравствуйте, <?php echo $userName; ?></p>
            <button id="logout--button" onclick="location.href='./php/logout.php'" type="button">Выйти</button>
        </div>
    </div>
</header>
