<?php

session_start();

// Session variables from $_SESSION['user'] array
$ssId = $_SESSION['user']['id'];
$ssLogin = $_SESSION['user']['login'];
$ssFirstname = $_SESSION['user']['nom'];
$ssLastname = $_SESSION['user']['prenom'];

// Check user access
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
} else {
    include 'includes/_profil.php';
}

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
