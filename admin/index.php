<?php
if (strlen(session_id()) < 1) session_start();
define('RACINE', '../');
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
    } elseif ( // Gabarit Ajouter Article
        $form['_name'] == 'formAjouterArticle' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterArticleExecuter(
            $form['titre'],
            $form['categorie'],
            $form['visibilite'],
            $form['texte']
        );
    } elseif ( // Gabarit Ajouter Image Article
        $form['_name'] == 'formAjouterImageArticle' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterImageArticleExecuter(
            $form['id'],
            'formAjouterImageArticle_image'
        );
    } elseif ( // Gabarit Choix Article
        $form['_name'] == 'formChoisirArticle' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixArticleExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Modifier Article
        $form['_name'] == 'formModifierArticle' &&
        $form['_submit'] == 'modifier'
    ) {
        CtlModifierArticleExecuter(
            $form['id'],
            $form['titre'],
            $form['categorie'],
            $form['visibilite'],
            $form['texte']
        );
    } elseif (
        $form['_name'] == 'formModifierArticle' &&
        $form['_submit'] == 'supprimerImages'
    ) {
        CtlSupprimerImageArticle(
            $form['id']
        );
    } elseif ( // Gabarit Supprimer Images Article
        $form['_name'] == 'formSupprimerImageArticle' &&
        $form['_submit'] == 'supprimer'
    ) {
        $arrayIdImages = array();
        foreach ($form as $name => $value) {
            if (substr($name, 0, 5) == 'image' && $value = 'on') {
                array_push($arrayIdImages, substr($name, 5));
            }
        }
        CtlSupprimerImageArticleExecuter(
            $form['id'],
            $arrayIdImages
        );
    } elseif ( // Gabarit Supprimer Article
        $form['_name'] == 'formSupprimerArticle' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerArticleExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Ajouter Article Video
        $form['_name'] == 'formAjouterArticleVideo' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterArticleVideoExecuter(
            $form['titre'],
            $form['categorie'],
            $form['visibilite'],
            $form['lien'],
            $form['texte']
        );
    } elseif ( // Gabarit Choix Article Video
        $form['_name'] == 'formChoisirArticleVideo' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixArticleVideoExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Modifier Article Video
        $form['_name'] == 'formModifierArticleVideo' &&
        $form['_submit'] == 'modifier'
    ) {
        CtlModifierArticleVideoExecuter(
            $form['id'],
            $form['titre'],
            $form['categorie'],
            $form['visibilite'],
            $form['lien'],
            $form['texte']
        );
    } elseif ( // Gabarit Supprimer Article Video
        $form['_name'] == 'formSupprimerArticleVideo' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerArticleVideoExecuter(
            $form['id']
        );
    } elseif ( // Gabarit Ajouter Catégorie Article
        $form['_name'] == 'formAjouterCategorieArticle' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterCategorieArticleExecuter(
            $form['titre']
        );
    } elseif ( // Gabarit Renommer Catégorie Article
        $form['_name'] == 'formRenommerCategorieArticle' &&
        $form['_submit'] == 'renommer'
    ) {
        CtlRenommerCategorieArticleExecuter(
            $form['id'],
            $form['titre']
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
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterArticleMenu'
    ) {
        CtlAjouterArticle();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterImageArticleMenu'
    ) {
        CtlAjouterImageArticle();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'modifierArticleMenu'
    ) {
        CtlChoixArticle();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'supprimerArticleMenu'
    ) {
        CtlSupprimerArticle();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterArticleVideoMenu'
    ) {
        CtlAjouterArticleVideo();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'modifierArticleVideoMenu'
    ) {
        CtlChoixArticleVideo();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'supprimerArticleVideoMenu'
    ) {
        CtlSupprimerArticleVideo();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterCategorieArticleMenu'
    ) {
        CtlAjouterCategorieArticle();
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'renommerCategorieArticleMenu'
    ) {
        CtlRenommerCategorieArticle();
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
