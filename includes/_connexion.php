<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <title>Connexion</title>
</head>
<body>
<?php include 'includes/_header.php'; ?>
<main>
    <div class="signin-section vh-100 row-no-wrap bg-light">
        <div class="signin-main-container row-no-wrap w-90 h-90 m-auto bx-shad-light b-radius-2 box-shadow-light">
            <div class="signin-left-container col bg-alpine-blue bl-radius-2">
                <form action="../connexion.php" method="POST"
                      class="col-no-wrap align-items-center justify-content-center">
                    <div class="form-group w-70">
                        <label for="login">Identifiant</label>
                        <input class="no-border" id="login" name="login" type="text">
                    </div>
                    <div class="form-group w-70">
                        <label for="password">Mot de Passe</label>
                        <input class="no-border" id="password" name="password" type="password">
                    </div>
                    <div class="form-group w-70 align-items-center">
                        <button class="btn btn-md mb-05" type="submit" name="signin">Se connecter</button>
                        <a class="delta-green" href="../inscription.php">S'inscrire</a>
                    </div>
                </form>
            </div>
            <div class="signin-right-container col bg-delta-green br-radius-2">
                <h1 class="light m-auto">Connexion</h1>
            </div>
        </div>
    </div>
</main>
</body>
</html>