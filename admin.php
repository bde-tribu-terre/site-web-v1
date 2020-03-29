<?php
// /!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
// /!\                                                                                                               /!\
// /!\ CETTE PAGE EST GÉRÉE PAR LE MVC ADMIN                                                                         /!\
// /!\                                                                                                               /!\
// /!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
if (strlen(session_id()) < 1) session_start();
require_once('./mvcadmin/controleur/controleur.php');
try {
    // Gabarit Connexion
    if (isset($_POST['formConnexion_seConnecter'])) {
        CtlVerifConnexion(
            $_POST['formConnexion_login'],
            $_POST['formConnexion_mdp']
        );
    }
    // Gabarit Ajouter Goodie
    elseif (isset($_POST['formAjouterGoodie_ajouterGoodie'])) {
        CtlAjouterGoodie(
            $_POST['formAjouterGoodie_titreGoodie'],
            $_POST['formAjouterGoodie_categorie'],
            $_POST['formAjouterGoodie_prixAdhérentEuro'],
            $_POST['formAjouterGoodie_prixAdhérentCentimes'],
            $_POST['formAjouterGoodie_prixNonAdhérentEuro'],
            $_POST['formAjouterGoodie_prixNonAdhérentCentimes'],
            $_POST['formAjouterGoodie_descGoodie'],
            'formAjouterGoodie_miniature'
        );
    }
    // Gabarit Ajouter Image Goodie
    elseif (isset($_POST['formAjouterImageGoodie_ajouter'])) {
        CtlAjouterImageGoodie(
            $_POST['formAjouterImageGoodie_idGoodie'],
            'formAjouterImageGoodie_image'
        );
    }
    // Gabarit Choix Goodie
    elseif (isset($_POST['formChoisirGoodie_choisir'])) {
        CtlChoixGoodie(
            $_POST['formChoisirGoodie_idGoodie']
        );
    }
    // Gabarit Modifier Goodie
    elseif (isset($_POST['formModifierGoodie_modifier'])) {
        CtlModifierGoodie(
            $_POST['formModifierGoodie_idGoodie'],
            $_POST['formModifierGoodie_titreGoodie'],
            $_POST['formModifierGoodie_categorie'],
            $_POST['formModifierGoodie_prixAdhérentEuro'],
            $_POST['formModifierGoodie_prixAdhérentCentimes'],
            $_POST['formModifierGoodie_prixNonAdhérentEuro'],
            $_POST['formModifierGoodie_prixNonAdhérentCentimes'],
            $_POST['formModifierGoodie_descGoodie']
        );
    }
    // Gabarit Ajouter Journal
    elseif (isset($_POST['formAjouterJournal_ajouterJournal'])) {
        CtlAjouterJournal(
            $_POST['formAjouterJournal_titreJournal'],
            $_POST['formAjouterJournal_moisJournal'],
            $_POST['formAjouterJournal_anneeJournal'],
            'formAjouterJournal_fichierPDF'
        );
    }
    // Gabarit Supprimer Journal
    elseif (isset($_POST['formSupprimerJournal_supprimer'])) {
        CtlSupprimerJournal(
            $_POST['formSupprimerJournal_idJournal']
        );
    }
    // Gabarit Menu
    elseif (isset($_POST['formGoodies_ajouterGoodieMenu'])) {
        CtlAjouterGoodieMenu('');
    } elseif (isset($_POST['formGoodies_ajouterImageGoodieMenu'])) {
        CtlAjouterImageGoodieMenu('');
    } elseif (isset($_POST['formGoodies_ModifierGoodieMenu'])) {
        CtlChoixGoodieMenu('');
    } elseif (isset($_POST['formJournal_ajouterJournalMenu'])) {
        CtlAjouterJournalMenu('');
    } elseif (isset($_POST['formJournal_supprimerJournalMenu'])) {
        CtlSupprimerJournalMenu('');
    } elseif (isset($_POST['formMonCompte_parametres'])) {
        CtlParametresCompte('');
    } elseif (isset($_POST['formDeconnexion_deconnexion'])) {
        CtlDeconnexion('');
    }
    // Globaux : apparaissent dans plusieurs gabarits
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