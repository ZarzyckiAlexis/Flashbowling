<!DOCTYPE html>
<html lang="fr">
    <!--
        Auteur : Alexis Zarzycki
    -->
    <head>
        <title>FlashBowling - Contact</title>
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
        <div class="container-contact-formulaire">
            <form class="contact" method="post" action="./contact.php">
                <h1>Contactez-nous</h1>
                <label for="mail">E-mail</label>
                <input type="mail" placeholder="Entrer votre adresse e-mail" id="email" name="email" required>
                <br>
                <label for="option">Raison</label>
                <select id="option" name="option" class="option" required>
                    <option value="Problèmes technique">Problèmes technique</option>
                    <option value="Problèmes administratif">Problèmes administratif</option>
                    <option value="Demande de partenariat">Demande de partenariat</option>
                    <option value ="Offre d'empoi">Offre d'emploi</option>
                    <option value ="Autres">Autres</option>
                </select>
                <br>
                <label for="sujet">Sujet</label>
                <textarea placeholder="Expliquez-nous" id="sujet" name="sujet" class="sujet" rows="10" required></textarea>
                <br>
                <br>
                <input type="submit" id="send" name="send" value="Envoyez" class="contact">
                <input type="reset" id="reset" name="reset" value="Effacer" class="contact">
                <?php
                    if(isset($_GET['success'])){
                        $success = $_GET['success'];
                        if($success == "1"){
                            echo("<p class='vert'>Le formulaire à bien été envoyé!</p>");
                        }
                    }
                    else if(isset($_GET['error'])){
                        $error = $_GET['error'];
                        if($error == "1"){
                            echo("<p class='rouge'>Une erreur est survenue! Avez-vous entrer un e-mail valide ?<p>");
                        }
                    }
                ?>
            </form>
        </div>
        <?php require './utils/footer.php'?>
    </body>
</html>

<?php 
    require './mailgenerator.php';
    if(isset($_POST['send'])){
        $header = filter_input(INPUT_POST, "option", FILTER_SANITIZE_STRING);
        $subject = strip_tags($_POST['sujet']);
        $mailadress = strip_tags($_POST['email']);
        if(filter_var($mailadress, FILTER_VALIDATE_EMAIL)){
            sendContactForm($header, $subject, $mailadress);    
            echo("<script>redirectionSuccessContact();</script>");
        }
        else{ 
            echo("<script>redirectionErrorContact();</script>");
        }
    }
?>