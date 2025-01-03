<?php
session_start();
setcookie('PHPSESSID', '', time()-1, '/');
session_destroy();
header('Location: ../index.php');
exit;
