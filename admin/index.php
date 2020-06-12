<?php
if (strlen(session_id()) < 1) session_start();
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_SESSION['membre'])) { // Un membre est actuellement connecté.
    try {
        // Gabarit Créer Évent
        if (isset($_POST['formCreerEvent_ajouter'])) {
            CtlCreerEvent(true);
        } // Gabarit Choix Évent
        elseif (isset($_POST['formChoisirEvent_choisir'])) {
            CtlChoixEvent(true);
        } // Gabarit Modifier Évent
        elseif (isset($_POST['formModifierEvent_modifierEvent'])) {
            CtlModifierEvent();
        } // Gabarit Supprimer Évent
        elseif (isset($_POST['formSupprimerEvent_supprimer'])) {
            CtlSupprimerEvent(true);
        } // Gabarit Ajouter Goodie
        elseif (isset($_POST['formAjouterGoodie_ajouterGoodie'])) {
            CtlAjouterGoodie(true, 'formAjouterGoodie_miniature');
        } // Gabarit Ajouter Image Goodie
        elseif (isset($_POST['formAjouterImageGoodie_ajouter'])) {
            CtlAjouterImageGoodie(true, 'formAjouterImageGoodie_image');
        } // Gabarit Choix Goodie
        elseif (isset($_POST['formChoisirGoodie_choisir'])) {
            CtlChoixGoodie(true);
        } // Gabarit Modifier Goodie
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
        } // Gabarit Supprimer Images Goodie
        elseif (isset($_POST['formSupprimerImageGoodie_supprimer'])) {
            foreach ($_POST as $key => $value) {
                if ($value == 'on') {
                    MdlSupprimerImageGoodie(RACINE . '/goodies/', $key, true);
                }
            }
            CtlAllerSupprimerImageGoodie(
                $_POST['formSupprimerImageGoodie_idGoodie']
            );
        } // Gabarit Supprimer Goodie
        elseif (isset($_POST['formSupprimerGoodie_supprimer'])) {
            CtlSupprimerGoodie(
                $_POST['formSupprimerGoodie_idGoodie']
            );
        } // Gabarit Ajouter Journal
        elseif (isset($_POST['formAjouterJournal_ajouterJournal'])) {
            CtlAjouterJournal(
                $_POST['formAjouterJournal_titreJournal'],
                $_POST['formAjouterJournal_moisJournal'],
                $_POST['formAjouterJournal_anneeJournal'],
                'formAjouterJournal_fichierPDF'
            );
        } // Gabarit Supprimer Journal
        elseif (isset($_POST['formSupprimerJournal_supprimer'])) {
            CtlSupprimerJournal(
                $_POST['formSupprimerJournal_idJournal']
            );
        } // Gabarit Ajouter Article
        elseif (isset($_POST['formAjouterArticle_ajouter'])) {
            CtlAjouterArticle(
                $_POST['formAjouterArticle_titre'],
                $_POST['formAjouterArticle_categorie'],
                $_POST['formAjouterArticle_visibilite'],
                $_POST['formAjouterArticle_texte']
            );
        } // Gabarit Choix Article
        elseif (isset($_POST['formChoisirArticle_choisir'])) {
            CtlChoixArticle(
                $_POST['formChoisirArticle_idArticle']
            );
        } // Gabarit Modifier Article
        elseif (isset($_POST['formModifierArticle_modifier'])) {
            CtlModifierArticle(
                $_POST['formModifierArticle_idArticle'],
                $_POST['formModifierArticle_titre'],
                $_POST['formModifierArticle_categorie'],
                $_POST['formModifierArticle_visibilite'],
                $_POST['formModifierArticle_texte']
            );
        } elseif (isset($_POST['formModifierArticle_supprimerImages'])) {
            CtlAllerSupprimerImageArticle(
                $_POST['formModifierArticle_idArticle']
            );
        } // Gabarit Supprimer Images Article
        elseif (isset($_POST['formSupprimerImageArticle_supprimer'])) {
            foreach ($_POST as $key => $value) {
                if ($value == 'on') {
                    MdlSupprimerImageArticle(RACINE . 'articles/', $key, true);
                }
            }
            CtlAllerSupprimerImageArticle(
                $_POST['formSupprimerImageArticle_idArticle']
            );
        } // Gabarit Supprimer Article
        elseif (isset($_POST['formSupprimerArticle_supprimer'])) {
            CtlSupprimerArticle(
                $_POST['formSupprimerArticle_idArticle']
            );
        } // Gabarit Ajouter Image Article
        elseif (isset($_POST['formAjouterImageArticle_ajouter'])) {
            CtlAjouterImageArticle(
                $_POST['formAjouterImageArticle_idArticle'],
                'formAjouterImageArticle_image'
            );
        }// Gabarit Ajouter Article Video
        elseif (isset($_POST['formAjouterArticleVideo_ajouter'])) {
            CtlAjouterArticleVideo(
                $_POST['formAjouterArticleVideo_titre'],
                $_POST['formAjouterArticleVideo_categorie'],
                $_POST['formAjouterArticleVideo_visibilite'],
                $_POST['formAjouterArticleVideo_lien'],
                $_POST['formAjouterArticleVideo_texte']
            );
        } // Gabarit Choix Article Video
        elseif (isset($_POST['formChoisirArticleVideo_choisir'])) {
            CtlChoixArticleVideo(
                $_POST['formChoisirArticleVideo_idArticle']
            );
        } // Gabarit Modifier Article Video
        elseif (isset($_POST['formModifierArticleVideo_modifier'])) {
            CtlModifierArticleVideo(
                $_POST['formModifierArticleVideo_idArticle'],
                $_POST['formModifierArticleVideo_titre'],
                $_POST['formModifierArticleVideo_categorie'],
                $_POST['formModifierArticleVideo_visibilite'],
                $_POST['formModifierArticleVideo_lien'],
                $_POST['formModifierArticleVideo_texte']
            );
        } // Gabarit Supprimer Article Video
        elseif (isset($_POST['formSupprimerArticleVideo_supprimer'])) {
            CtlSupprimerArticleVideo(
                $_POST['formSupprimerArticleVideo_idArticle']
            );
        } // Gabarit Ajouter Catégorie Article
        elseif (isset($_POST['formAjouterCategorieArticle_ajouter'])) {
            CtlAjouterCategorieArticle(
                $_POST['formAjouterCategorieArticle_titre']
            );
        } // Gabarit Renommer Catégorie Article
        elseif (isset($_POST['formRenommerCategorieArticle_renommer'])) {
            CtlRenommerCategorieArticle(
                $_POST['formRenommerCategorieArticle_idCategorieArticle'],
                $_POST['formRenommerCategorieArticle_titre']
            );
        } // Gabarit Menu
        elseif (isset($_POST['formEvents_creerEventMenu'])) {
            CtlCreerEvent(false);
        } elseif (isset($_POST['formEvents_modifierEventMenu'])) {
            CtlChoixEvent(false);
        } elseif (isset($_POST['formEvents_supprimerEventMenu'])) {
            CtlSupprimerEvent(false);
        } elseif (isset($_POST['formGoodies_ajouterGoodieMenu'])) {
            CtlAjouterGoodie(false, NULL);
        } elseif (isset($_POST['formGoodies_ajouterImageGoodieMenu'])) {
            CtlAjouterImageGoodie(false, NULL);
        } elseif (isset($_POST['formGoodies_ModifierGoodieMenu'])) {
            CtlChoixGoodie(false);
        } elseif (isset($_POST['formGoodies_SupprimerGoodieMenu'])) {
            CtlSupprimerGoodieMenu('');
        } elseif (isset($_POST['formJournal_ajouterJournalMenu'])) {
            CtlAjouterJournalMenu('');
        } elseif (isset($_POST['formJournal_supprimerJournalMenu'])) {
            CtlSupprimerJournalMenu('');
        } elseif (isset($_POST['formArticles_ajouterArticleMenu'])) {
            CtlAjouterArticleMenu('');
        } elseif (isset($_POST['formArticles_ajouterImageArticleMenu'])) {
            CtlAjouterImageArticleMenu('');
        } elseif (isset($_POST['formArticles_modifierArticleMenu'])) {
            CtlChoixArticleMenu('');
        } elseif (isset($_POST['formArticles_supprimerArticleMenu'])) {
            CtlSupprimerArticleMenu('');
        } elseif (isset($_POST['formArticles_ajouterArticleVideoMenu'])) {
            CtlAjouterArticleVideoMenu('');
        } elseif (isset($_POST['formArticles_modifierArticleVideoMenu'])) {
            CtlChoixArticleVideoMenu('');
        } elseif (isset($_POST['formArticles_supprimerArticleVideoMenu'])) {
            CtlSupprimerArticleVideoMenu('');
        } elseif (isset($_POST['formArticles_ajouterCategorieArticleMenu'])) {
            CtlAjouterCategorieArticleMenu('');
        } elseif (isset($_POST['formArticles_renommerCategorieArticleMenu'])) {
            CtlRenommerCategorieArticleMenu('');
        } elseif (isset($_POST['formLog_afficherLog'])) {
            CtlAfficherLog();
        } elseif (isset($_POST['formDeconnexion_deconnexion'])) {
            CtlDeconnexion();
        } // Globaux : apparaissent dans plusieurs gabarits
        elseif (isset($_POST['formRetourMenu_retourMenu'])) {
            CtlMenu();
        } else {
            CtlMenu();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        CtlMenu();
    }
} else {
    try {
        // Gabarit Connexion
        if (isset($_POST['formConnexion_seConnecter'])) {
            CtlVerifConnexion();
        } elseif (isset($_POST)) {
            // Si on accède à admin.php suite à un formulaire POST, et qu'il n'y a pas de session, c'est que la session
            // a expiré.
            ajouterMessage(100, 'La session a expiré.');
            CtlConnexion();
        } else {
            CtlConnexion();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        CtlConnexion();
    }
}