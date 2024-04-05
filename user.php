<!DOCTYPE html>
<html lang="fr">

    <!--
        Auteur : Alexis Zarzycki
    -->

    <head>
        <title>FlashBowling - Profil</title>
        <meta charset="UTF-8">
        <meta name="description" content="FlashBowling est une entreprise de bowling situé à Charleroi"><!--Référencement description-->
        <meta name="keywords" content="Bowling, Charleroi, Hainaut, Belgique, pas chère, reservation, privatisation"><!--Référencement Mots-Clé-->
        <meta name="author" content="Zarzycki Alexis"> <!-- Référencement Auteur-->
        <meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
        <link rel="stylesheet" href="css/style.css"> <!-- Link le CSS -->
        <link rel="icon" type="image/png" href="img/favicon.png"/>
        <script src="https://kit.fontawesome.com/7a200c6812.js" crossorigin="anonymous"></script> <!-- Permet d'avoir les font-awesome -->
    </head>
    <body>
        <?php require './utils/navbar.php'?>
        <?php 
            session_start();
            if(empty($_SESSION['username'])){ 
                echo("
                    <section id='user-page'>
                    <div class='user-div-page'>
                        <a href='login.php' class='button-user-login'>Se connecter</a>
                        <a href='register.php' class='button-user-register'>S'inscrire</a>
                    </div>
                </section>");
            }
            else {
                header('Location: ./panel/dashboard.php');
            }
        ?>
        <?php require './utils/footer.php'?>
    </body>
</html>