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
                    if(isset($_GET['username'])){
                        $usernameCible = $_SESSION['usernameCible'] = $_GET['username'];
                        echo("
                            <form method='POST' action='./delete.php' class='dashboard'>
                                <label for='username'>Voulez-vous vraiment supprimer: </label>
                                <input type='text' name='username' value='$usernameCible' class='feedback-input' disabled='disabled'>
                                <input type='submit' name='submit_user' id='submit_user' value='Confirmer' class='button1'>
                            </form>
                        ");
                    }
                }
                else if($type == "announcements"){
                    if(isset($_GET['id'])){
                        $idCible = $_SESSION['idCible'] = $_GET['id'];
                        $tbResult = selectAllFromTableWhere("announcements", "id = '$idCible'");
                        foreach($tbResult as $result){
                            $titleCible = $result['title'];
                        }
                        $_SESSION['titleCible'] = $titleCible;
                    }
                    else{
                        $idCible = $_GET['id'];
                        $titleCible = $_GET['title'];
                    }
                    echo("
                    <form method='POST' action='./delete.php' class='dashboard'>
                        <label for='title'>Voulez-vous vraiment supprimer: </label>
                        <input type='text' name='title' value='$titleCible' class='feedback-input' disabled='disabled'>
                        <input type='submit' name='submit_announcements' id='submit_announcements' value='Confirmer' class='button1'>
                    </form>
                    ");
                }
                else if($type == "price"){
                    if(isset($_GET['id'])){
                        $idCible = $_SESSION['idCible'] = $_GET['id'];
                        $tbResult = selectAllFromTableWhere("price", "id = '$idCible'");
                        foreach($tbResult as $result){
                            $titleCible = $result['title'];
                            $categoryCible = $result['category'];
                        }
                        $_SESSION['titleCible'] = $titleCible;
                    }
                    echo("
                    <form method='POST' action='./delete.php' class='dashboard'>
                        <label>Voulez-vous vraiment supprimer:</label>
                        <label for='title'>Titre: </label>
                        <input type='text' name='title' value='$titleCible' class='feedback-input' disabled='disabled'>
                        <label for='category'>Catégorie: </label>
                        <input type='text' name='category' value='$categoryCible' class='feedback-input' disabled='disabled'>
                        <input type='submit' name='submit_price' id='submit_price' value='Confirmer' class='button1'>
                    </form>
                    ");
                }
                else if($type == "reservation"){
                    if(isset($_GET['id'])){
                        $idCible = $_SESSION['idCible'] = $_GET['id'];
                        $tbResult = selectAllFromTableWhere("reservation", "id = '$idCible'");
                        foreach($tbResult as $result){
                            $authorCible = $result['author'];
                            $date = $result['date'];
                        }
                        $dateexploded = explode("-", $date);
                        $dateCible = $dateexploded[2] . "/" . $dateexploded[1] . "/" . $dateexploded[0];
                        $_SESSION['authorCible'] = $authorCible;
                        $_SESSION['dateCible'] = $dateCible;
                    }
                    echo("
                    <form method='POST' action='./delete.php' class='dashboard'>
                        <label>Voulez-vous vraiment supprimer:</label>
                        <br><br>
                        <label for='author'>Auteur: </label>
                        <input type='text' name='author' value='$authorCible' class='feedback-input' disabled='disabled'>
                        <label for='date'>Date: </label>
                        <input type='text' name='date' value='$dateCible' class='feedback-input' disabled='disabled'>
                        <input type='submit' name='submit_reservation' id='submit_reservation' value='Confirmer' class='button1'>
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
    $submit_reservation = $_POST['submit_reservation'];
    if(isset($submit_user)){
        $senduserCible = $_SESSION['usernameCible'];
        removeUsersFromTable($senduserCible);
        header('Location: ./dashboard_utilisateurs.php');
    }
    if(isset($submit_announcements)){
        $sendidCible = $_SESSION['idCible'];
        $sendtitleCible = $_SESSION['titleCible'];
        removeAnnouncementsFromTable($sendidCible);
        header('Location: ./dashboard_annonces.php');
    }
    if(isset($submit_price)){
        $sendidCible = $_SESSION['idCible'];
        $sendtitleCible = $_SESSION['titleCible'];
        $sendcategoryCible = $_SESSION['categoryCible'];
        removePriceFromTable($sendidCible);
        header('Location: ./dashboard_prix.php');
    }
    if(isset($submit_reservation)){
        $sendidCible = $_SESSION['idCible'];
        $sendauthorCible = $_SESSION['authorCible'];
        $dateCible = $_SESSION['dateCible'];
        removeReservationFromTable($sendidCible);
        header('Location: ./dashboard_reservation.php');
    }
?>