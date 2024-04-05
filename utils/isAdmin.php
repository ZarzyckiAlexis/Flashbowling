<?php
    $rank = $_SESSION['rank'];

    if($rank != "Admin"){
        Header("Location: ../dashboard.php");
    }

?>