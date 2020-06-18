<header>
    <nav class="col-no-wrap">
        <div class="navbar z-10">
            <ul class="d-flex align-items-center ml-1">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../connexion.php">Connexion</a></li>
                    <li><a href="../inscription.php">Inscription</a></li>
                <?php elseif ($_SESSION['user']['login'] == 'admin') : ?>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../admin.php">Admin</a></li>
                    <li><a href="../profil.php">Profil</a></li>
                    <li><a href="../logout.php">Deconnexion</a></li>
                <?php else : ?>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../profil.php">Profil</a></li>
                    <li><a href="../logout.php">Deconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
</header>