<?php

    require './utils/isLogged.php';
    require 'mailgenerator.php';
    $type = $_GET['type'];
    if($type == "email"){
        $oldemail = $_GET['email'];
        $username = $_GET['username'];
        $email = $_GET['newemail'];
        if($_SESSION['username'] == $username){
            if(isset($oldemail, $username, $email)){
                header('Location: ./panel/dashboard.php');
                sendEmailChanged($oldemail, $username, $email);
            }
        }  
    }
    if($type == "password"){
        $mail = $_GET['email'];
        $username = $_GET['username'];
        header('Location: ./panel/dashboard.php');
        sendSuccessPasswordChange($username, $mail);
    }
    
?>