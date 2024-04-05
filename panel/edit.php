<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <title>FlashBowling - Panel</title>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/favicon.png"/>
    <script src="https://kit.fontawesome.com/7a200c6812.js" crossorigin="anonymous"></script> <!-- Permet d'avoir les font-awesome -->
</head>

<body>

    <?php
        session_start();
        require '../utils/isLogged.php';
        require '../utils/navbar_dashboard_user.php';
        require '../utils/mysql.php';
    ?>

    <center>
        <div class="container-dashboard">
            <?php
                $type = $_GET["type"];
                if(!isset($type)){
                    echo("<p><a href='./dashboard.php'>Retourner à l'accueil</a></p>");
                } else {
                    if($type == "email"){
                        $username = $_SESSION['username'];
                        $email = $_SESSION['email'];
                        echo("
                            <form method='post' action='./edit.php' class='dashboard'>
                                <label for='email'>Email: </label>
                                <br><br>
                                <input type='email' name='email' class='feedback-input'>
                                <br>
                                <label for='confemail'>Confirmation Email: </label>
                                <input type='email' name='confemail' class='feedback-input'>
                                <br><br>
                                <input type='submit' name='submit_email' id='submit_email' value='Envoyez' class='button1'>
                            </form>
                        ");
                    }
                    else if($type == "password"){
                        $username = $_SESSION['username'];
                        $email = $_SESSION['email'];
                        echo("
                            <form method='post' action='./edit.php' class='dashboard'>
                                <label for='email'>Email: </label>
                                <input type='text' value='$email' class='feedback-input'>
                                <br><br>
                                <label for='password'>Mot de passe: </label>
                                <input type='password' name='password' value='' class='feedback-input'>
                                <br><br>
                                <label for='confpassword'>Confirmation mot de passe: </label>
                                <input type='password' name='confpassword' value='' class='feedback-input'>
                                <br><br>
                                <input type='submit' name='submit_password' id='submit_password' value='Envoyez' class='button1'>
                            </form>
                        ");
                    }
                }
            ?>
        </div>
    </center>
</body>

</html>

<?php
    $submit_email = $_POST['submit_email'];
    $submit_password = $_POST['submit_password'];
    if(isset($submit_email)){
        if(isset($_SESSION['email'], $_POST['email'], $_POST['confemail'])){
            $username = $_SESSION['username'];
            $email = strip_tags($_POST['email']);
            $rank = $_SESSION['rank'];
            $confemail = strip_tags($_POST['confemail']);
            if(strcmp($_SESSION['email'], $email) !== 0){ // Si on à pas changé l'e-mail
                if(strcmp($email, $confemail) == 0){
                    if(strlen($mail) <= 150){
                        $row = countAllFromTableWhere("user", "email = '$email'");
                        if($row != 0){ // Erreur e-mail déjà existant!
                            echo("<p class='rouge'>Cet e-mail existe déjà!</p>");
                        }
                        else{
                            updateUsersFromTable($username, $email, $rank);
                            $oldemail = $_SESSION['email'];
                            $_SESSION['email'] = $email;
                            header("Location: ../sendMail.php?type=email&email=$oldemail&username=$username&newemail=$email");
                        }
                    }
                    else{
                        echo("<p class='rouge'>Votre e-mail ne peut pas faire plus de 150 caractères!</p>");
                    }
                }
                else{
                    echo("<p class='rouge'>Vos e-mail ne correspondent pas!</p>");
                }
            }
            else{
                echo("<p class='rouge'>Vous n'avez pas changer d'adresse e-mail!</p>");
            }
        }
    }
    if(isset($submit_password)){
        if(isset($_SESSION['email'], $_POST['password'], $_POST['confpassword'])){
            $password = $_POST['password'];
            $confpassword = $_POST['confpassword'];
            if(strcmp($password, $confpassword) == 0){
                if(strlen($password) <= 50){
                    $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                    $email = $_SESSION['email'];
                    $username = $_SESSION['username'];
                    updateUsersPasswordFromTable($username, $hashpassword);
                    header("Location: ../sendMail.php?type=password&email=$email&username=$username");
                } else {
                    echo("<p class='rouge'>Votre mot de passe ne peut pas faire plus de 50 caractères!</p>");
                }
            }
            else{
                echo("<p class='rouge'>Les mots de passe ne sont pas identique!</p>");
            }
        } else {
            echo("<p class='rouge'>Vous n'avez pas remplis toutes les cases!</p>");
        }
    }
?>