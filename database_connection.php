<?php

$db = new mysqli('localhost', 'root', '', 'moduleconnexion');
if ($db->connect_errno) {
    printf("Échec de la connexion : %s\n", $db->connect_error);
    exit("Un problème est survenue, veuillez contacter l'admnistrateur
                            et lui communiquer le numéro d'erreur suivant $db->connect_errno");
}
