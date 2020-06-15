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
        CtlCreerEventExecuter();
    } elseif ( // Gabarit Choix Évent
        $form['_name'] == 'formChoisirEvent' &&
        $form['_submit'] == 'choisir'
    ) {
        CtlChoixEventExecuter();
    } elseif (isset($_POST['formModifierEvent_modifierEvent'])) { // Gabarit Modifier Évent
        CtlModifierEvent();
    } elseif (isset($_POST['formSupprimerEvent_supprimer'])) { // Gabarit Supprimer Évent
        CtlSupprimerEvent(true);
    } elseif (isset($_POST['formAjouterGoodie_ajouterGoodie'])) { // Gabarit Ajouter Goodie
        CtlAjouterGoodie(true, 'formAjouterGoodie_miniature');
    } elseif (isset($_POST['formAjouterImageGoodie_ajouter'])) { // Gabarit Ajouter Image Goodie
        CtlAjouterImageGoodie(true, 'formAjouterImageGoodie_image');
    } elseif (isset($_POST['formChoisirGoodie_choisir'])) { // Gabarit Choix Goodie
        CtlChoixGoodie(true);
    } elseif (isset($_POST['formModifierGoodie_modifierGoodie'])) { // Gabarit Modifier Goodie
        CtlModifierGoodie();
    } elseif (isset($_POST['formModifierGoodie_supprimerImages'])) {
        CtlAllerSupprimerImageGoodie();
    } elseif (isset($_POST['formSupprimerImageGoodie_supprimer'])) { // Gabarit Supprimer Images Goodie
        CtlAllerSupprimerImageGoodie();
    } elseif (isset($_POST['formSupprimerGoodie_supprimer'])) { // Gabarit Supprimer Goodie
        CtlSupprimerGoodie(true);
    } elseif (isset($_POST['formAjouterJournal_ajouterJournal'])) { // Gabarit Ajouter Journal
        CtlAjouterJournal(true, 'formAjouterJournal_fichierPDF');
    } elseif (isset($_POST['formSupprimerJournal_supprimer'])) {// Gabarit Supprimer Journal
        CtlSupprimerJournal(true);
    } elseif (isset($_POST['formAjouterArticle_ajouter'])) { // Gabarit Ajouter Article
        CtlAjouterArticle(true);
    } elseif (isset($_POST['formChoisirArticle_choisir'])) { // Gabarit Choix Article
        CtlChoixArticle(true);
    } elseif (isset($_POST['formModifierArticle_modifier'])) { // Gabarit Modifier Article
        CtlModifierArticle();
    } elseif (isset($_POST['formModifierArticle_supprimerImages'])) {
        CtlAllerSupprimerImageArticle();
    } elseif (isset($_POST['formSupprimerImageArticle_supprimer'])) { // Gabarit Supprimer Images Article
        CtlAllerSupprimerImageArticle();
    } elseif (isset($_POST['formSupprimerArticle_supprimer'])) { // Gabarit Supprimer Article
        CtlSupprimerArticle(true);
    } elseif (isset($_POST['formAjouterImageArticle_ajouter'])) { // Gabarit Ajouter Image Article
        CtlAjouterImageArticle(true, 'formAjouterImageArticle_image');
    } elseif (isset($_POST['formAjouterArticleVideo_ajouter'])) { // Gabarit Ajouter Article Video
        CtlAjouterArticleVideo(true);
    } elseif (isset($_POST['formChoisirArticleVideo_choisir'])) { // Gabarit Choix Article Video
        CtlChoixArticleVideo(true);
    } elseif (isset($_POST['formModifierArticleVideo_modifier'])) { // Gabarit Modifier Article Video
        CtlModifierArticleVideo();
    } elseif (isset($_POST['formSupprimerArticleVideo_supprimer'])) { // Gabarit Supprimer Article Video
        CtlSupprimerArticleVideo(true);
    } elseif (isset($_POST['formAjouterCategorieArticle_ajouter'])) { // Gabarit Ajouter Catégorie Article
        CtlAjouterCategorieArticle(true);
    } elseif (isset($_POST['formRenommerCategorieArticle_renommer'])) { // Gabarit Renommer Catégorie Article
        CtlRenommerCategorieArticle(true);
    } // Gabarit Menu
    elseif (isset($_POST['formEvents_creerEventMenu'])) {
        CtlCreerEvent();
    } elseif (isset($_POST['formEvents_modifierEventMenu'])) {
        CtlChoixEvent();
    } elseif (isset($_POST['formEvents_supprimerEventMenu'])) {
        CtlSupprimerEvent(false);
    } elseif (isset($_POST['formGoodies_ajouterGoodieMenu'])) {
        CtlAjouterGoodie(false, NULL);
    } elseif (isset($_POST['formGoodies_ajouterImageGoodieMenu'])) {
        CtlAjouterImageGoodie(false, NULL);
    } elseif (isset($_POST['formGoodies_ModifierGoodieMenu'])) {
        CtlChoixGoodie(false);
    } elseif (isset($_POST['formGoodies_SupprimerGoodieMenu'])) {
        CtlSupprimerGoodie(false);
    } elseif (isset($_POST['formJournal_ajouterJournalMenu'])) {
        CtlAjouterJournal(false, NULL);
    } elseif (isset($_POST['formJournal_supprimerJournalMenu'])) {
        CtlSupprimerJournal(false);
    } elseif (isset($_POST['formArticles_ajouterArticleMenu'])) {
        CtlAjouterArticle(false);
    } elseif (isset($_POST['formArticles_ajouterImageArticleMenu'])) {
        CtlAjouterImageArticle(false, NULL);
    } elseif (isset($_POST['formArticles_modifierArticleMenu'])) {
        CtlChoixArticle(false);
    } elseif (isset($_POST['formArticles_supprimerArticleMenu'])) {
        CtlSupprimerArticle(false);
    } elseif (isset($_POST['formArticles_ajouterArticleVideoMenu'])) {
        CtlAjouterArticleVideo(false);
    } elseif (isset($_POST['formArticles_modifierArticleVideoMenu'])) {
        CtlChoixArticleVideo(false);
    } elseif (isset($_POST['formArticles_supprimerArticleVideoMenu'])) {
        CtlSupprimerArticleVideo(false);
    } elseif (isset($_POST['formArticles_ajouterCategorieArticleMenu'])) {
        CtlAjouterCategorieArticle(false);
    } elseif (isset($_POST['formArticles_renommerCategorieArticleMenu'])) {
        CtlRenommerCategorieArticle(false);
    } elseif (isset($_POST['formLog_afficherLog'])) {
        CtlAfficherLog();
    } elseif ($form['_submit'] == 'deconnexion') {
        CtlDeconnexion();
    } // Globaux : apparaissent dans plusieurs gabarits
    elseif (isset($_POST['formRetourMenu_retourMenu'])) {
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
        CtlVerifConnexion();
    } elseif (isset($_POST)) {
        // Si on accède à admin.php suite à un formulaire POST, et qu'il n'y a pas de session, c'est que la session
        // a expiré.
        ajouterMessage(100, 'La session a expiré.');
        CtlConnexion();
    } else {
        CtlConnexion();
    }
}