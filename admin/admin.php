<?php
if (strlen(session_id()) < 1) session_start();
require_once('./controleur/controleur.php');
try {
    // Gabarit Connexion
    if (isset($_POST['formConnexion_seConnecter'])) {
        CtlVerifConnexion(
            $_POST['formConnexion_login'],
            $_POST['formConnexion_mdp']
        );
    }
    // Gabarit Menu
    elseif (isset($_POST['formMonCompte_parametres'])) {
        CtlParametresCompte('');
    } elseif (isset($_POST['formDeconnexion_deconnexion'])) {
        CtlDeconnexion('');
    }
    // Gabarit Paramètres Compte
    elseif (isset($_POST['formRetourMenu_retourMenu'])) {
        CtlMenu('');
    }
    // Par défaut
    elseif (isset($_SESSION['id'])) { // On vient d'arriver sur le menu.
        CtlMenu('');
    } else { // On vient d'arriver sur la page.
        CtlConnexion('');
    }
} catch (Exception $e) {
    if (isset($_SESSION['id'])) {
        CtlMenuErreur($e->getMessage());
    } else {
        CtlConnexionErreur($e->getMessage());
    }
}