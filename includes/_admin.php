<?php  ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <title>Admin Console</title>
</head>
<body>
<?php include 'includes/_header.php'; ?>
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