<!DOCTYPE html>
<html lang="fr">
    <!--
        Auteur : Alexis Zarzycki
    -->
    <head>
        <title>FlashBowling - Inscription</title>
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
        <?php require './utils/navbar.php' ?>
        <div class="container-register-formulaire">
            <form class="register" method="post" action="./register.php">
                <h1>Inscription</h1>
                <label>Nom d'utilisateur</label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" id="username" name="username" required>
                <label>Adresse e-mail</label>
                <input type="text" placeholder="Entrer l'adresse e-mail" id="email" name="email" required>
                <label>Confirmation de l'adresse e-mail</label>
                <input type="text" placeholder="Confirmer votre adresse e-mail" id="confemail" name="confemail" required>
                <label>Mot de passe</label>
                <input type="password" placeholder="Entrer le mot de passe" id="password" name="password" required>
                <label>Confirmation du mot de passe</label>
                <input type="password" placeholder="Confirmer votre mot de passe" id="confpassword" name="confpassword" required>
                <input type="submit" id="register" name="register" class="register" value="S'inscrire">
                <br><br><br><br>
                <input type="checkbox" id="condition" name="condition" required>
                <label class="notbold condition" for="condition">J'accepte les conditions d'utilisation</label>
                <?php
                if(isset($_GET['erreur'])) {
                    if($_GET['erreur'] == 0){
                        echo("<p class='rouge'>L'username et le mots de passe ne peut pas être plus long que 50 caractères.<br>L'email ne peut pas être plus long que 150 caractères.</p>");
                    }
                    else if ($_GET['erreur'] == 1) {
                        echo("<p class='rouge'>Les emails ne correspondent pas</p>");
                    } else if ($_GET['erreur'] == 2) {
                        echo("<p class='rouge'>Les mots de passe ne correspondent pas</p>");
                    } else if ($_GET['erreur'] == 3) {
                        echo("<p class='rouge'>L'adresse email existe déjà</p>");
                    } else if ($_GET['erreur'] == 4) {
                        echo("<p class='rouge'>L'username existe déjà</p>");
                    } else if ($_GET['erreur'] == 5){
                        echo("<p class='rouge'>Les emails ne sont pas valide!</p>");
                    } else if ($_GET['erreur'] == 6){
                        echo("<p class='rouge'>L'username ne peut pas être un email</p>");
                    }
                }
                ?>
            </form>
        </div>
        <?php require './utils/footer.php'?>
    </body>
</html>

<?php
    require './utils/mysql.php';
    require './mailgenerator.php';
    if(isset($_POST['register'])){
        if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['confemail'])){
            $username = strip_tags($_POST['username']); 
            $password = strip_tags($_POST['password']);
            $confpassword = strip_tags($_POST['confpassword']);
            $email = $_POST['email'];
            $emailconf = $_POST['confemail'];
            if((filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) && (filter_input(INPUT_POST, "confemail", FILTER_VALIDATE_EMAIL))){
                $email = strip_tags($email);
                $emailconf = strip_tags($emailconf);
                if($username != "" && $password != "" && $email != "" && $emailconf != ""){ 
                    if(strlen($username) <= 50 || strlen($password) <= 50 || strlen($email) <= 150){
                        if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
                            if($emailconf == $email){
                                if($password == $confpassword){
                                    $row = countAllFromTableWhere("user", "username = '$username'");
                                    if ($row == 1){
                                        header('Location: ./register.php?erreur=4');
                                    }
                                    else if($row == 0){
                                        $row2 = countAllFromTableWhere("user", "email = '$email'");
                                        if($row2 == 0){
                                            $hash = password_hash($password, PASSWORD_BCRYPT);
                                            $requete = insertUsersIntoTable($username, $hash, $email);
                                            sendSuccessCreateAccount($username, $email);
                                            header('Location: ./login.php');
                                        }
                                        else if($row2 == 1){
                                            header('Location: ./register.php?erreur=3');
                                        }
                                    }
                                }
                                else{
                                    header('Location: ./register.php?erreur=2');
                                }
                            }
                            else{
                                header('Location: ./register.php?erreur=1');
                            }
                        }
                        else{
                            header('Location: ./register.php?erreur=6');
                        }
                    }
                    else{
                        header('Location: ./register.php?erreur=0');
                    }
                }
            } else {
                header('Location: ./register.php?erreur=5');
            }
        }
    }

?>  