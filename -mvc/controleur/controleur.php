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
function CtlSupprimerGoodieMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerGoodie($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterJournalMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterJournal($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerJournalMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerJournal($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterImageArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterImageArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherChoixArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterArticleVideoMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterArticleVideo($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticleVideoMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherChoixArticleVideo($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticleVideoMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerArticleVideo($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterCategorieArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterCategorieArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlRenommerCategorieArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherRenommerCategorieArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAfficherLog() {
    try {
        MdlLogTous();
        afficherAfficherLog();
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherAfficherLog();
    }
}

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
            MdlGoodiesTous('FP', true, true, NULL);
            afficherChoixGoodie();
        } else {
            if (
            !empty($GLOBALS['form']['id'])
            ) {
                MdlGoodiePrecis($GLOBALS['form']['idGoodie']);
                afficherModifierGoodie();
            } else {
                ajouterMessage(400, 'Veuillez sélectionner un goodie.');
                MdlGoodiesTous('FP', true, true, NULL);
                afficherChoixGoodie();
            }
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        MdlGoodiesTous('FP', true, true, NULL);
        afficherChoixGoodie();
    }
}

function CtlModifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    if (isset($_SESSION['id'])) {
        try {
            if (
                !empty($titre) &&
                (!empty($categorie) || $categorie == 0) &&
                (!empty($prixADEuro) || $prixADEuro == 0) &&
                (!empty($prixADCentimes) || $prixADCentimes == 0) &&
                (!empty($prixNADEuro) || $prixNADEuro == 0) &&
                (!empty($prixNADCentimes) || $prixNADCentimes == 0) &&
                !empty($desc)
            ) {
                MdlModifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc);
                afficherModifierGoodie('Le goodie "' . $titre . '" a été modifié avec succès !', $id);
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherModifierGoodie($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAllerSupprimerImageGoodie($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherSupprimerImageGoodie('', $id);
            } else {
                throw new Exception('Erreur : Identifiant invalide.');
            }
        } catch (Exception $e) {
            afficherModifierGoodie($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerGoodie($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                MdlSupprimerGoodie(RACINE . 'goodies/', $id);
                afficherSupprimerGoodie('Le goodie a été supprimé avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un goodie.');
            }
        } catch (Exception $e) {
            afficherSupprimerGoodie($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

# Journaux
function CtlAjouterJournal($titre, $mois, $annee, $fileImput) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($titre) && !empty($mois) && !empty($annee) && !empty($_FILES[$fileImput]['name'])) {
                MdlAjouterJournal(RACINE . 'journaux/', $titre, $mois, $annee, $fileImput);
                afficherAjouterJournal('Le journal "' . $titre . '" a été ajouté avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner un PDF.');
            }
        } catch (Exception $e) {
            afficherAjouterJournal($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerJournal($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                MdlSupprimerJournal(RACINE . 'journaux/', $id);
                afficherSupprimerJournal('Le journal a été supprimé avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un journal.');
            }
        } catch (Exception $e) {
            afficherSupprimerJournal($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

# Articles
function CtlAjouterArticle($titre, $categorie, $visibilite, $texte) {
    if (isset($_SESSION['id'])) {
        try {
            if (
                !empty($titre) &&
                $categorie != '-1' &&
                $visibilite != '-1' &&
                !empty($texte)
            ) {
                MdlAjouterArticle($titre, $categorie, $visibilite, $texte);
                afficherAjouterArticle('L\'article "' . $titre . '" a été ajouté avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherAjouterArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
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

function CtlChoixArticle($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherModifierArticle('', $id);
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un article.');
            }
        } catch (Exception $e) {
            afficherChoixArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlModifierArticle($id, $titre, $categorie, $visibilite, $texte) {
    if (isset($_SESSION['id'])) {
        try {
            if (
                !empty($titre) &&
                (!empty($visibilite) || $visibilite == 0) &&
                (!empty($visibilite) || $visibilite == 0) &&
                !empty($texte)
            ) {
                MdlModifierArticle($id, $titre, $categorie, $visibilite, $texte);
                afficherModifierArticle('L\'article "' . $titre . '" a été modifié avec succès !', $id);
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherModifierArticle($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
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

function CtlSupprimerArticle($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                MdlSupprimerArticle(RACINE . 'articles/', $id);
                afficherSupprimerArticle('L\'article a été supprimé avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un article.');
            }
        } catch (Exception $e) {
            afficherSupprimerArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte) {
    if (isset($_SESSION['id'])) {
        try {
            if (
                !empty($titre) &&
                $categorie != '-1' &&
                $visibilite != '-1' &&
                !empty($lien) &&
                !empty($texte)
            ) {
                MdlAjouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte);
                afficherAjouterArticleVideo('L\'article vidéo "' . $titre . '" a été ajouté avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherAjouterArticleVideo($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticleVideo($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherModifierArticleVideo('', $id);
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un article.');
            }
        } catch (Exception $e) {
            afficherChoixArticleVideo($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlModifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte) {
    if (isset($_SESSION['id'])) {
        try {
            if (
                !empty($titre) &&
                (!empty($visibilite) || $visibilite == 0) &&
                (!empty($visibilite) || $visibilite == 0) &&
                !empty($lien) &&
                !empty($texte)
            ) {
                MdlModifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte);
                afficherModifierArticleVideo('L\'article "' . $titre . '" a été modifié avec succès !', $id);
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherModifierArticleVideo($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticleVideo($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                MdlSupprimerArticleVideo($id);
                afficherSupprimerArticleVideo('L\'article vidéo a été supprimé avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un article.');
            }
        } catch (Exception $e) {
            afficherSupprimerArticleVideo($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterCategorieArticle($titre) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($titre)) {
                MdlAjouterCategorieArticle($titre);
                afficherAjouterCategorieArticle('La catégorie "' . $titre . '" a été ajoutée avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherAjouterCategorieArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlRenommerCategorieArticle($id, $titre) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id) && !empty($titre)) {
                MdlRenommerCategorieArticle($id, $titre);
                afficherRenommerCategorieArticle('La catégorie a été renommée en "' . $titre . '" avec succès !');
            } else {
                throw new Exception('Erreur : Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            afficherRenommerCategorieArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
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