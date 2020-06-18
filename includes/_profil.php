<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <title>Profil</title>
</head>
<body>
<?php
include 'includes/_header.php'; ?>
<main>
    <div class="profile-section vh-100 row-no-wrap bg-light">
        <div class="profile-main-container row-no-wrap w-90 h-90 m-auto bx-shad-light b-radius-2 box-shadow-light">
            <div class="profile-left-container col bg-delta-green bl-radius-2">
                <h1 class="light m-auto">Profil</h1>
            </div>
            <div class="profile-right-container col bg-alpine-blue br-radius-2">
                <form action="../profil.php" method="POST" class="col-no-wrap align-items-center justify-content-center">
                    <div class="form-group w-70">
                        <label for="first-name">Nom</label>
                        <input class="no-border" id="first-name" name="first-name" type="text"
                               value="<?= $ssFirstname; ?>">
                    </div>
                    <div class="form-group w-70">
                        <label for="last-name">Prénom</label>
                        <input class="no-border" id="last-name" name="last-name" type="text"
                               value="<?= $ssLastname; ?>">
                    </div>
                    <div class="form-group w-70">
                        <label for="login">Identifiant</label>
                        <input class="no-border" id="login" name="login" type="text" value="<?= $ssLogin; ?>">
                    </div>
                    <div class="form-group w-70">
                        <label for="password">Mot de Passe</label>
                        <input class="no-border" id="password" name="password" type="password"
                               value="······">
                    </div>
                    <div class="form-group w-70">
                        <label for="password-check">Confirmation Mot de Passe</label>
                        <input class="no-border" id="password-check" name="password-check" type="password"
                               value="......">
                    </div>
                    <div class="form-group w-70 align-items-center">
                        <button class="btn btn-md mb-05" type="submit" name="submit">Valider</button>
                        <a class="delta-green" href="../logout.php">Se deconnecter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>