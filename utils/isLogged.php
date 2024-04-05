<?php
    session_start();
    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] != "") {
            $user = $_SESSION['username'];
        }
    }
    else {
        header("Location: ../login.php?error=3");
    }
?>