<?php
require_once(RACINE . '-mvc/modele/connect.php');
require_once(RACINE . '-mvc/modele/modele.php');
require_once(RACINE . '-mvc/vue/vue.php');
########################################################################################################################
# Erreur (public, tous les C. Frontaux)                                                                                #
########################################################################################################################
function CtlErreur($messageErreur) {
    afficherErreur($messageErreur);
}

########################################################################################################################
# Initialisation des tableaux globaux                                                                                  #
########################################################################################################################
# Messages
$GLOBALS['messages'] = array();

# Formulaire HTML
$GLOBALS['form'] = array();
foreach ($_POST as $keyInput => $valInput) {
    $GLOBALS['form'][explode('_', $keyInput)[1]] = $valInput;
}

# Retours d'appels de fonctions du modèle
$GLOBALS['retoursModele'] = array();

########################################################################################################################
# Fonctions d'ajout dans les tableaux globaux (pour la lisibilité)                                                     #
########################################################################################################################
function ajouterMessage($code, $texte) {
    array_push($GLOBALS['messages'], [$code, htmlentities($texte, ENT_QUOTES, 'UTF-8')]);
}

function ajouterRetourModele($cle, $resultats) {
    $GLOBALS['retoursModele'][$cle] = $resultats;
}

########################################################################################################################
# Admin                                                                                                                #
########################################################################################################################
# Connexion
function CtlConnexion() {
    try {
        afficherConnexion();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherConnexion();
    }
}

