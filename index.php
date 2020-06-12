<?php session_start(); ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/styles/main.css">
    <link rel="stylesheet" href="src/styles/navbar.css">
    <title>Accueil</title>
</head>
<body>
<?php if (isset($_SESSION['user']['login'])) :
    include '_header.php'; ?>
<?php endif; ?>
<main>
    <div class="bg-sand vh-100">
        <?php if (!isset($_SESSION['user']['login'])) : ?>
            <div class="col-no-wrap m-auto text-center justify-content-center">
                <h1 class="m-1">Hello, Apparamment tu n'es pas encore connecté(e) ou tu n'as pas encore créé(e) ton
                    compte</h1>
                <p class="m-1">C'est par ici que ça se passe</p>
                <div class="d-flex-row justify-content-center">
                    <a href="connexion.php">
                        <button class="btn btn-md m-1" type="submit" name="signin">Se Connecter</button>
                    </a>
                    <a href="inscription.php">
                        <button class="btn btn-md m-1" type="submit" name="signup">S'inscrire</button>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <div class="col-no-wrap m-auto text-center justify-content-center">
                <h1 class="m-1">Hello, <?= $_SESSION ['user']['login']; ?> </h1>
                <p>Apparament tu es bien connecté(e), tu peux maintenant naviguer sur le site même si tu vas vite faire
                    le
                    tour. Tu pourras modifier ton profil et... c'est tout</p>
            </div>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
