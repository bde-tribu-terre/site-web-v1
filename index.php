<?php
define('RACINE', './');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlAccueil();
} catch (Exception $e) {
    ajouterMessage(500, $e->getMessage());
    try {
        CtlAccueil();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        CtlErreur();
    }
}