function CtlVerifConnexion() {
    try {
        if (
            !empty($GLOBALS['form']['login']) &&
            !empty($GLOBALS['form']['mdp'])
        ) {
            $membre = MdlVerifConnexion($GLOBALS['form']['login'], $GLOBALS['form']['mdp']);
            if ($membre != false) {
                $_SESSION['membre'] = $membre;
                CtlMenu();
            } else {
                ajouterMessage(401, 'Login ou mot de passe invalide.');
                afficherConnexion();
            }
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            afficherConnexion();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherConnexion();
    }
}

# Menu
function CtlMenu() {
    try {
        afficherMenu();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherMenu();
    }
}

function CtlDeconnexion() {
    try {
        $_SESSION = array();
        if (isset($COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();
        ajouterMessage(200, 'Session déconnectée avec succès.');
        CtlConnexion();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        CtlConnexion();
    }
}

# Events
function CtlCreerEvent($executer) {
    try {
        if (!$executer) {
            afficherCreerEvent();
        } else {
            if (
                !empty($GLOBALS['form']['titre']) &&
                !empty($GLOBALS['form']['date']) &&
                (!empty($GLOBALS['form']['heureHeure']) || $GLOBALS['form']['heureHeure'] == 0) &&
                (!empty($GLOBALS['form']['heureMinute']) || $GLOBALS['form']['heureMinute'] == 0) &&
                !empty($GLOBALS['form']['lieu']) &&
                !empty($GLOBALS['form']['desc'])
            ) {
                MdlCreerEvent(
                    $GLOBALS['form']['titre'],
                    $GLOBALS['form']['date'],
                    $GLOBALS['form']['heureHeure'],
                    $GLOBALS['form']['heureMinute'],
                    $GLOBALS['form']['lieu'],
                    $GLOBALS['form']['desc']
                );
                afficherCreerEvent();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                afficherCreerEvent();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherCreerEvent();
    }
}

function CtlChoixEvent($executer) {
    try {
        if (!$executer) {
            MdlEventsTous('FP', true, true, NULL);
            afficherChoixEvent();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlEventPrecis($GLOBALS['form']['id']);
                afficherModifierEvent();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un évent.');
                MdlEventsTous('FP', true, true, NULL);
                afficherChoixEvent();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlEventsTous('FP', true, true, NULL);
        afficherChoixEvent();
    }
}

function CtlModifierEvent() {
    try {
        if (
            !empty($GLOBALS['form']['titre']) &&
            !empty($GLOBALS['form']['date']) &&
            (!empty($GLOBALS['form']['heureHeure']) || $GLOBALS['form']['heureHeure'] == 0) &&
            (!empty($GLOBALS['form']['heureMinute']) || $GLOBALS['form']['heureMinute'] == 0) &&
            !empty($GLOBALS['form']['lieu']) &&
            !empty($GLOBALS['form']['desc'])
        ) {
            MdlModifierEvent(
                $GLOBALS['form']['id'],
                $GLOBALS['form']['titre'],
                $GLOBALS['form']['date'],
                $GLOBALS['form']['heureHeure'],
                $GLOBALS['form']['heureMinute'],
                $GLOBALS['form']['lieu'],
                $GLOBALS['form']['desc']
            );
            MdlEventPrecis($GLOBALS['form']['id']);
            afficherModifierEvent();
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            MdlEventPrecis($GLOBALS['form']['id']);
            afficherModifierEvent();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlEventsTous('FP', true, true, NULL);
        afficherChoixEvent();
    }
}

function CtlSupprimerEvent($executer) {
    try {
        if (!$executer) {
            MdlEventsTous('FP', true, true, NULL);
            afficherSupprimerEvent();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlSupprimerEvent(
                    $GLOBALS['form']['id']
                );
                MdlEventsTous('FP', true, true, NULL);
                afficherSupprimerEvent();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un évent.');
                MdlEventsTous('FP', true, true, NULL);
                afficherSupprimerEvent();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlEventsTous('FP', true, true, NULL);
        afficherSupprimerEvent();
    }
}

# Goodies
function CtlAjouterGoodie($executer, $fileImput) {
    try {
        if (!$executer) {
            afficherAjouterGoodie();
        } else {
            if (
                !empty($GLOBALS['form']['titreGoodie']) &&
                (!empty($GLOBALS['form']['categorie']) || $GLOBALS['form']['categorie'] == 0) && $GLOBALS['form']['categorie'] != '-1' &&
                (!empty($GLOBALS['form']['prixADEuro']) || $GLOBALS['form']['prixADEuro'] == 0) &&
                (!empty($GLOBALS['form']['prixADCentimes']) || $GLOBALS['form']['prixADCentimes'] == 0) &&
                (!empty($GLOBALS['form']['prixNADEuro']) || $GLOBALS['form']['prixNADEuro'] == 0) &&
                (!empty($GLOBALS['form']['prixNADCentimes']) || $GLOBALS['form']['prixNADCentimes'] == 0) &&
                !empty($GLOBALS['form']['descGoodie']) &&
                !empty($_FILES[$fileImput]['name'])
            ) {
                MdlAjouterGoodie(
                    RACINE . 'goodies/',
                    $GLOBALS['form']['titreGoodie'],
                    $GLOBALS['form']['categorie'],
                    $GLOBALS['form']['prixADEuro'],
                    $GLOBALS['form']['prixADCentimes'],
                    $GLOBALS['form']['prixNADEuro'],
                    $GLOBALS['form']['prixNADCentimes'],
                    $GLOBALS['form']['descGoodie'],
                    $fileImput
                );
                afficherAjouterGoodie();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                afficherAjouterGoodie();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherAjouterGoodie();
    }
}

function CtlAjouterImageGoodie($executer, $fileImput) {
    try {
        if (!$executer) {
            MdlGoodiesTous('nom', true, true, true);
            afficherAjouterImageGoodie();
        } else {
            if (
                !empty($GLOBALS['form']['idGoodie']) &&
                !empty($_FILES[$fileImput]['name'])
            ) {
                MdlAjouterImageGoodie(RACINE . 'goodies/', $GLOBALS['form']['idGoodie'], $fileImput);
                MdlGoodiesTous('nom', true, true, true);
                afficherAjouterImageGoodie();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs et sélectionner une image.');
                MdlGoodiesTous('nom', true, true, true);
                afficherAjouterImageGoodie();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherAjouterImageGoodie();
    }
}

function CtlChoixGoodie($executer) {
    try {
        if (!$executer) {
            MdlGoodiesTous('nom', true, true, true);
            afficherChoixGoodie();
        } else {
            if (
            !empty($GLOBALS['form']['idGoodie'])
            ) {
                MdlGoodiePrecis($GLOBALS['form']['idGoodie']);
                afficherModifierGoodie();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un goodie.');
                MdlGoodiesTous('nom', true, true, true);
                afficherChoixGoodie();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherChoixGoodie();
    }
}

function CtlModifierGoodie() {
    try {
        if (
            !empty($GLOBALS['form']['titreGoodie']) &&
            (!empty($GLOBALS['form']['categorie']) || $GLOBALS['form']['categorie'] == 0) && $GLOBALS['form']['categorie'] != '-1' &&
            (!empty($GLOBALS['form']['prixADEuro']) || $GLOBALS['form']['prixADEuro'] == 0) &&
            (!empty($GLOBALS['form']['prixADCentimes']) || $GLOBALS['form']['prixADCentimes'] == 0) &&
            (!empty($GLOBALS['form']['prixNADEuro']) || $GLOBALS['form']['prixNADEuro'] == 0) &&
            (!empty($GLOBALS['form']['prixNADCentimes']) || $GLOBALS['form']['prixNADCentimes'] == 0) &&
            !empty($GLOBALS['form']['descGoodie'])
        ) {
            MdlModifierGoodie(
                $GLOBALS['form']['idGoodie'],
                $GLOBALS['form']['titreGoodie'],
                $GLOBALS['form']['categorie'],
                $GLOBALS['form']['prixADEuro'],
                $GLOBALS['form']['prixADCentimes'],
                $GLOBALS['form']['prixNADEuro'],
                $GLOBALS['form']['prixNADCentimes'],
                $GLOBALS['form']['descGoodie']
            );
            MdlGoodiePrecis($GLOBALS['form']['idGoodie']);
            afficherModifierGoodie();
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            MdlGoodiePrecis($GLOBALS['form']['idGoodie']);
            afficherModifierGoodie();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherChoixGoodie();
    }
}

function CtlAllerSupprimerImageGoodie() {
    try {
        foreach ($GLOBALS['form'] as $key => $value) {
            if ($value == 'on') {
                MdlSupprimerImageGoodie(RACINE . '/goodies/', $key, true);
            }
        }
        MdlImagesGoodie($GLOBALS['form']['idGoodie']);
        afficherSupprimerImageGoodie();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherChoixGoodie();
    }
}

function CtlSupprimerGoodie($executer) {
    try {
        if (!$executer) {
            MdlGoodiesTous('nom', true, true, true);
            afficherSupprimerGoodie();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlSupprimerGoodie(
                    RACINE . 'goodies/',
                    $GLOBALS['form']['id']
                );
                MdlGoodiesTous('nom', true, true, true);
                afficherSupprimerGoodie();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un goodie.');
                MdlGoodiesTous('nom', true, true, true);
                afficherSupprimerGoodie();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherSupprimerGoodie();
    }
}

# Journaux
function CtlAjouterJournal($executer, $fileImput) {
    try {
        if (!$executer) {
            afficherAjouterJournal();
        } else {
            if (
                !empty($GLOBALS['form']['titre']) &&
                !empty($GLOBALS['form']['mois']) &&
                !empty($GLOBALS['form']['annee']) &&
                !empty($_FILES[$fileImput]['name'])
            ) {
                MdlAjouterJournal(
                    RACINE . 'journaux/',
                    $GLOBALS['form']['titre'],
                    $GLOBALS['form']['mois'],
                    $GLOBALS['form']['annee'],
                    $fileImput
                );
                afficherAjouterJournal();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                afficherAjouterJournal();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherAjouterJournal();
    }
}

function CtlSupprimerJournal($executer) {
    try {
        if (!$executer) {
            MdlJournauxTous(NULL);
            afficherSupprimerJournal();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlSupprimerJournal(
                    RACINE . 'journaux/',
                    $GLOBALS['form']['id']
                );
                MdlJournauxTous(NULL);
                afficherSupprimerJournal();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un journal.');
                MdlJournauxTous(NULL);
                afficherSupprimerJournal();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlJournauxTous(NULL);
        afficherSupprimerJournal();
    }
}

# Articles
function CtlAjouterArticle($executer) {
    try {
        if (!$executer) {
            MdlCategoriesArticlesTous();
            afficherAjouterArticle();
        } else {
            if (
                !empty($GLOBALS['form']['titre']) &&
                $GLOBALS['form']['categorie'] != '-1' &&
                $GLOBALS['form']['visibilite'] != '-1' &&
                !empty($GLOBALS['form']['texte'])
            ) {
                MdlAjouterArticle(
                    $GLOBALS['form']['titre'],
                    $GLOBALS['form']['categorie'],
                    $GLOBALS['form']['visibilite'],
                    $GLOBALS['form']['texte']
                );
                MdlCategoriesArticlesTous();
                afficherAjouterArticle();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                MdlCategoriesArticlesTous();
                afficherAjouterArticle();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlCategoriesArticlesTous();
        afficherAjouterArticle();
    }
}

function CtlAjouterImageArticle($id, $fileImput) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id) && !empty($_FILES[$fileImput]['name'])) {
                $titre = MdlArticlePrecis($id)->titreArticles;
                MdlAjouterImageArticle(RACINE . 'articles/', $id, $titre, $fileImput);
                afficherAjouterImageArticle('L\'image a été ajoutée à l\'article ' . $titre . ' avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner une image.');
            }
        } catch (Exception $e) {
            afficherAjouterImageArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticle($executer) {
    try {
        if (!$executer) {
            MdlArticlesTous(true, true);
            afficherChoixArticle();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlArticlePrecis($GLOBALS['form']['id']);
                afficherModifierArticle();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un évent.');
                MdlArticlesTous(true, true);
                afficherChoixArticle();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlArticlesTous(true, true);
        afficherChoixArticle();
    }
}

function CtlModifierArticle() {
    try {
        if (
            !empty($GLOBALS['form']['titre']) &&
            $GLOBALS['form']['categorie'] != '-1' &&
            $GLOBALS['form']['visibilite'] != '-1' &&
            !empty($GLOBALS['form']['texte'])
        ) {
            MdlModifierArticle(
                $GLOBALS['form']['id'],
                $GLOBALS['form']['titre'],
                $GLOBALS['form']['categorie'],
                $GLOBALS['form']['visibilite'],
                $GLOBALS['form']['texte']
            );
            MdlArticlePrecis($GLOBALS['form']['id']);
            MdlCategoriesArticlesTous();
            afficherModifierArticle();
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            MdlArticlePrecis($GLOBALS['form']['id']);
            MdlCategoriesArticlesTous();
            afficherModifierArticle();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlArticlesTous();
        afficherChoixArticle();
    }
}

function CtlAllerSupprimerImageArticle($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherSupprimerImageArticle('', $id);
            } else {
                throw new Exception('Erreur : Identifiant invalide.');
            }
        } catch (Exception $e) {
            afficherModifierArticle($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticle($executer) {
    try {
        if (!$executer) {
            MdlArticlesTous();
            afficherSupprimerArticle();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlSupprimerArticle(
                    RACINE . 'articles/',
                    $GLOBALS['form']['id']
                );
                MdlArticlesTous();
                afficherSupprimerArticle();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un goodie.');
                MdlArticlesTous();
                afficherSupprimerArticle();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlArticlesTous();
        afficherSupprimerArticle();
    }
}

function CtlAjouterArticleVideo($executer) {
    try {
        if (!$executer) {
            MdlCategoriesArticlesTous();
            afficherAjouterArticleVideo();
        } else {
            if (
                !empty($GLOBALS['form']['titre']) &&
                $GLOBALS['form']['categorie'] != '-1' &&
                $GLOBALS['form']['visibilite'] != '-1' &&
                !empty($GLOBALS['form']['lien']) &&
                !empty($GLOBALS['form']['texte'])
            ) {
                MdlAjouterArticleVideo(
                    $GLOBALS['form']['titre'],
                    $GLOBALS['form']['categorie'],
                    $GLOBALS['form']['visibilite'],
                    $GLOBALS['form']['lien'],
                    $GLOBALS['form']['texte']
                );
                MdlCategoriesArticlesTous();
                afficherAjouterArticleVideo();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                MdlCategoriesArticlesTous();
                afficherAjouterArticleVideo();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlCategoriesArticlesTous();
        afficherAjouterArticleVideo();
    }
}

function CtlChoixArticleVideo($executer) {
    try {
        if (!$executer) {
            MdlArticlesVideoTous();
            afficherChoixArticleVideo();
        } else {
            if (
            !empty($GLOBALS['form']['id'])
            ) {
                MdlArticlePrecis($GLOBALS['form']['id']);
                afficherModifierArticleVideo();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un évent.');
                MdlArticlesVideoTous();
                afficherChoixArticleVideo();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlArticlesVideoTous();
        afficherChoixArticleVideo();
    }
}

function CtlModifierArticleVideo() {
    try {
        if (
            !empty($GLOBALS['form']['titre']) &&
            $GLOBALS['form']['categorie'] != '-1' &&
            $GLOBALS['form']['visibilite'] != '-1' &&
            !empty($GLOBALS['form']['lien']) &&
            !empty($GLOBALS['form']['texte'])
        ) {
            MdlModifierArticleVideo(
                $GLOBALS['form']['id'],
                $GLOBALS['form']['titre'],
                $GLOBALS['form']['categorie'],
                $GLOBALS['form']['visibilite'],
                $GLOBALS['form']['lien'],
                $GLOBALS['form']['texte']
            );
            MdlCategoriesArticlesTous();
            MdlArticleVideoPrecis($GLOBALS['form']['id']);
            afficherModifierArticleVideo();
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            MdlCategoriesArticlesTous();
            MdlArticleVideoPrecis($GLOBALS['form']['id']);
            afficherModifierArticleVideo();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlArticlesVideoTous();
        afficherChoixArticleVideo();
    }
}

function CtlSupprimerArticleVideo($executer) {
    try {
        if (!$executer) {
            MdlArticlesVideoTous();
            afficherSupprimerArticleVideo();
        } else {
            if (
                !empty($GLOBALS['form']['id'])
            ) {
                MdlSupprimerArticleVideo(
                    $GLOBALS['form']['id']
                );
                MdlArticlesVideoTous();
                afficherSupprimerArticleVideo();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un goodie.');
                MdlArticlesVideoTous();
                afficherSupprimerArticleVideo();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlArticlesVideoTous();
        afficherSupprimerArticleVideo();
    }
}

function CtlAjouterCategorieArticle($executer) {
    try {
        if (!$executer) {
            afficherAjouterCategorieArticle();
        } else {
            if (
                !empty($GLOBALS['form']['titre'])
            ) {
                MdlAjouterCategorieArticle(
                    $GLOBALS['form']['titre']
                );
                afficherAjouterCategorieArticle();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                afficherAjouterCategorieArticle();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherAjouterCategorieArticle();
    }
}

function CtlRenommerCategorieArticle($executer) {
    try {
        if (!$executer) {
            MdlCategoriesArticlesTous();
            afficherRenommerCategorieArticle();
        } else {
            if (
                !empty($GLOBALS['form']['id']) &&
                !empty($GLOBALS['form']['titre'])
            ) {
                MdlRenommerCategorieArticle(
                    $GLOBALS['form']['id'],
                    $GLOBALS['form']['titre']
                );
                MdlCategoriesArticlesTous();
                afficherRenommerCategorieArticle();
            } else {
                ajouterMessage(400, 'Veuillez remplir tous les champs.');
                MdlCategoriesArticlesTous();
                afficherRenommerCategorieArticle();
            }
        }

    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlCategoriesArticlesTous();
        afficherRenommerCategorieArticle();
    }
}

# Log
function CtlAfficherLog() {
    try {
        MdlLogTous();
        afficherAfficherLog();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherAfficherLog();
    }
}

########################################################################################################################
# Admin - Inscription                                                                                                  #
########################################################################################################################
function CtlInscription() {
    afficherInscription();
}

function CtlSInscrire() {
    try {
        if (
            !empty($GLOBALS['form']['cleInscription']) &&
            !empty($GLOBALS['form']['prenom']) &&
            !empty($GLOBALS['form']['nom']) &&
            !empty($GLOBALS['form']['login']) &&
            !empty($GLOBALS['form']['mdp'])
        ) {
            if (MdlCleExiste($GLOBALS['form']['cleInscription'])) { // Si trouvée, alors elle est détruite.
                MdlAjouterMembre(
                    $GLOBALS['form']['prenom'],
                    $GLOBALS['form']['nom'],
                    $GLOBALS['form']['login'],
                    $GLOBALS['form']['mdp']
                );
                afficherInscription();
            } else {
                ajouterMessage(402, 'La clé d\'inscription saisie n\'existe pas.');
                afficherInscription();
            }
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            afficherInscription();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherInscription();
    }
}

########################################################################################################################
# Accueil                                                                                                              #
########################################################################################################################
function CtlAccueil() {
    afficherAccueil();
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function CtlArticles() {
    afficherArticles();
}

function CtlArticlePrecis($id) {
    if ($id >= 0) {
        $article = MdlArticlePrecis($id);
        if ($article != false) {
            afficherArticlePrecis($article);
        } else {
            throw new Exception('L\'article recherché n\'existe pas.');
        }
    } else {
        $article = MdlArticleVideoPrecis(-$id);
        if ($article != false) {
            afficherArticleVideoPrecis($article);
        } else {
            throw new Exception('L\'article vidéo recherché n\'existe pas.');
        }
    }
}

########################################################################################################################
# Association (Présentation)                                                                                           #
########################################################################################################################
function CtlPresentation() {
    afficherPresentation();
}

########################################################################################################################
# Association - Contact                                                                                                #
########################################################################################################################
function CtlContact() {
    afficherContact();
}

########################################################################################################################
# Association - Fonctionnement                                                                                         #
########################################################################################################################
function CtlFonctionnement() {
    afficherFonctionnement();
}

########################################################################################################################
# Association - Fonctionnement - Statuts                                                                               #
########################################################################################################################
function CtlStatuts() {
    afficherStatuts();
}

########################################################################################################################
# Association - Historique                                                                                             #
########################################################################################################################
function CtlHistorique() {
    afficherHistorique();
}

########################################################################################################################
# Association - Où nous trouver ?                                                                                      #
########################################################################################################################
function CtlOuNousTrouver() {
    afficherOuNousTrouver();
}

########################################################################################################################
# Association - Partenaires                                                                                            #
########################################################################################################################
function CtlPartenaires() {
    afficherPartenaires();
}

########################################################################################################################
# Association - Pôles                                                                                                  #
########################################################################################################################
function CtlPoles() {
    afficherPoles();
}

########################################################################################################################
# Association - Pourquoi adhérer ?                                                                                     #
########################################################################################################################
function CtlPourquoiAdherer() {
    afficherPourquoiAdherer();
}

########################################################################################################################
# Association - Réseau associatif                                                                                      #
########################################################################################################################
function CtlReseauAssociatif() {
    afficherReseauAssociatif();
}

########################################################################################################################
# Association - Réseau associatif - ÔCampus                                                                            #
########################################################################################################################
function CtlOCampus() {
    afficherOCampus();
}

########################################################################################################################
# Association - Réseau associatif - FNEB                                                                               #
########################################################################################################################
function CtlFneb() {
    afficherFneb();
}

########################################################################################################################
# Association - Réseaus sociaux                                                                                        #
########################################################################################################################
function CtlReseauxSociaux() {
    afficherReseauxSociaux();
}

########################################################################################################################
# Association - Université                                                                                             #
########################################################################################################################
function CtlUniversite() {
    afficherUniversite();
}

########################################################################################################################
# Events                                                                                                               #
########################################################################################################################
function CtlEvents($tri, $aVenir, $passes, $rechercheEnCours) {
    afficherEvents($tri, $aVenir, $passes, $rechercheEnCours);
}

function CtlEventPrecis($id) {
    $event = MdlEventPrecis($id);
    if ($event != false) {
        afficherEventPrecis($event);
    } else {
        throw new Exception('L\'évent recherché n\'existe pas.');
    }
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function CtlGoodies($tri, $disponible, $bientot, $rupture,$rechercheEnCours) {
    afficherGoodies($tri, $disponible, $bientot, $rupture,$rechercheEnCours);
}

function CtlGoodiePrecis($id) {
    $goodie = MdlGoodiePrecis($id);
    if (!empty($goodie)) {
        afficherGoodiePrecis($goodie);
    } else {
        throw new Exception("Le goodie recherché n'existe pas.");
    }
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function CtlJournaux() {
    afficherJournaux();
}

########################################################################################################################
# Mentions légales                                                                                                     #
########################################################################################################################
function CtlMentionsLegales() {
    afficherMentionsLegales();
}

########################################################################################################################
# Plan du site                                                                                                         #
########################################################################################################################
function CtlPlanDuSite() {
    afficherPlanDuSite();
}

########################################################################################################################
# Riad (temporaire)                                                                                                    #
########################################################################################################################
function CtlRiad() {
    afficherRiad();
}