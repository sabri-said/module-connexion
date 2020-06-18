<?php

session_start();

// todo display error messages at right place
// todo add regex fields validation (check preg_match) or filter_var (e.g VALIDATE_EMAIL for email)

if (isset($_POST["signin"])) {
    // Form login variables
    $login = htmlentities(trim($_POST["login"]));
    $password = htmlentities(trim($_POST["password"]));

    if ($login && $password) {
        include 'database_connection.php';

        // Get hashed password in DB
        $userPwdHashCheck = "select `password` from `moduleconnexion`.`utilisateurs` where `login`='$login'";
        $userPwdHashCheckExec = $db->query($userPwdHashCheck);
        $userPwdHashFetch = $userPwdHashCheckExec->fetch_assoc();
        $userPwdHash = $userPwdHashFetch['password'];
        $userPwdValid = password_verify($password, $userPwdHash);

        if ($userPwdValid) {
            $userExistCheckQry = "select * from `moduleconnexion`.`utilisateurs` where `login`='$login' and `password`='$userPwdHash'";
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
        }
    } elseif (!$login || !$password) {
        echo "Tout les champs n'ont pas été renseignés";
    }
}

if (!isset($_SESSION['user'])) {
    include 'includes/_connexion.php';
} elseif ($_SESSION['user']['login'] == 'admin') {
    header('Location: admin.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
