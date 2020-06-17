<?php
if (strlen(session_id()) < 1) session_start();
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
ajouterMessage(0, print_r($form, true));
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
        CtlChoixEventExecuter();
    } elseif ( // Gabarit Modifier Évent
        $form['_name'] == 'formModifierEvent' &&
        $form['_submit'] == 'modifierEvent'
    ) {
        CtlModifierEvent();
    } elseif ( // Gabarit Supprimer Évent
        $form['_name'] == 'formSupprimerEvent' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerEvent(true);
    } elseif ( // Gabarit Ajouter Goodie
        $form['_name'] == 'formAjouterGoodie' &&
        $form['_submit'] == 'ajouterGoodie'
    ) {
        CtlAjouterGoodie(true, 'formAjouterGoodie_miniature');
    } elseif ( // Gabarit Ajouter Image Goodie
        $form['_name'] == 'formAjouterImageGoodie' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterImageGoodie(true, 'formAjouterImageGoodie_image');
    } elseif ( // Gabarit Choix Goodie
        $form['_name'] == 'formChoisirGoodie' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixGoodie(true);
    } elseif ( // Gabarit Modifier Goodie
        $form['_name'] == 'formModifierGoodie' &&
        $form['_submit'] == 'modifierGoodie'
    ) {
        CtlModifierGoodie();
    } elseif (
        $form['_name'] == 'formModifierGoodie' &&
        $form['_submit'] == 'supprimerImages'
    ) {
        CtlAllerSupprimerImageGoodie();
    } elseif ( // Gabarit Supprimer Images Goodie
        $form['_name'] == 'formSupprimerImageGoodie' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlAllerSupprimerImageGoodie();
    } elseif ( // Gabarit Supprimer Goodie
        $form['_name'] == 'formSupprimerGoodie' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerGoodie(true);
    } elseif ( // Gabarit Ajouter Journal
        $form['_name'] == 'formAjouterJournal' &&
        $form['_submit'] == 'ajouterJournal'
    ) {
        CtlAjouterJournal(true, 'formAjouterJournal_fichierPDF');
    } elseif ( // Gabarit Supprimer Journal
        $form['_name'] == 'formSupprimerJournal' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerJournal(true);
    } elseif ( // Gabarit Ajouter Article
        $form['_name'] == 'formAjouterArticle' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterArticle(true);
    } elseif ( // Gabarit Choix Article
        $form['_name'] == 'formChoisirArticle' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixArticle(true);
    } elseif ( // Gabarit Modifier Article
        $form['_name'] == 'formModifierArticle' &&
        $form['_submit'] == 'modifier'
    ) {
        CtlModifierArticle();
    } elseif (
        $form['_name'] == 'formModifierArticle' &&
        $form['_submit'] == 'supprimerImages'
    ) {
        CtlAllerSupprimerImageArticle();
    } elseif ( // Gabarit Supprimer Images Article
        $form['_name'] == 'formSupprimerImageArticle' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlAllerSupprimerImageArticle();
    } elseif ( // Gabarit Supprimer Article
        $form['_name'] == 'formSupprimerArticle' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerArticle(true);
    } elseif ( // Gabarit Ajouter Image Article
        $form['_name'] == 'formAjouterImageArticle' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterImageArticle(true, 'formAjouterImageArticle_image');
    } elseif ( // Gabarit Ajouter Article Video
        $form['_name'] == 'formAjouterArticleVideo' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterArticleVideo(true);
    } elseif ( // Gabarit Choix Article Video
        $form['_name'] == 'formChoisirArticleVideo' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixArticleVideo(true);
    } elseif ( // Gabarit Modifier Article Video
        $form['_name'] == 'formModifierArticleVideo' &&
        $form['_submit'] == 'modifier'
    ) {
        CtlModifierArticleVideo();
    } elseif ( // Gabarit Supprimer Article Video
        $form['_name'] == 'formSupprimerArticleVideo' &&
        $form['_submit'] == 'supprimer'
    ) {
        CtlSupprimerArticleVideo(true);
    } elseif ( // Gabarit Ajouter Catégorie Article
        $form['_name'] == 'formAjouterCategorieArticle' &&
        $form['_submit'] == 'ajouter'
    ) {
        CtlAjouterCategorieArticle(true);
    } elseif ( // Gabarit Renommer Catégorie Article
        $form['_name'] == 'formRenommerCategorieArticle' &&
        $form['_submit'] == 'renommer'
    ) {
        CtlRenommerCategorieArticle(true);
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
        CtlSupprimerEvent(false);
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'ajouterGoodieMenu'
    ) {
        CtlAjouterGoodie(false, NULL);
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'ajouterImageGoodieMenu'
    ) {
        CtlAjouterImageGoodie(false, NULL);
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'modifierGoodieMenu'
    ) {
        CtlChoixGoodie(false);
    } elseif (
        $form['_name'] == 'formGoodies' &&
        $form['_submit'] == 'supprimerGoodieMenu'
    ) {
        CtlSupprimerGoodie(false);
    } elseif (
        $form['_name'] == 'formJournal' &&
        $form['_submit'] == 'ajouterJournalMenu'
    ) {
        CtlAjouterJournal(false, NULL);
    } elseif (
        $form['_name'] == 'formJournal' &&
        $form['_submit'] == 'supprimerJournalMenu'
    ) {
        CtlSupprimerJournal(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterArticleMenu'
    ) {
        CtlAjouterArticle(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterImageArticleMenu'
    ) {
        CtlAjouterImageArticle(false, NULL);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'modifierArticleMenu'
    ) {
        CtlChoixArticle(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'supprimerArticleMenu'
    ) {
        CtlSupprimerArticle(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterArticleVideoMenu'
    ) {
        CtlAjouterArticleVideo(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'modifierArticleVideoMenu'
    ) {
        CtlChoixArticleVideo(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'supprimerArticleVideoMenu'
    ) {
        CtlSupprimerArticleVideo(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'ajouterCategorieArticleMenu'
    ) {
        CtlAjouterCategorieArticle(false);
    } elseif (
        $form['_name'] == 'formArticles' &&
        $form['_submit'] == 'renommerCategorieArticleMenu'
    ) {
        CtlRenommerCategorieArticle(false);
    } elseif (
        $form['_name'] == 'formLog' &&
        $form['_submit'] == 'afficherLog'
    ) {
        CtlAfficherLog();
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