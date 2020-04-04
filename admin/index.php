<?php
// /!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
// /!\                                                                                                               /!\
// /!\ CETTE PAGE EST GÉRÉE PAR LE MVC ADMIN                                                                         /!\
// /!\                                                                                                               /!\
// /!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
if (strlen(session_id()) < 1) session_start();
require_once('../-mvc-admin/controleur/controleur.php');
try {
    // Gabarit Connexion
    if (isset($_POST['formConnexion_seConnecter'])) {
        CtlVerifConnexion(
            $_POST['formConnexion_login'],
            $_POST['formConnexion_mdp']
        );
    }
    // Gabarit Créer Évent
    elseif (isset($_POST['formCreerEvent_ajouter'])) {
        CtlCreerEvent(
            $_POST['formCreerEvent_titre'],
            $_POST['formCreerEvent_date'],
            $_POST['formCreerEvent_heureHeure'],
            $_POST['formCreerEvent_heureMinute'],
            $_POST['formCreerEvent_lieu'],
            $_POST['formCreerEvent_desc']
        );
    }
    // Gabarit Choix Évent
    elseif (isset($_POST['formChoisirEvent_choisir'])) {
        CtlChoixEvent(
            $_POST['formChoisirEvent_idEvent']
        );
    }
    // Gabarit Modifier Évent
    elseif (isset($_POST['formModifierEvent_modifierEvent'])) {
        CtlModifierEvent(
            $_POST['formModifierEvent_idEvent'],
            $_POST['formModifierEvent_titre'],
            $_POST['formModifierEvent_date'],
            $_POST['formModifierEvent_heureHeure'],
            $_POST['formModifierEvent_heureMinute'],
            $_POST['formModifierEvent_lieu'],
            $_POST['formModifierEvent_desc']
        );
    }
    // Gabarit Supprimer Évent
    elseif (isset($_POST['formSupprimerEvent_supprimer'])) {
        CtlSupprimerEvent(
            $_POST['formSupprimerEvent_idEvent']
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
    elseif (isset($_POST['formModifierGoodie_modifierGoodie'])) {
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
    } elseif (isset($_POST['formModifierGoodie_supprimerImages'])) {
        CtlAllerSupprimerImageGoodie(
            $_POST['formModifierGoodie_idGoodie']
        );
    }
    // Gabarit Supprimer Images Goodie
    elseif (isset($_POST['formSupprimerImageGoodie_supprimer'])) {
        foreach ($_POST as $key=>$value) {
            if ($value == 'on') {
                supprimerImageGoodie($key);
            }
        }
        CtlAllerSupprimerImageGoodie($_POST['formSupprimerImageGoodie_idGoodie']);
    }
    // Gabarit Supprimer Goodie
    elseif (isset($_POST['formSupprimerGoodie_supprimer'])) {
        CtlSupprimerGoodie(
            $_POST['formSupprimerGoodie_idGoodie']
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
    elseif (isset($_POST['formEvents_creerEventMenu'])) {
        CtlCreerEventMenu('');
    } elseif (isset($_POST['formEvents_modifierEventMenu'])) {
        CtlChoixEventMenu('');
    } elseif (isset($_POST['formEvents_supprimerEventMenu'])) {
        CtlSupprimerEventMenu('');
    } elseif (isset($_POST['formGoodies_ajouterGoodieMenu'])) {
        CtlAjouterGoodieMenu('');
    } elseif (isset($_POST['formGoodies_ajouterImageGoodieMenu'])) {
        CtlAjouterImageGoodieMenu('');
    } elseif (isset($_POST['formGoodies_ModifierGoodieMenu'])) {
        CtlChoixGoodieMenu('');
    } elseif (isset($_POST['formGoodies_SupprimerGoodieMenu'])) {
        CtlSupprimerGoodieMenu('');
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