<?php

session_start();

if (isset($_SESSION['user']['login']) == 'admin') {
    include 'database_connection.php';

    // Mysql Queries
    $userShowSelectQry = "SELECT `nom`, `prenom`, `login` FROM `moduleconnexion`.`utilisateurs`";
    $userShowSelectQryExec = $db->query($userShowSelectQry);
    $userShowFields = $userShowSelectQryExec->fetch_fields();
    $userShowInfo = $userShowSelectQryExec->fetch_all();

    include 'includes/_admin.php';
} elseif (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
