<?php
if (strlen(session_id()) < 1) session_start();
require_once('./controleur/controleur.php');
try {
    if (isset($_POST['formConnexion_seConnecter'])) {
        CtlVerifConnexion(
            $_POST['formConnexion_login'],
            $_POST['formConnexion_mdp']
        );
    } else { // On vient d'arriver sur la page sans n'avoir rien cliqué.
        CtlConnexion('');
    }
} catch (Exception $e) {
    if (isset($_SESSION['id'])) {
        CtlMenuErreur($e->getMessage());
    } else {
        CtlConnexionErreur($e->getMessage());
    }
}