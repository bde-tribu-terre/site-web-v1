<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    if (isset($_POST['formInscription_inscription'])) {
        CtlSInscrire();
    } else {
        CtlInscription();
    }
} catch (Exception $e) {
    ajouterMessage(500, $e->getMessage());
    CtlInscription();
}