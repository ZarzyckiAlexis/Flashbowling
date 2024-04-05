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
        <?php session_start(); require './utils/navbar.php' ?>
        <?php if(!isset($_GET['auth']) || !isset($_GET['user'])): ?>
            <div class="container-register-formulaire">
                <form class="register" method="post" action="./forget.php">
                    <h1>Réinitialiser votre mot de passe</h1>
                    <label>Adresse e-mail / Nom d'utilisateur</label>
                    <input class="feedback-input" type="text" value="Entrer l'adresse e-mail / Nom d'utilisateur" id="usermail" name="usermail" required>
                    <?php if (isset($_GET['erreur'])) {
                            $err = $_GET['erreur'];
                            if ($err == 1) echo "<p class='rouge'>Le mot de passe et la confirmation ne peuvent pas être vide!</p><br><br><br>";
                            if ($err == 2) echo "<p class='rouge'>Les mots de passe ne correspondent pas!</p><br><br><br>";
                            if ($err == 3) echo "<p class='rouge'>Le mot de passe ne peut pas être plus grand que 50 caractères!</p><br><br><br>";
                        }
                        if(isset($_GET['success'])){
                            $success = $_GET['success'];
                            if($success == 1){
                                echo "<p class='vert'>Si votre compte existe, vous devriez recevoir un e-mail contenant un lien de réinitialisation.</p><br><br>";
                            }
                        }
                    ?>
                    <input type="submit" id="reset" name="reset" class="register" value="Réinitialiser">
                </form>
            </div>
        <?php else: ?>
            <div class="container-register-formulaire">
                <form class="register" method="post" action="./forget.php">
                    <h1>Réinitialiser votre mot de passe</h1>
                    <label>Adresse e-mail / Nom d'utilisateur</label>
                    <input class="feedback-input" type="text" value="<?php echo($_GET['user']);?>" id="userreset" name="userreset" required disabled>
                    <?php $_SESSION['mailReset'] = strip_tags($_GET['user']); $_SESSION['hashReset'] = $_GET['auth']; ?>
                    <input class="feedback-input" type="password" name="password" value="Nouveau mot de passe">
                    <input class="feedback-input" type="password" name="confpassword" value="Confirmation nouveau mot de passe">
                    <input type="submit" id="reset_step" name="reset_step" class="register" value="Changer le mot de passe">
                </form>
            </div>
        <?php $_SESSION['userCible'] = $_GET['user']; ?>
        <?php endif; ?>
        <?php require './utils/footer.php'?>
    </body>
</html>

<?php
    require './utils/mysql.php';
    require './mailgenerator.php';
    if(isset($_POST['reset'])){
        if(isset($_POST['usermail'])){
            $email = strip_tags($_POST['usermail']); 
            if($email != ""){ 
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $row = countAllFromTableWhere("user", "email = '$email'");
                    if($row != 0){
                        $tbResult = selectAllFromTableWhere("user", "email = '$email'");
                        foreach($tbResult as $result){
                            $username = $result['username'];
                        }
                        $row2 = countAllFromTableWhere("reset", "email = '$email'");
                        if($row2 == 0){
                            $hashed = password_hash($email, PASSWORD_BCRYPT);
                            sendPasswordRecovery($email, $hashed, $username);
                            header('Location: ./forget.php?success=1');
                        }else{
                            removeResetFromTable($email);
                            $hashed = password_hash($email, PASSWORD_BCRYPT);
                            sendPasswordRecovery($email, $hashed, $username);
                            header('Location: ./forget.php?success=1');
                        }
                    }
                } else {
                    $username = $email;
                    $tbResult = selectAllFromTableWhere("user", "username = '$username'");
                    foreach($tbResult as $result){
                        $email = $result['email'];
                    }
                    $row = countAllFromTableWhere("user", "email = '$email'");
                    if($row != 0){
                        $row2 = countAllFromTableWhere("reset", "email = '$email'");
                        if($row2 == 0){
                            $hashed = password_hash($email, PASSWORD_BCRYPT);
                            sendPasswordRecovery($email, $hashed, $username);
                            header('Location: ./forget.php?success=1');
                        } else{
                            removeResetFromTable($email);
                            $hashed = password_hash($email, PASSWORD_BCRYPT);
                            sendPasswordRecovery($email, $hashed, $username);
                            header('Location: ./forget.php?success=1');
                        }
                    }
                }
            }
        }
    }
    if(isset($_POST['reset_step'])){
        if(isset($_POST['password'], $_POST['confpassword'])){
            $password = strip_tags($_POST['password']);
            $confpassword = strip_tags($_POST['confpassword']);
            $mail = $_SESSION['mailReset'];
            if($password == $confpassword){
                if(strlen($password) < 50){
                    $hash = $_SESSION['hashReset'];
                    $tbResult = selectAllFromTableWhere("reset", "hash = '$hash'");
                    foreach($tbResult as $result){
                        $hashSQL = $result['hash'];
                    }
                    $tbResult = selectAllFromTableWhere("user", "email = '$mail'");
                    foreach($tbResult as $result){
                        $username = $result['username'];
                    }
                    if($hashSQL == $hash){
                        $cryptedpassword = password_hash($password, PASSWORD_BCRYPT);
                        updateUsersPasswordFromTable($username, $cryptedpassword);
                        removeResetFromTable($mail);
                        sendSuccessPasswordChange($username, $mail);
                        header('Location: ./login.php');
                    }
                } else{
                    header('Location: ./forget.php?erreur=3');
                }
            } else {
                header('Location: ./forget.php?erreur=2');
            }
        }else{
            header('Location: ./forget.php?erreur=1');
        }
    }
?>  