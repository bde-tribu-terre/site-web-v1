<?php
if (strlen(session_id()) < 1) session_start();
$prefixe = '../';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    // Gabarit Connexion
    if (isset($_POST['formConnexion_seConnecter'])) {
        CtlVerifConnexion(
            $prefixe,
            $_POST['formConnexion_login'],
            $_POST['formConnexion_mdp']
        );
    }
    // Gabarit Créer Évent
    elseif (isset($_POST['formCreerEvent_ajouter'])) {
        CtlCreerEvent(
            $prefixe,
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
            $prefixe,
            $_POST['formChoisirEvent_idEvent']
        );
    }
    // Gabarit Modifier Évent
    elseif (isset($_POST['formModifierEvent_modifierEvent'])) {
        CtlModifierEvent(
            $prefixe,
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
            $prefixe,
            $_POST['formSupprimerEvent_idEvent']
        );
    }
    // Gabarit Ajouter Goodie
    elseif (isset($_POST['formAjouterGoodie_ajouterGoodie'])) {
        CtlAjouterGoodie(
            $prefixe,
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
            $prefixe,
            $_POST['formAjouterImageGoodie_idGoodie'],
            'formAjouterImageGoodie_image'
        );
    }
    // Gabarit Choix Goodie
    elseif (isset($_POST['formChoisirGoodie_choisir'])) {
        CtlChoixGoodie(
            $prefixe,
            $_POST['formChoisirGoodie_idGoodie']
        );
    }
    // Gabarit Modifier Goodie
    elseif (isset($_POST['formModifierGoodie_modifierGoodie'])) {
        CtlModifierGoodie(
            $prefixe,
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
            $prefixe,
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
        CtlAllerSupprimerImageGoodie(
            $prefixe,
            $_POST['formSupprimerImageGoodie_idGoodie']
        );
    }
    // Gabarit Supprimer Goodie
    elseif (isset($_POST['formSupprimerGoodie_supprimer'])) {
        CtlSupprimerGoodie(
            $prefixe,
            $_POST['formSupprimerGoodie_idGoodie']
        );
    }
    // Gabarit Ajouter Journal
    elseif (isset($_POST['formAjouterJournal_ajouterJournal'])) {
        CtlAjouterJournal(
            $prefixe,
            $_POST['formAjouterJournal_titreJournal'],
            $_POST['formAjouterJournal_moisJournal'],
            $_POST['formAjouterJournal_anneeJournal'],
            'formAjouterJournal_fichierPDF'
        );
    }
    // Gabarit Supprimer Journal
    elseif (isset($_POST['formSupprimerJournal_supprimer'])) {
        CtlSupprimerJournal(
            $prefixe,
            $_POST['formSupprimerJournal_idJournal']
        );
    }
    // Gabarit Menu
    elseif (isset($_POST['formEvents_creerEventMenu'])) {
        CtlCreerEventMenu($prefixe, '');
    } elseif (isset($_POST['formEvents_modifierEventMenu'])) {
        CtlChoixEventMenu($prefixe, '');
    } elseif (isset($_POST['formEvents_supprimerEventMenu'])) {
        CtlSupprimerEventMenu($prefixe, '');
    } elseif (isset($_POST['formGoodies_ajouterGoodieMenu'])) {
        CtlAjouterGoodieMenu($prefixe, '');
    } elseif (isset($_POST['formGoodies_ajouterImageGoodieMenu'])) {
        CtlAjouterImageGoodieMenu($prefixe, '');
    } elseif (isset($_POST['formGoodies_ModifierGoodieMenu'])) {
        CtlChoixGoodieMenu($prefixe, '');
    } elseif (isset($_POST['formGoodies_SupprimerGoodieMenu'])) {
        CtlSupprimerGoodieMenu($prefixe, '');
    } elseif (isset($_POST['formJournal_ajouterJournalMenu'])) {
        CtlAjouterJournalMenu($prefixe, '');
    } elseif (isset($_POST['formJournal_supprimerJournalMenu'])) {
        CtlSupprimerJournalMenu($prefixe, '');
    } elseif (isset($_POST['formDeconnexion_deconnexion'])) {
        CtlDeconnexion($prefixe, '');
    }
    // Globaux : apparaissent dans plusieurs gabarits
    elseif (isset($_POST['formRetourMenu_retourMenu'])) {
        CtlMenu($prefixe, '');
    }
    // Par défaut
    elseif (isset($_SESSION['id'])) { // On vient d'arriver sur le menu.
        CtlMenu($prefixe, '');
    } else { // On vient d'arriver sur la page.
        CtlConnexion($prefixe, '');
    }
} catch (Exception $e) {
    if (isset($_SESSION['id'])) {
        CtlMenuErreur($prefixe, $e->getMessage());
    } else {
        CtlConnexionErreur($prefixe, $e->getMessage());
    }
}