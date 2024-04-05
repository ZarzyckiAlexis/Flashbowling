<header>    
    <div class="container">
        <nav>
            <div class="container-navbar">
                
                <?php 
                    if(basename($_SERVER['PHP_SELF']) == "dashboard.php"){
                        echo(' 
                            <a href="../index.php" class="nothing"><h1>Flash<span class="orange">Bowling</span></h1></a>
                            <span class="mobile"><a href="./user.php" class="fas fa-user navbar-user"></a></span>
                            <label for="mobile"><span class="fas fa-bars navbar-bars"></span></label>
                            <input type="checkbox" id="mobile" role="button">
                            <ul>
                                <li><a href="./admin/dashboard_utilisateurs.php">Afficher les utilisateurs</a></li>
                                <li><a href="./admin/dashboard_annonces.php">Gérer les annonces</a></li>
                                <li><a href="./admin/dashboard_prix.php">Gérer les prix</a></li>
                                <li><a href="./admin/dashboard_reservation.php">Gérer les réservations</a></li>
                                <li><a href="../utils/logout.php">Se déconnecter</a></li>
                            </ul>
                        ');
                    } else {
                        echo(' 
                            <a href="../../index.php" class="nothing"><h1>Flash<span class="orange">Bowling</span></h1></a>
                            <span class="mobile"><a href="./user.php" class="fas fa-user navbar-user"></a></span>
                            <label for="mobile"><span class="fas fa-bars navbar-bars"></span></label>
                            <input type="checkbox" id="mobile" role="button">
                            <ul>
                                <li><a href="./dashboard_utilisateurs.php">Afficher les utilisateurs</a></li>
                                <li><a href="./dashboard_annonces.php">Gérer les annonces</a></li>
                                <li><a href="./dashboard_prix.php">Gérer les prix</a></li>
                                <li><a href="./dashboard_reservation.php">Gérer les réservations</a></li>
                                <li><a href="../../utils/logout.php">Se déconnecter</a></li>
                            </ul>
                        ');
                    }
                ?>
            </div>
        </nav>
    </div>
</header>