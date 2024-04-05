<?php

session_start();
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

function sendPasswordRecovery($email, $hashed, $username){
    $final = "http://localhost/Flashbowling/forget.php?user=$email&auth=$hashed";
    addResetIntoTable($email, $hashed);
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    $mail->CharSet = 'UTF-8';
    try {
        $message = file_get_contents('./utils/template_mail/template_resetpwd.html'); 
        $message = str_replace('%url%', $final, $message); 
        $message = str_replace('%username%', $username, $message);
        $header = "Demande de réinitialisation de votre mot de passe";

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';             // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = 465;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('flashbowling@sixelaonweb.fr', 'Équipe de FlashBowling');          //This is the email your form sends From
        $mail->addAddress("$email", "Client"); // Add a recipient address

        //Content
        $mail->Subject = "$header";
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->send();
    } catch (Exception $e) {
    }
}

function sendSuccessPasswordChange($username, $email){
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    $mail->CharSet = 'UTF-8';
    try {
        $message = file_get_contents('./utils/template_mail/template_successpwd.html'); 
        $message = str_replace('%username%', $username, $message);
        $header = "Réinitialisation de votre mot de passe";

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';             // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = 465;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('flashbowling@sixelaonweb.fr', 'Équipe de FlashBowling');          //This is the email your form sends From
        $mail->addAddress("$email", "Client"); // Add a recipient address

        //Content
        $mail->Subject = "$header";
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->send();
    } catch (Exception $e) {
    }
}

function sendSuccessCreateAccount($username, $email){
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    $mail->CharSet = 'UTF-8';
    try {
        
        $message = file_get_contents('./utils/template_mail/template_register.html'); 
        $message = str_replace('%username%', $username, $message); 
        $header = "Inscription";

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';             // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = 465;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('flashbowling@sixelaonweb.fr', 'Équipe de FlashBowling');          //This is the email your form sends From
        $mail->addAddress("$email", "Client"); // Add a recipient address

        //Content
        $mail->Subject = "$header";
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->send();
    } catch (Exception $e) {
    }
}

function sendContactForm($header, $subject, $mailadress){
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    $mail->CharSet = 'UTF-8';
    try {
        $message = file_get_contents('./utils/template_mail/template_contact.html'); 
        $message = str_replace('%sujet%', $header, $message); 
        $message = str_replace('%contenu%', $subject, $message); 

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';             // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = 465;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('flashbowling@sixelaonweb.fr', 'Équipe de FlashBowling');          //This is the email your form sends From
        $mail->addAddress("$email", "Client"); // Add a recipient address

        //Content
        $mail->Subject = "$header";
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->send();
    } catch (Exception $e) {
        header('Location: ./reservation.php?success=1');
    }
}

function sendReservationForm($header, $subject, $mailadress, $tel, $datereservation){
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    $mail->CharSet = 'UTF-8';
    try {
        $message = file_get_contents('./utils/template_mail/template_reservation.html'); 
        $message = str_replace('%sujet%', $header, $message); 
        $message = str_replace('%contenu%', $subject, $message); 
        $message = str_replace('%numero%', $tel, $message);
        $dateexploded = explode("-", $datereservation);
        $datereservation = $dateexploded[2] . "-" . $dateexploded[1] . "-" . $dateexploded[0];
        $message = str_replace("%datereservation%", $datereservation, $message);

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';             // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = 465;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('flashbowling@sixelaonweb.fr', 'Équipe de FlashBowling');          //This is the email your form sends From
        $mail->addAddress("$email", "Client"); // Add a recipient address

        //Content
        $mail->Subject = "$header";
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->send();
    } catch (Exception $e) {
    }
}

function sendEmailChanged($mailadress, $username, $newmail){
    $mail = new PHPMailer(true);// Passing `true` enables exceptions
    $mail->CharSet = 'UTF-8';
    try {
        $message = file_get_contents('./utils/template_mail/template_changeemail.html'); 
        $message = str_replace('%username%', $username, $message);
        $message = str_replace('%email%', $newmail, $message);

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';             // SMTP username
        $mail->Password = '';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = 465;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('flashbowling@sixelaonweb.fr', 'Équipe de FlashBowling');          //This is the email your form sends From
        $mail->addAddress("$email", "Client"); // Add a recipient address

        //Content
        $mail->Subject = "$header";
        $mail->MsgHTML($message);
        $mail->IsHTML(true); 
        $mail->send();
    } catch (Exception $e) {
    }
}

?>