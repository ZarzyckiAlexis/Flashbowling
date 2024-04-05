<?php
    session_start();
    session_destroy();
    unset($_SESSION);
    header('Location: ../login.php?logout=1');
    die;
?>