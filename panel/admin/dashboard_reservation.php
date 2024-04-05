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
?>

<center>
    <div class="container-dashboard">
        <table class="styled-table">
            <thead>
            <tr>
                <th colspan="2">Auteur</th>
                <th>Numéro de Téléphone</th>
                <th>Date souhaitée</th>
                <th>Type de réservation</th>
                <th>Contenu</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

                require '../../utils/mysql.php';
                $tbResult = selectAllFromTableOrderByOne("reservation", "id");
                foreach($tbResult as $result){
                    $id = $result['id'];
                    $author = $result['author'];
                    $tel = $result['phone'];
                    $date = $result['date'];
                    $dateexploded = explode("-", $date);
                    $date = $dateexploded[2] . "/" . $dateexploded[1] ."/" .$dateexploded[0];
                    $type = $result['reason'];
                    $sujet = $result['content'];
                    echo("
                        <tr>
                            <td>$author</td>
                            <td></td>
                            <td>$tel</td>
                            <td>$date</td>
                            <td>$type</td>
                            <td>$sujet</td>
                            <td><a class='button2' href='./delete.php?id=$id&type=reservation'>Delete</a></td>
                        </tr>
                    ");
                }
            ?>
            </tbody>
        </table>
    </div>
</center>
</body>

</html>