<?php

session_start();

// Check manual user acces
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

// Session variables from $_SESSION['user'] array
$ssId = $_SESSION['user']['id'];
$ssLogin = $_SESSION['user']['login'];
$ssFirstname = $_SESSION['user']['nom'];
$ssLastname = $_SESSION['user']['prenom'];
$ssPassword = $_SESSION['user']['password'];

// var_dump($_SESSION['user']);

if (isset($_POST["submit"])) {
    // Form Submit variables from $_POST request
    $firstName = htmlentities(trim($_POST["first-name"]));
    $lastName = htmlentities(trim($_POST["last-name"]));
    $login = htmlentities(trim($_POST["login"]));
    $password = htmlentities(trim($_POST["password"]));
    $passwordCheck = htmlentities(trim($_POST["password-check"]));

    include 'database_connection.php';

    $userExistCheckQry = "select `id`, `login`, `prenom`, `nom`, `password` from `moduleconnexion`.`utilisateurs` where `id`='$ssId'";
    $userExistCheckQryExec = $db->query($userExistCheckQry);

    if ($userExistCheckQryExec->num_rows == 1) {
        if ($login) {
            $userLoginUpdQry = "update `moduleconnexion`.`utilisateurs` set `login`='$login'where `id`='$ssId'";
            $userLoginUpdQryExec = $db->query($userLoginUpdQry);
        }
        if ($lastName) {
            $userLnameUpdQry = "update `moduleconnexion`.`utilisateurs` set `prenom`='$lastName' where `id`='$ssId'";
            $userLnameUpdQryExec = $db->query($userLnameUpdQry);
        }
        if ($firstName) {
            $userFnameUpdQry = "update `moduleconnexion`.`utilisateurs` set `nom`='$firstName' where `id`='$ssId'";
            $userFnameUpdQryExec = $db->query($userFnameUpdQry);
        }
        if ($password) {
            if (($password && $passwordCheck)) {
                if ($password == $passwordCheck) {
                    if (strlen($password) < 6 || strlen($password) > 10) {
                        echo "Le mot de passe doit contenir  entre 6 et 10 caractères";
                    } elseif (!$password || !$passwordCheck) {
                        echo "Tu as oublié de renseigner un mot de passe";
                    }
                } else {
                    echo "Les mots de passe ne correspondent pas";
                }
            }
            $userPwdUpdQry = "update `moduleconnexion`.`utilisateurs` set `password`='$password' where `id`='$ssId'";
            $userPwdUpdQryExec = $db->query($userPwdUpdQry);
        } else {
            echo "Aucune information n'a été modifiée";
        }
    }

    $userExistUpdQry = "select `id`, `login`, `prenom`, `nom`, `password` from `moduleconnexion`.`utilisateurs` where `id`='$ssId'";
    $userExistUpdQryExec = $db->query($userExistUpdQry);
    $userExistFetchUpdQryExec = $userExistUpdQryExec->fetch_assoc();

    $_SESSION['user'] = $userExistFetchUpdQryExec;

    $db->close();
    echo '<script type="text/javascript"> window.location = "profil.php"; </script> ';

}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/styles/main.css">
    <link rel="stylesheet" href="src/styles/navbar.css">
    <title>Profil</title>
</head>
<body>
<?php include '_header.php'; ?>
<main>
    <div class="profile-section vh-100 row-no-wrap bg-light">
        <div class="profile-main-container row-no-wrap w-90 h-90 m-auto bx-shad-light b-radius-2 box-shadow-light">
            <div class="profile-left-container col bg-delta-green bl-radius-2">
                <h1 class="light m-auto">Profil</h1>
            </div>
            <div class="profile-right-container col bg-alpine-blue br-radius-2">
                <form action="profil.php" method="POST" class="col-no-wrap align-items-center justify-content-center">
                    <div class="form-group w-70">
                        <label for="first-name">Nom</label>
                        <input class="no-border" id="first-name" name="first-name" type="text"
                               placeholder="<?= $ssFirstname; ?>">
                    </div>
                    <div class="form-group w-70">
                        <label for="last-name">Prénom</label>
                        <input class="no-border" id="last-name" name="last-name" type="text"
                               placeholder="<?= $ssLastname; ?>">
                    </div>
                    <div class="form-group w-70">
                        <label for="login">Identifiant</label>
                        <input class="no-border" id="login" name="login" type="text" placeholder="<?= $ssLogin; ?>">
                    </div>
                    <div class="form-group w-70">
                        <label for="password">Mot de Passe</label>
                        <input class="no-border" id="password" name="password" type="password"
                               placeholder="······">
                    </div>
                    <div class="form-group w-70">
                        <label for="password-check">Confirmation Mot de Passe</label>
                        <input class="no-border" id="password-check" name="password-check" type="password"
                               placeholder="̣̣̣······">
                    </div>
                    <div class="form-group w-70 align-items-center">
                        <button class="btn btn-md mb-05" type="submit" name="submit">Valider</button>
                        <a class="delta-green" href="logout.php">Se deconnecter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>