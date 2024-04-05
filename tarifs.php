<!DOCTYPE html>
<html lang="fr">

    <!--
        Author : Alexis Zarzycki
    -->

    <head>
        <title>FlashBowling - Tarifs</title>
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

    <div class="container">
            <div class="container-tarifs">
            <h1>Nos Tarifs</h1>
            <?php
                require './utils/mysql.php';
                $tbResult = selectAllFromTableOrderByOne("price", "category");
                $lastcategory = 0;
                foreach($tbResult as $result){  
                    $title = $result['title'];
                    $content = $result['content'];
                    $category = $result['category'];
                    $publishTime = $result['publishTime'];
                    $publisher = $result['username'];
                    if (strcmp($lastcategory, $category) == 0){
                        echo("
                            <div class='container-tarifs'>
                                <div class='container-tarifs-semaine'> 
                                    <h2>$title</h2>
                                    <p>$content</p>
                                    <p>Dernière modification par $publisher le $publishTime</p>
                                </div>
                            </div>
                        ");
                    }
                    else {
                        echo("
                            <div class='container-tarifs'>
                                <h2 class='bowling'>$category</h2>
                                <div class='container-tarifs-semaine'> 
                                    <h2>$title</h2>
                                    <p>$content</p>
                                    <p>Dernière modification par $publisher le $publishTime</p>
                                </div>
                            </div>
                        ");
                        $lastcategory = $category;
                    }
                  }
                ?>
            </div>
            <?php require './utils/footer.php'?>
        </div>
    </body>
</html>