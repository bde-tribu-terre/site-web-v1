<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    if (isset($_POST['formInscription_inscription'])) {
        CtlSInscrire(
            $_POST['formInscription_cleInscription'],
            $_POST['formInscription_prenom'],
            $_POST['formInscription_nom'],
            $_POST['formInscription_login'],
            $_POST['formInscription_mdp']
        );
    } else {
        CtlInscription();
    }
} catch (Exception $e) {
    ajouterMessage(500, $e->getMessage());
    CtlInscription();
}