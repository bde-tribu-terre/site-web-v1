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

# Retours d'appels de fonctions du modèle
$GLOBALS['retoursModele'] = array();

########################################################################################################################
# Initialisation du tableau formulaire                                                                                 #
########################################################################################################################
$form = array();
foreach ($_POST as $keyInput => $valInput) {
    $arrayInput = explode('_', $keyInput);
    if (isset($form['_name']) && $form['_name'] != $arrayInput[0]) {
        ajouterMessage(502, 'Attention : la convention d\'attribut "name" des inputs n\'est pas respectée.');
    } else {
        $form['_name'] = $arrayInput[0];
    }
    if (isset($arrayInput[2]) && $arrayInput[2] == 'submit') {
        $form['_submit'] = $arrayInput['1'];
    } else {
        $form[explode('_', $keyInput)[1]] = $valInput;
    }
}
if (count($form) == 0) {
    $form['_name'] = NULL;
    $form['_submit'] = NULL;
}

########################################################################################################################
# DEBUG pour pendant le développement                                                                                  #
# /!\ Tout ce qui suit doit être en commentaire dans la version finale du site /!\                                     #
########################################################################################################################
# Visualisation du formulaire POST
ajouterMessage(0, print_r($form, true));

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

function CtlVerifConnexion($login, $mdp) {
    try {
        if (
            !empty($login) &&
            !empty($mdp)
        ) {
            $membre = MdlVerifConnexion($login, $mdp);
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
        CtlConnexion();
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
function CtlCreerEvent() {
    afficherCreerEvent();
}

function CtlCreerEventExecuter($titre, $date, $heureHeure, $minuteHeure, $lieu, $desc) {
    try {
        if (
            !empty($titre) &&
            !empty($date) &&
            (!empty($heureHeure) || $heureHeure == 0) &&
            (!empty($minuteHeure) || $minuteHeure == 0) &&
            !empty($lieu) &&
            !empty($desc)
        ) {
            MdlCreerEvent(
                $titre,
                $date,
                $heureHeure,
                $minuteHeure,
                $lieu,
                $desc
            );
            CtlCreerEvent();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlCreerEvent();
    }
}

function CtlChoixEvent() {
    MdlEventsTous('FP', true, true, NULL);
    afficherChoixEvent();
}

function CtlChoixEventExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            CtlModifierEvent($id);
        } else {
            throw new Exception('Veuillez sélectionner un évent.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlChoixEvent();
    }
}

function CtlModifierEvent($id) {
    MdlEventPrecis($id);
    afficherModifierEvent();
}

function CtlModifierEventExecuter($id, $titre, $date, $heureHeure, $heureMinute, $lieu, $desc) {
    try {
        if (
            !empty($titre) &&
            !empty($date) &&
            (!empty($heureHeure) || $heureHeure == 0) &&
            (!empty($heureMinute) || $heureMinute == 0) &&
            !empty($lieu) &&
            !empty($desc)
        ) {
            MdlModifierEvent(
                $id,
                $titre,
                $date,
                $heureHeure,
                $heureMinute,
                $lieu,
                $desc
            );
            CtlModifierEvent($id);
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlModifierEvent($id);
    }
}

function CtlSupprimerEvent() {
    MdlEventsTous('FP', true, true, NULL);
    afficherSupprimerEvent();
}

function CtlSupprimerEventExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            MdlSupprimerEvent(
                $id
            );
            CtlSupprimerEvent();
        } else {
            throw new Exception('Veuillez sélectionner un évent.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerEvent();
    }
}

# Goodies
function CtlAjouterGoodie() {
    afficherAjouterGoodie();
}

function CtlAjouterGoodieExecuter($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    try {
        if (
            !empty($titre) &&
            (!empty($categorie) || $categorie == 0) && $categorie != '-1' &&
            (!empty($prixADEuro) || $prixADEuro == 0) &&
            (!empty($prixADCentimes) || $prixADCentimes == 0) &&
            (!empty($prixNADEuro) || $prixNADEuro == 0) &&
            (!empty($prixNADCentimes) || $prixNADCentimes == 0) &&
            !empty($desc) &&
            !empty($_FILES[$fileImput]['name'])
        ) {
            MdlAjouterGoodie(
                RACINE . 'goodies/',
                $titre,
                $categorie,
                $prixADEuro,
                $prixADCentimes,
                $prixNADEuro,
                $prixNADCentimes,
                $desc,
                $fileImput
            );
            CtlAjouterGoodie();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterGoodie();
    }
}

function CtlAjouterImageGoodie() {
    MdlGoodiesTous('nom', true, true, true);
    afficherAjouterImageGoodie();
}

function CtlAjouterImageGoodieExecuter($id, $fileImput) {
    try {
        if (
            !empty($id) &&
            !empty($_FILES[$fileImput]['name'])
        ) {
            MdlAjouterImageGoodie(
                RACINE . 'goodies/',
                $id,
                $fileImput
            );
            CtlAjouterImageGoodie();
        } else {
            throw new Exception('Veuillez remplir tous les champs et sélectionner une image.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterImageGoodie();
    }
}

function CtlChoixGoodie() {
    MdlGoodiesTous('nom', true, true, true);
    afficherChoixGoodie();
}

function CtlChoixGoodieExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            CtlModifierGoodie($id);
        } else {
            throw new Exception('Veuillez sélectionner un goodie.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlChoixGoodie();
    }
}

function CtlModifierGoodie($id) {
    MdlGoodiePrecis($id);
    afficherModifierGoodie();
}

function CtlModifierGoodieExecuter($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    try {
        if (
            !empty($titre) &&
            (!empty($categorie) || $categorie == 0) && $categorie != '-1' &&
            (!empty($prixADEuro) || $prixADEuro == 0) &&
            (!empty($prixADCentimes) || $prixADCentimes == 0) &&
            (!empty($prixNADEuro) || $prixNADEuro == 0) &&
            (!empty($prixNADCentimes) || $prixNADCentimes == 0) &&
            !empty($desc)
        ) {
            MdlModifierGoodie(
                $id,
                $titre,
                $categorie,
                $prixADEuro,
                $prixADCentimes,
                $prixNADEuro,
                $prixNADCentimes,
                $desc
            );
            CtlModifierGoodie($id);
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlModifierGoodie($id);
    }
}

function CtlSupprimerImageGoodie($id) {
    MdlGoodiePrecis($id);
    MdlImagesGoodie($id);
    afficherSupprimerImageGoodie();
}

function CtlSupprimerImageGoodieExecuter($id, $arrayIdImages) {
    try {
        foreach ($arrayIdImages as $idImage) {
            MdlSupprimerImageGoodie(RACINE . 'goodies/', $idImage, true);
        }
        CtlSupprimerImageGoodie($id);
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerImageGoodie($id);
    }
}

function CtlSupprimerGoodie() {
    MdlGoodiesTous('nom', true, true, true);
    afficherSupprimerGoodie();
}

function CtlSupprimerGoodieExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            MdlSupprimerGoodie(
                RACINE . 'goodies/',
                $id
            );
            CtlSupprimerGoodie();
        } else {
            throw new Exception('Veuillez sélectionner un goodie.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerGoodie();
    }
}

# Journaux
function CtlAjouterJournal() {
    afficherAjouterJournal();
}

function CtlAjouterJournalExecuter($titre, $mois, $annee, $fileImput) {
    try {
        if (
            !empty($titre) &&
            !empty($mois) &&
            !empty($annee) &&
            !empty($_FILES[$fileImput]['name'])
        ) {
            MdlAjouterJournal(
                RACINE . 'journaux/',
                $titre,
                $mois,
                $annee,
                $fileImput
            );
            CtlAjouterJournal();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterJournal();
    }
}

function CtlSupprimerJournal() {
    MdlJournauxTous(NULL);
    afficherSupprimerJournal();
}

function CtlSupprimerJournalExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            MdlSupprimerJournal(
                RACINE . 'journaux/',
                $id
            );
            CtlSupprimerJournal();
        } else {
            throw new Exception('Veuillez sélectionner un journal.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerJournal();
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
function CtlArticles() {
        MdlArticlesTous(true, false);
        MdlMiniaturesArticles(true, false);
        MdlArticlesVideoTous(true, false);
        MdlMiniaturesArticlesVideo(true, false);
        afficherArticles();
}

function CtlArticlePrecis($id) {
    try {
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
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlArticles();
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
    MdlEventsTous($tri, $aVenir, $passes, NULL);
    afficherEvents($tri, $aVenir, $passes, $rechercheEnCours);
}

function CtlEventPrecis($id){
    try {
        MdlEventPrecis($id);
        if ($GLOBALS['retoursModele']['event']) {
            afficherEventPrecis();
        } else {
            throw new Exception('L\'évent recherché n\'existe pas.', 404);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlEvents('FP', true, false, false);
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