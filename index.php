<?php
# C'est l'accueil.
# Si un navigateur essaye d'accéder à un répertoire rep, il ira au fichier rep/index.php
$prefixe = './';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    CtlAccueil($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}