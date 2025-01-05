<?php setcookie("birthdayDialogShown", true, strtotime('+1 day')); ?>

<dialog class="dialog" id="birthday_dialog">
    <h2>
        <?php echo 'С днем рождения,<br>' . $userName . '!'; ?>
    </h2>
    <p>В честь вашего дня рождения мы дарим Вам скидку 5% на все услуги салона.</p>

</dialog>

<script script type="text/javascript">
    const banner = document.querySelector('#birthday_dialog');
    banner.showModal();
</script>
