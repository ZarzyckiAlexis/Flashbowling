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
        require '../../utils/isLogged.php';
        require '../../utils/isAdmin.php';
        require '../../utils/navbar_dashboard_admin.php';
        require '../../utils/mysql.php';
    ?>

    <center>
        <div class="container-dashboard">
            <?php
                session_start();
                $type = $_GET["type"];
                if($type == "announcements"){
                    echo("
                        <form method='post' action='./add.php' class='dashboard'>
                            <label for='title'>Titre: </label>
                            <input type='text' name='title' class='feedback-input'>
                            <br><br>
                            <label for='content'>Contenu: </label>
                            <textarea name='content' class='feedback-input'>Le contenu de votre annonce en HTML</textarea>
                            <br><br>
                            <input type='submit' name='submit_announcements' id='submit_announcements' value='Envoyez' class='button1'>
                        </form>
                    ");
                }
                if($type == "price"){
                    echo("
                        <form method='post' action='./add.php' class='dashboard'>
                            <label for='title'>Titre: </label>
                            <input type='text' name='title' class='feedback-input'>
                            <br><br>
                            <label for='category'>Catégorie: </label>
                            <input type='text' name='category' class='feedback-input'>
                            <br><br>
                            <label for='content'>Contenu: </label>
                            <textarea name='content' class='feedback-input'>Le contenu de votre annonce en HTML</textarea>
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
    $submit_announcements = $_POST['submit_announcements'];
    $submit_price = $_POST['submit_price'];
    if(isset($submit_announcements)){
       if(isset($_POST['title'], $_POST['content'])){
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']);
        $username =  $_SESSION['username'];
        $date = date('Y-m-d H:i:s');
        addAnnouncementsFromTable($title, $content, $date, $username);
        header('Location: ./dashboard_annonces.php');
        } 
    }
    if(isset($submit_price)){
        if(isset($_POST['title'], $_POST['category'], $_POST['content'])){
            $title = strip_tags($_POST['title']);
            $category = strip_tags($_POST['category']);
            $content = strip_tags($_POST['content']);
            $username =  $_SESSION['username'];
            $date = date('Y-m-d H:i:s');
            addPriceFromTable($title, $category, $content, $date, $username);
            header('Location: ./dashboard_prix.php');
        }
    }
    

?>