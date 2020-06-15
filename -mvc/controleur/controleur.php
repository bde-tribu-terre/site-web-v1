<?php
require_once(RACINE . '-mvc/modele/connect.php');
require_once(RACINE . '-mvc/modele/modele.php');
require_once(RACINE . '-mvc/vue/vue.php');
########################################################################################################################
# Erreur (public, tous les C. Frontaux)                                                                                #
########################################################################################################################
function CtlErreur() {
    afficherErreur();
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
    afficherConnexion();
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
                throw new Exception('Login ou mot de passe invalide.', 401);
            }
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        afficherConnexion();
    }
}

# Menu
function CtlMenu() {
    afficherMenu();
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
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez sélectionner un évent.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez sélectionner un évent.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs et sélectionner une image.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez sélectionner un goodie.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherChoixGoodie();
    }
}

function CtlAllerSupprimerImageGoodie() {
    try {
        foreach ($GLOBALS['form'] as $key => $value) {
            if ($value == 'on') {
                MdlSupprimerImageGoodie(RACINE . 'goodies/', $key, true);
            }
        }
        MdlImagesGoodie($GLOBALS['form']['idGoodie']);
        afficherSupprimerImageGoodie();
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez sélectionner un goodie.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez sélectionner un journal.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlCategoriesArticlesTous();
        afficherAjouterArticle();
    }
}

function CtlAjouterImageArticle($executer, $fileImput) {
    try {
        if (!$executer) {
            MdlArticlesTous(true, true);
            afficherAjouterImageArticle();
        } else {
            if (
                !empty($GLOBALS['form']['id']) &&
                !empty($_FILES[$fileImput]['name'])
            ) {
                MdlAjouterImageArticle(
                    RACINE . 'articles/',
                    $GLOBALS['form']['id'],
                    $fileImput);
                MdlArticlesTous(true, true);
                afficherAjouterImageArticle();
            } else {
                throw new Exception('Veuillez remplir tous les champs et sélectionner une image.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlArticlesTous(true, true);
        afficherAjouterImageArticle();
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
                MdlCategoriesArticlesTous();
                afficherModifierArticle();
            } else {
                throw new Exception('Veuillez sélectionner un évent.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlArticlesTous();
        afficherChoixArticle();
    }
}

function CtlAllerSupprimerImageArticle() {
    try {
        foreach ($GLOBALS['form'] as $key => $value) {
            if ($value == 'on') {
                MdlSupprimerImageArticle(RACINE . 'articles/', $key, true);
            }
        }
        MdlImagesArticle($GLOBALS['form']['id'], NULL);
        afficherSupprimerImageArticle();
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlGoodiesTous('nom', true, true, true);
        afficherChoixGoodie();
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
                throw new Exception('Veuillez sélectionner un article.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                MdlArticleVideoPrecis($GLOBALS['form']['id']);
                MdlCategoriesArticlesTous();
                afficherModifierArticleVideo();
            } else {
                throw new Exception('Veuillez sélectionner un article.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }

    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
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
        ajouterMessage($e->getCode(), $e->getMessage());
        afficherAfficherLog();
    }
}

########################################################################################################################
# Admin - Inscription                                                                                                  #
########################################################################################################################
function CtlInscription($executer) {
    try {
        if (!$executer) {
            afficherInscription();
        } else {
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
                    throw new Exception('La clé d\'inscription saisie n\'existe pas.', 402);
                }
            } else {
                throw new Exception('Veuillez remplir tous les champs.', 400);
            }
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        afficherInscription();
    }
}

########################################################################################################################
# Accueil                                                                                                              #
########################################################################################################################
function CtlAccueil() {
    MdlGoodiesTous('', true, false, false);
    MdlEventsTous('PF', true, false, 3);
    MdlJournauxTous(2);
    MdlDernierArticleTexteVideo(true, false);
    afficherAccueil();
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function CtlArticles($id = NULL) {
    try {
        if ($id) {
            switch (substr($id, 0, 1)) {
                case 'T':
                    MdlArticlePrecis(substr($id, 1));
                    if ($GLOBALS['retoursModele']['article']) {
                        MdlImagesArticle(substr($id, 1), NULL);
                        afficherArticlePrecis();
                    } else {
                        throw new Exception('L\'article recherché n\'existe pas.', 404);
                    }
                    break;
                case 'V':
                    MdlArticleVideoPrecis(substr($id, 1));
                    if ($GLOBALS['retoursModele']['articleVideo']) {
                        afficherArticleVideoPrecis();
                    } else {
                        throw new Exception('L\'article vidéo recherché n\'existe pas.', 404);
                    }
                    break;
                default:
                    throw new Exception('L\'adresse d\'article recherché est invalide.', 403);
            }
        } else {
            MdlArticlesTous(true, false);
            MdlMiniaturesArticles(true, false);
            MdlArticlesVideoTous(true, false);
            MdlMiniaturesArticlesVideo(true, false);
            afficherArticles();
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlArticlesTous(true, false);
        MdlMiniaturesArticles(true, false);
        MdlArticlesVideoTous(true, false);
        MdlMiniaturesArticlesVideo(true, false);
        afficherArticles();
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
function CtlEvents($id, $tri, $aVenir, $passes, $rechercheEnCours) {
    try {
        if ($id) {
            MdlEventPrecis($id);
            if ($GLOBALS['retoursModele']['event']) {
                afficherEventPrecis();
            } else {
                throw new Exception('L\'évent recherché n\'existe pas.', 404);
            }
        } else {
            MdlEventsTous($tri, $aVenir, $passes, NULL);
            afficherEvents($rechercheEnCours);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        MdlEventsTous($tri, $aVenir, $passes, NULL);
        afficherEvents($rechercheEnCours);
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
    MdlJournauxTous(NULL);
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