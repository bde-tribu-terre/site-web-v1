<?php
if (strlen(session_id()) < 1) session_start();
const RACINE = '../';
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_SESSION['membre'])) { // Un membre est actuellement connecté.
    if ( // Gabarit Créer Évent
        $form['_name'] == 'formCreerEvent' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlCreerEventExecuter(
            $form['titre'],
            $form['date'],
            $form['heureHeure'],
            $form['heureMinute'],
            $form['lieu'],
            $form['desc']
        );
    } elseif ( // Gabarit Choix Évent
        $form['_name'] == 'formChoisirEvent' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixEventExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Modifier Évent
        $form['_name'] == 'formModifierEvent' &&
        $form['_submit'] == 'modifierEvent'
    ) {
        CtlModifierEventExecuter(
            $form['id'],
            $form['titre'],
            $form['date'],
            $form['heureHeure'],
            $form['heureMinute'],
            $form['lieu'],
            $form['desc']
        );
    } elseif ( // Gabarit Supprimer Évent
        $form['_name'] == 'formSupprimerEvent' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerEventExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Ajouter Goodie
        $form['_name'] == 'formAjouterGoodie' &&
        $form['_submit'] == 'ajouterGoodie'
    ) {
        CtlAjouterGoodieExecuter(
            $form['titre'],
            $form['categorie'],
            $form['prixADEuro'],
            $form['prixADCentimes'],
            $form['prixNADEuro'],
            $form['prixNADCentimes'],
            $form['desc'],
            'formAjouterGoodie_miniature'
        );
    } elseif ( // Gabarit Ajouter Image Goodie
        $form['_name'] == 'formAjouterImageGoodie' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterImageGoodieExecuter(
            $form['id'],
            'formAjouterImageGoodie_image'
        );
    } elseif ( // Gabarit Choix Goodie
        $form['_name'] == 'formChoisirGoodie' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixGoodieExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Modifier Goodie
        $form['_name'] == 'formModifierGoodie' &&
        $form['_submit'] == 'modifierGoodie'
    ) {
        CtlModifierGoodieExecuter(
            $form['id'],
            $form['titre'],
            $form['categorie'],
            $form['prixADEuro'],
            $form['prixADCentimes'],
            $form['prixNADEuro'],
            $form['prixNADCentimes'],
            $form['desc']
        );
    } elseif (
        $form['_name'] == 'formModifierGoodie' &&
        $form['_submit'] == 'supprimerImages'
    ) {
        CtlSupprimerImageGoodie(
            $form['id']
        );
    } elseif ( // Gabarit Supprimer Images Goodie
        $form['_name'] == 'formSupprimerImageGoodie' &&
        $form['_submit'] == 'supprimer'
    ) {
        $arrayIdImages = array();
        foreach ($form as $name => $value) {
            if (substr($name, 0, 5) == 'image' && $value = 'on') {
                array_push($arrayIdImages, substr($name, 5));
            }
        }
        CtlSupprimerImageGoodieExecuter(
            $form['id'],
            $arrayIdImages
        );
    } elseif ( // Gabarit Supprimer Goodie
        $form['_name'] == 'formSupprimerGoodie' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerGoodieExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Ajouter Journal
        $form['_name'] == 'formAjouterJournal' &&
        $form['_submit'] == 'ajouterJournal'
    ) {
        CtlAjouterJournalExecuter(
            $form['titre'],
            $form['mois'],
            $form['annee'],
            'formAjouterJournal_fichierPDF'
        );
    } elseif ( // Gabarit Supprimer Journal
        $form['_name'] == 'formSupprimerJournal' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerJournalExecuter(
            $form['id']
        );
    }  elseif ( // Gabarit Ajouter Lien Pratique
        $form['_name'] == 'formAjouterLienPratique' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterLienPratiqueExecuter(
            $form['titre'],
            $form['url']
        );
    } elseif ( // Gabarit Supprimer Lien Pratique
        $form['_name'] == 'formSupprimerLienPratique' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerLienPratiqueExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Menu
        $form['_name'] == 'formEvents' &&
        $form['_submit'] == 'creerEventMenu'
    ) {
        CtlCreerEvent();
    } elseif (
        $form['_name'] == 'formEvents' &&
        $form['_submit'] == 'modifierEventMenu'
    ) {
        CtlChoixEvent();
    } elseif (
        $form['_name'] == 'formEvents' &&
        $form['_submit'] == 'supprimerEventMenu'
    ) {
        CtlSupprimerEvent();
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'ajouterGoodieMenu'
    ) {
        CtlAjouterGoodie();
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'ajouterImageGoodieMenu'
    ) {
        CtlAjouterImageGoodie();
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'modifierGoodieMenu'
    ) {
        CtlChoixGoodie();
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'supprimerGoodieMenu'
    ) {
        CtlSupprimerGoodie();
    } elseif (
        $form['_name'] == 'formJournal' &&
        $form['_submit'] == 'ajouterJournalMenu'
    ) {
        CtlAjouterJournal();
    } elseif (
        $form['_name'] == 'formJournal' &&
        $form['_submit'] == 'supprimerJournalMenu'
    ) {
        CtlSupprimerJournal();
    } elseif (
        $form['_name'] == 'formLiensPratiques' &&
        $form['_submit'] == 'ajouterLienPratiqueMenu'
    ) {
        CtlAjouterLienPratique();
    } elseif (
        $form['_name'] == 'formLiensPratiques' &&
        $form['_submit'] == 'supprimerLienPratiqueMenu'
    ) {
        CtlSupprimerLienPratique();
    } elseif (
        $form['_name'] == 'formLog' &&
        $form['_submit'] == 'afficherLog'
    ) {
        CtlLog();
    } elseif (
        $form['_name'] == 'formDeconnexion' &&
        $form['_submit'] == 'deconnexion'
    ) {
        CtlDeconnexion();
    } // Globaux : apparaissent dans plusieurs gabarits
    elseif (
        $form['_name'] == 'formRetourMenu' &&
        $form['_submit'] == 'retourMenu'
    ) {
        CtlMenu();
    } else { // Si aucun formulaire d'envoyé...
        CtlMenu();
    }
} else {
    // Gabarit Connexion
    if (
        $form['_name'] == 'formConnexion' &&
        $form['_submit'] == 'seConnecter'
    ) {
        CtlVerifConnexion(
            $form['login'],
            $form['mdp']
        );
    } elseif (isset($_POST)) {
        // Si on accède à admin.php suite à un formulaire POST, et qu'il n'y a pas de session, c'est que la session
        // a expiré.
        ajouterMessage(100, 'La session a expiré.');
        CtlConnexion();
    } else {
        CtlConnexion();
    }
}
