<?php
const RACINE = '../';
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_GET['nom'])) {
    if (strtolower($_GET['nom']) == 'terre') {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . '/parrainage/final/');
        exit();
    }
    CtlTrouverUneSalleRecherche($_GET['nom']);
} else {
    CtlTrouverUneSalle();
}
