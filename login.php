<!DOCTYPE html>
<html lang="fr">
    <!--
        Auteur : Alexis Zarzycki
    -->
    <head>
        <title>FlashBowling - Connexion</title>
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
        <div class="container-login-formulaire">
            <form class="login" method="post" action="./login.php">
                <h1>Connexion</h1>
                <label>Nom d'utilisateur / Email</label>
                <input type="text" placeholder="Nom d'utilisateur / Email" id="loginName" name="loginName" required>
                <label>Mot de passe</label>
                <input type="password" placeholder="Entrer le mot de passe" id="password" name="password" required>
                <?php
                    if (isset($_GET['erreur'])) {
                        $err = $_GET['erreur'];
                        if ($err == 1) echo "<p class='rouge'>Nom d'utilisateur / Email ou mot de passe incorrect.</p><br><br><br>";
                        if ($err == 2) echo "<p class='rouge'>Vous n'avez pas accès à cette page.</p><br><br><br>";
                        if ($err == 3) echo "<p class='rouge'>Vous n'êtes pas connecté!</p><br><br><br>";
                    }
                    else if(isset($_GET['logout'])){
                        $logout = $_GET['logout'];
                        if ($logout == 1) echo "<p class='vert'>Vous êtes bien déconnecté!</p><br><br><br>";
                    }
                ?>
                <input type="submit" id="login" name="login" class="login" value="Se connecter">
                <label class="register"><a href="register.php" class="register notbold">Vous n'êtes toujours pas inscrit ?!</a></label>
                <br><br>
                <label class=""><a href="forget.php" class="notbold">Vous avez oubliez votre mot de passe ?</a></label>

            </form>
        </div>
        <?php require './utils/footer.php'?>
    </body>
</html>

<?php
    session_start();
    require './utils/mysql.php';
    if(isset($_POST['login'])){
        if(isset($_POST['loginName'], $_POST['password'])){
            $loginName = strip_tags($_POST['loginName']);
            $password = strip_tags($_POST['password']);
            if($loginName != "" && $password != ""){
                if(filter_var($loginName, FILTER_VALIDATE_EMAIL)){ // Email !
                    $tbResult = selectAllFromTableWhere("user", "email = '$loginName'");
                    foreach($tbResult as $result){
                        $hashedpassword = $result['password'];
                        $username = $result['username'];
                        $email = $result['email'];
                        $rank = $result['rank'];  
                    }
                    $verifiedpassword = password_verify($password, $hashedpassword);
                    if($verifiedpassword){
                        $row = countAllFromTableWhere("user", "email = '$email' and password = '$hashedpassword'");
                        if($row != 0){
                            $_SESSION['username'] = $username;
                            $_SESSION['email'] = $email;
                            $_SESSION['rank'] = $rank;
                            header('Location: ./panel/dashboard.php');
                        }
                        else{
                            header('Location: ./login.php?erreur=1');
                        }
                     }
                     else{
                        header('Location: ./login.php?erreur=1');
                    }
                } // else connexion username
                else{
                    $tbResult = selectAllFromTableWhere("user", "username = '$loginName'");
                    foreach($tbResult as $result){
                        $hashedpassword = $result['password'];
                        $username = $result['username'];
                        $email = $result['email'];
                        $rank = $result['rank'];  
                    }
                    $verifiedpassword = password_verify($password, $hashedpassword);
                    if($verifiedpassword){
                        $row = countAllFromTableWhere("user", "username = '$loginName' and password = '$hashedpassword'");
                        if($row != 0){
                            $_SESSION['username'] = $username;
                            $_SESSION['email'] = $email;
                            $_SESSION['rank'] = $rank;
                            header('Location: ./panel/dashboard.php');
                        }
                        else{
                            header('Location: ./login.php?erreur=1');
                        }
                     }
                     else{
                        header('Location: ./login.php?erreur=1');
                    }
                }
            }
            else {
                header('Location: ./login.php?erreur=1');
            }
        }
        else {
            header('Location: ./login.php?erreur=1');
        }
    }
?>