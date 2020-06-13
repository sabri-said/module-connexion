<?php

session_start();

if (isset($_SESSION['user']) && $_SESSION['user']['login'] == 'admin') {
    include 'database_connection.php';

    // Mysql Queries
    $userShowSelectQry = "SELECT `nom`, `prenom`, `login` FROM `moduleconnexion`.`utilisateurs`";
    $userShowSelectQryExec = $db->query($userShowSelectQry);
    $userShowFields = $userShowSelectQryExec->fetch_fields();
    $userShowInfo = $userShowSelectQryExec->fetch_all();
} elseif (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
} else {
    header('Location: index.php');
    exit();
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
    <title>Admin Console</title>
</head>
<body>
<?php include '_header.php'; ?>
<main>
    <table class="w-70 mx-auto mt-2">
        <thead>
        <tr>
            <?php foreach ($userShowFields as $fieldname) : ?>
                <th class="upcase">
                    <?= $fieldname->name ?>
                </th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userShowInfo as $userShowInfoResult) : ?>
            <tr class="text-center">
                <?php
                for ($i = 0; $i < $userShowSelectQryExec->field_count; ++$i) {
                    echo "<td class='p-1'>$userShowInfoResult[$i]</td>";
                }
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>