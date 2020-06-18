<?php

session_start();

// todo display error messages at right place
// todo enforce security of input (check mysqli real_escape_string)
// todo add regex fields validation (check preg_match)

if (isset($_POST["signup"])) {
    // Form Signup variables
    $firstName = htmlentities(trim($_POST["first-name"]));
    $lastName = htmlentities(trim($_POST["last-name"]));
    $login = htmlentities(trim($_POST["login"]));
    $password = htmlentities(trim($_POST["password"]));
    $passwordCheck = htmlentities(trim($_POST["password-check"]));

    if ($login && $lastName && $firstName && $password && $passwordCheck) {
        if ($password == $passwordCheck) {
            if (strlen($password) < 6 || strlen($password) > 10) {
                echo "Le mot de passe doit contenir  entre 6 et 10 caractères";
            } elseif (!$password || !$passwordCheck) {
                echo "Tu as oublié de renseigner un mot de passe";
            } else {
                include 'database_connection.php';

                $userExistCheckQry = "select `login` from `moduleconnexion`.`utilisateurs` where `login`='$login'";
                $userExistCheckQryExec = $db->query($userExistCheckQry);

                if ($userExistCheckQryExec->num_rows >= 1) {
                    echo "Cet identifiant est déjà utilisé.";
                } else {
                    // Encrypt password
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    // Insert data in DB
                    $userInsQry = "insert into moduleconnexion.utilisateurs (login, prenom, nom, password) VALUES ('$login', '$lastName', '$firstName', '$passwordHash')";
                    $userInsQryExec = $db->query($userInsQry);
                    $db->close();
                    session_destroy();
                    header('Location: connexion.php');
//                    echo '<script type="text/javascript"> window.location = "connexion.php"; </script> ';
                }
            }
        } else {
            echo "Les mots de passe ne correspondent pas";
        }
    } else {
        echo "Tout les champs n'ont pas été renseignés";
    }
}

if (!isset($_SESSION['user'])) {
    include 'includes/_inscription.php';
} elseif ($_SESSION['user']['login'] == 'admin') {
    header('Location: admin.php');
} else {
    header('Location: index.php');
}
