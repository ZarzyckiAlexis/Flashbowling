<!DOCTYPE html>
<html lang="fr">
    <!--
        Auteur : Alexis Zarzycki
    -->
    <head>
        <title>FlashBowling - Réservation</title>
        <meta charset="UTF-8">
        <meta name="description" content="FlashBowling est une entreprise de bowling situé à Charleroi"><!--Référencement description-->
        <meta name="keywords" content="Bowling, Charleroi, Hainaut, Belgique, pas chère, reservation, privatisation"><!--Référencement Mots-Clé-->
        <meta name="author" content="Zarzycki Alexis"> <!-- Référencement Auteur-->
        <meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
        <link rel="stylesheet" href="css/style.css"> <!-- Link le CSS -->
        <link rel="icon" type="image/png" href="img/favicon.png"/>
        <script src="https://kit.fontawesome.com/7a200c6812.js" crossorigin="anonymous"></script> <!-- Permet d'avoir les font-awesome -->
        <script src="./js/script.js"></script>
    </head>
    <body>
        <?php require './utils/navbar.php'?>
        <div class="container-reservation-formulaire">
        <form class="reservation" method="post" action="./reservation.php">
            <h1>Réservez-chez nous</h1>
            <label for="mail">E-mail</label>
            <input type="mail" placeholder="Entrer votre adresse e-mail" id="email" name="email" required>
            <label for="tel">Téléphone</label>
            <input type="number" placeholder="Entrer votre numéro de téléphone" id="tel" name="tel" required>
            <br>
            <label for="date">Votre date de réservation</label>
            <br>
            <input type="date" name="date">
            <br><br>
            <label for="option">Raison</label>
            <select id="option" name="option" class="option" required>
                <option>Privatisation</option>
                <option>Bowling</option>
                <option>Aire de jeu</option>
                <option>Autres</option>
            </select>
            <br>
            <label for="sujet">Sujet</label>
            <textarea placeholder="Expliquez-nous votre projet..." id="sujet" name="sujet" class="sujet" rows="10" required></textarea>
            <br>
            <br>
            <input type="submit" class="reservation" id="send" name="send" value="Envoyez">
            <span class="space"></span>
            <input type="reset" class="reservation" id="reset" name="reset" value="Effacer">
            <?php
                if(isset($_GET['error'])){
                $erreur = $_GET['error'];
                if($erreur == "1"){
                    echo("<p class='rouge'>Une erreur est survenue!</p>");
                }
                }
                if(isset($_GET['success'])){
                    $success = $_GET['success'];
                    if($success == "1"){
                        echo("<p class='vert'>Le formulaire à bien été envoyé!</p>");
                    }
                }
            ?>
        </form>
    </div>
        <?php include './utils/footer.php'?>
    </body>
</html>

<?php 
    require './mailgenerator.php';
    require './utils/mysql.php';
    if(isset($_POST['send'])){
        $header = filter_input(INPUT_POST, "option", FILTER_SANITIZE_STRING);
        $subject = strip_tags($_POST['sujet']);
        $mailadress = strip_tags($_POST['email']);
        $tel = strip_tags($_POST['tel']);
        $date = strip_tags($_POST['date']);
        if($date >= date("Y-m-d")){
            addReservationTable($mailadress, $tel, $date, $header, $subject);
            sendReservationForm($header, $subject, $mailadress, $tel, $date);
            echo("<script>redirectionSuccessReservation();</script>");
        }
        else{
            echo("<script>redirectionErrorReservation();</script>");
        }
    }
?>