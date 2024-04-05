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
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Contenu</th>
                <th>Dernier Modificateur</th>
                <th>Date de Modification</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

                require '../../utils/mysql.php';
                $tbResult = selectAllFromTableOrderByOne("price", "id");
                foreach($tbResult as $result){
                    $id = $result['id'];
                    $title = $result['title'];
                    $category = $result['category'];
                    $content = $result['content'];
                    $publishTime = $result['publishTime'];
                    $publisher = $result['username'];
                    echo("
                        <tr>
                            <td>$title</td>
                            <td>$category</td>
                            <td>$content</td>
                            <td>$publisher</td>
                            <td>$publishTime</td>
                            <td><a class='button2' href='./edit.php?id=$id&type=price'>Edit</a><a class='button2' href='./delete.php?id=$id&type=price'>Delete</a></td>
                        </tr>
                    ");
                }
                echo("
                    <a class='button2' href='./add.php?type=price'>Add</a>
                ")
            ?>
            </tbody>
        </table>
    </div>
</center>
</body>

</html>