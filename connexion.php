<?php

session_start();

// todo make better integration of HTML/PHP
// todo display error messages at right place
// todo add regex fields validation (check preg_match) or filter_var (e.g VALIDATE_EMAIL for email)
// todo compare password with password hash (check password_verify method)

if (isset($_POST["signin"])) {
    // Form login variables
    $login = htmlentities(trim($_POST["login"]));
    $password = htmlentities(trim($_POST["password"]));

    if ($login && $password) {
        include 'database_connection.php';

        $userExistCheckQry = "select `id`, `login`, `prenom`, `nom`, `password` from `moduleconnexion`.`utilisateurs` where `login`='$login' and `password`='$password'";
        $userExistCheckQryExec = $db->query($userExistCheckQry);

        if ($userExistCheckQryExec->num_rows == 0) {
            echo "L'utilisateur et/ou le mot de passe est erronée";
        } elseif ($userExistCheckQryExec->num_rows == 1) {
//            $userSetckie = setcookie('user', $login);
//            $_COOKIE['user'] = $login;

            $userExistFetchQryExec = $userExistCheckQryExec->fetch_assoc();
            $_SESSION['user'] = $userExistFetchQryExec;

            $db->close();
        }
    } elseif (!$login || !$password) {
        echo "Tout les champs n'ont pas été renseignés";
    }
}

if (!isset($_SESSION['user'])) {
    include '_connexion.php';
} elseif ($_SESSION['user']['login'] == 'admin') {
    header('Location: admin.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
