<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <title>FlashBowling - Accueil</title>
    <meta carset="UTF-8">
    <meta name="description" content="FlashBowling est une entreprise de bowling situé à Charleroi"><!--Référencement description-->
    <meta name="keywords" content="Bowling, Charleroi, Hainaut, Belgique, pas chère, reservation, privatisation"><!--Référencement Mots-Clé-->
    <meta name="author" content="Zarzycki Alexis"> <!-- Référencement Auteur-->
    <meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link le CSS -->
    <link rel="icon" type="image/png" href="../img/favicon.png"/>
    <script src="https://kit.fontawesome.com/7a200c6812.js" crossorigin="anonymous"></script> <!-- Permet d'avoir les font-awesome -->
</head>

<body>
    <?php
        require '../utils/isLogged.php';
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $rank = $_SESSION['rank'];
        if($rank == "Admin"){
            require '../utils/navbar_dashboard_admin.php';
        }
        else{
            require '../utils/navbar_dashboard_user.php';
        }
        echo("<br>
                <div class='dashboard'>
                  <h1 class='white'>Bonjour $username.</h1> 
                  <p class='white'>Votre adresse email est $email.</p>
                  <p class='white'>Vous êtes $rank.</p>
                  <p class='white'><a href='./edit.php?type=email'>Appuyez ici pour modifier votre adresse e-mail.</a></p>
                  <p class='white'><a href='./edit.php?type=password'>Appuyez ici pour modifier votre mot de passe.</a></p>
                </div>
            ");
    ?>
</body>

</html>