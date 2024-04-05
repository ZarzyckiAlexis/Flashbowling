<!DOCTYPE html>
<html lang="fr">

    <!--
        Auteur : Alexis Zarzycki
    -->

    <head>
        <title>FlashBowling - Accueil</title>
        <meta charset="UTF-8">
        <meta name="description" content="FlashBowling est une entreprise de bowling situé à Charleroi"><!--Référencement description-->
        <meta name="keywords" content="Bowling, Charleroi, Hainaut, Belgique, pas chère, reservation, privatisation"><!--Référencement Mots-Clé-->
        <meta name="author" content="Zarzycki Alexis"> <!-- Référencement Auteur-->
        <meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
        <link rel="stylesheet" href="css/style.css"> <!-- Link le CSS -->
        <link rel="stylesheet" href="css/pub.css">
        <link rel="icon" type="image/png" href="img/favicon.png"/>
        <script src="https://kit.fontawesome.com/7a200c6812.js" crossorigin="anonymous"></script> <!-- Permet d'avoir les font-awesome -->
    </head>
    <body>
        <?php require './utils/navbar.php' ?>
        <section id="main-page-scroll">
            <div class="container container-main-page-scroll">
                <h2>Une envie de <span class="bold orange">Bowling</span> ?</h2>
                <p>C'est <span class="bold">ici</span> que ça se passe.
                    <br>
                    Envie d'en savoir plus ? 
                    <br>
                    <br>
                    <a href="#main-page-reservation" class="main-arrowdown"><span class="fas fa-arrow-down"></span></a>
                </p>
            </div>
        </section>
        <section id="main-page-reservation">
            <div class="container container-main-page-reservation">
                <h2>Organisez votre <span class="bold orange">sortie</span></h2>
                <p>Pas toujours le temps de réserver ? 
                    <br>
                    Chez-nous, ça prends 30 secondes. 
                    <br>
                    <span class="bold">C'est</span>
                    <br>
                    <span class="bold orange">simple</span>,
                    <br>
                    <span class="bold orange">rapide</span>, 
                    <br>
                    et surtout <span class="bold orange">efficace</span>.
                </p>
                <a href="reservation.php" class="button-reserver">Effectuer une réservation</a>
                <span class="nextstep"><a href="#main-page-tarifs"><p>Cliquez ici pour prévoir votre <span class="bold orange">sortie</span> grâce à nos tarifs</p></a></span>
                <br>
            </div>
        </section>
        <section id="main-page-tarifs">
            <div class="container container-main-page-tarifs">
                <h2>Prévoyez votre <span class="bold orange">sortie</span></h2>
                <p>Peur de ne pas avoir assez d'argent ? 
                    <br>
                    Chez-nous, vous pouvez consulter nos tarifs en ligne. 
                    <br>
                    <span class="bold">C'est</span>
                    <br>
                    <span class="bold orange">simple</span>,
                    <br>
                    <span class="bold orange">rapide</span>,
                    <br>
                    et surtout d'<span class="bold orange">actualité</span>.
                </p>
                <a href="tarifs.php" class="button-tarifs">Vérifier les tarifs</a>
                <br>
            </div>
        </section>
        <?php require './utils/footer.php'?>
    </body>
</html>