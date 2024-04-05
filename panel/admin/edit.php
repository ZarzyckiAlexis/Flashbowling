<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <title>FlashBowling - Panel</title>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../img/favicon.png"/>
    <script src="https://kit.fontawesome.com/7a200c6812.js" crossorigin="anonymous"></script> <!-- Permet d'avoir les font-awesome -->
</head>

<body>

    <?php
        session_start();
        require '../../utils/isLogged.php';
        require '../../utils/isAdmin.php';
        require '../../utils/navbar_dashboard_admin.php';
        require '../../utils/mysql.php';
    ?>

    <center>
        <div class="container-dashboard">
            <?php
                $type = $_GET["type"];
                if($type == "user"){
                    $usernameCible = $_SESSION['usernameCible'] = $_GET['username'];
                    $emailCible = $_SESSION['emailCible'] = $_GET['email'];
                    $rankCible = $_SESSION['rankCible'] = $_GET['rank'];
                    echo("
                        <form method='post' action='./edit.php' class='dashboard'>
                            <label for='username'>Utilisateur: </label>
                            <input type='text' name='username' value='$usernameCible' disabled='disabled' class='feedback-input'>
                            <br><br>
                            <label for='email'>Email: </label>
                            <input type='email' name='email' value='$emailCible' class='feedback-input'>
                            <br><br>
                            <label for='rank'>Grade: </label>
                            <select name='rank' class='dashboard'> 
                                <option value='$rankCible' class='dashboard'>Actuel: $rankCible</option>");
                                if($rankCible == 'Admin'){
                                    echo("<option value='Utilisateur' class='dashboard'>Utilisateur</option>");
                                }
                                else if($rankCible == 'Utilisateur'){
                                    echo("<option value='Admin' class='dashboard'>Admin</option>");
                                }
                        echo("
                            </select>
                            <br><br>
                            <input type='submit' name='submit_user' id='submit_user' value='Envoyez' class='button1'>
                        </form>
                    ");
                }
                else if($type == "announcements"){
                    $_SESSION['idAnnouncements'] = $id = $_GET['id'];
                    $tbResult = selectAllFromTableWhere("announcements", "id = '$id'");
                    foreach($tbResult as $result){
                        $titleCible = $result['title'];
                        $contentCible = $result['content'];
                    }
                    echo("
                        <form method='post' action='./edit.php' class='dashboard'>
                            <label for='title'>Titre: </label>
                            <input type='text' name='title' value='$titleCible' class='feedback-input'>
                            <br><br>
                            <label for='content'>Contenu: </label>
                            <textarea name='content' class='feedback-input'>$contentCible</textarea>
                            <br><br>
                            <input type='submit' name='submit_announcements' id='submit_announcements' value='Envoyez' class='button1'>
                        </form>
                    ");
                }
                else if($type == "price"){
                    $_SESSION['idPrice'] = $id = $_GET['id'];
                    $tbResult = selectAllFromTableWhere("price", "id = '$id'");
                    foreach($tbResult as $result){
                        $titleCible = $result['title'];
                        $categoryCible = $result['category'];
                        $contentCible = $result['content'];
                    }
                    echo("
                        <form method='post' action='./edit.php' class='dashboard'>
                            <label for='title'>Titre: </label>
                            <input type='text' name='title' value='$titleCible' class='feedback-input'>
                            <br><br>
                            <label for='category'>Catégorie: </label>
                            <input type='text' name='category' value='$categoryCible' class='feedback-input'>
                            <br><br>
                            <label for='content'>Contenu: </label>
                            <textarea name='content' class='feedback-input'>$contentCible</textarea>
                            <br><br>
                            <input type='submit' name='submit_price' id='submit_price' value='Envoyez' class='button1'>
                        </form>
                    ");
                }

            ?>
        </div>
    </center>
</body>

</html>

<?php
    $submit_user = $_POST['submit_user'];
    $submit_announcements = $_POST['submit_announcements'];
    $submit_price = $_POST['submit_price'];
    if(isset($submit_user)){
        if(isset($_SESSION['usernameCible'], $_POST['email'], $_POST['rank'])){
            $sendusernameCible = $_SESSION['usernameCible'];
            $sendemailCible = $_POST['email'];
            $sendrankCible = filter_input(INPUT_POST, "rank", FILTER_SANITIZE_STRING);
            $row = countAllFromTableWhere("user", "email = '$sendemailCible'");
            if(strcmp($_SESSION['emailCible'], $sendemailCible) !== 0){ // Si on à pas changé l'e-mail
                if($row != 0){ // Erreur e-mail déjà existant!
                    echo("<p>Cette e-mail existe déjà!</p>");
                }
                else{
                    updateUsersFromTable($sendusernameCible, $sendemailCible, $sendrankCible);
                    header('Location: ./dashboard_utilisateurs.php');
                }
            }
            else{
                updateUsersFromTable($sendusernameCible, $sendemailCible, $sendrankCible);
                header('Location: ./dashboard_utilisateurs.php');
            }
        }
    }
    if(isset($submit_announcements)){
        if(isset($_SESSION['idAnnouncements'], $_POST['title'], $_POST['content'])){
            $id = $_SESSION['idAnnouncements'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            updateAnnouncementsFromTable($id, $title, $content);
            header('Location: ./dashboard_annonces.php');
        }
    }
    if(isset($submit_price)){
        if(isset($_SESSION['idPrice'], $_POST['title'], $_POST['category'], $_POST['content'])){
            $id = $_SESSION['idPrice'];
            $title = $_POST['title'];
            $category = $_POST['category'];
            $content = $_POST['content'];
            $date = date('Y-m-d H:i:s');
            $username = $_SESSION['username'];
            updatePriceFromTable($id, $title, $category, $content, $date, $username);
            header('Location: ./dashboard_prix.php');
        }
    }

?>