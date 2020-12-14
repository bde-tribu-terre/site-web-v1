<?php
require_once(RACINE . '-mvc/modele/connect.php');
require_once(RACINE . '-mvc/modele/modele.php');
require_once(RACINE . '-mvc/vue/vue.php');
########################################################################################################################
# Vérification du protocole (les deux fonctionnent mais on veut forcer le passage par HTTPS)                           #
########################################################################################################################
if($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
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
##ajouterMessage(0, print_r($form, true));

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
# Vérification de l'existence des sitemaps                                                                             #
########################################################################################################################
if (!file_exists(RACINE . 'articles/sitemap-articles.xml')) {
    MdlReloadSitemapArticles();
}
if (!file_exists(RACINE . 'events/sitemap-events.xml')) {
    MdlReloadSitemapEvents();
}
if (!file_exists(RACINE . 'goodies/sitemap-goodies.xml')) {
    MdlReloadSitemapGoodies();
}
if (!file_exists(RACINE . 'journaux/sitemap-journaux.xml')) {
    MdlReloadSitemapJournaux();
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
} // CtlConnexionExecuter en suivant le reste des standards.

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
function CtlAjouterArticle() {
    MdlCategoriesArticlesTous();
    afficherAjouterArticle();
}

function CtlAjouterArticleExecuter($titre, $categorie, $visibilite, $texte) {
    try {
        if (
            !empty($titre) &&
            $categorie != '-1' &&
            $visibilite != '-1' &&
            !empty($texte)
        ) {
            MdlAjouterArticle(
                $titre,
                $categorie,
                $visibilite,
                $texte
            );
            CtlAjouterArticle();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterArticle();
    }
}

function CtlAjouterImageArticle() {
    MdlArticlesTous(true, true);
    afficherAjouterImageArticle();
}

function CtlAjouterImageArticleExecuter($id, $fileImput) {
    try {
        if (
            !empty($id) &&
            !empty($_FILES[$fileImput]['name'])
        ) {
            MdlAjouterImageArticle(
                RACINE . 'articles/',
                $id,
                $fileImput);
            CtlAjouterImageArticle();
        } else {
            throw new Exception('Veuillez remplir tous les champs et sélectionner une image.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterImageArticle();
    }
}

function CtlChoixArticle() {
    MdlArticlesTous(true, true);
    afficherChoixArticle();
}

function CtlChoixArticleExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            CtlModifierArticle($id);
        } else {
            throw new Exception('Veuillez sélectionner un article.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlChoixArticle();
    }
}

function CtlModifierArticle($id) {
    MdlArticlePrecis($id);
    MdlCategoriesArticlesTous();
    afficherModifierArticle();
}

function CtlModifierArticleExecuter($id, $titre, $categorie, $visibilite, $texte) {
    try {
        if (
            !empty($titre) &&
            $categorie != '-1' &&
            $visibilite != '-1' &&
            !empty($texte)
        ) {
            MdlModifierArticle(
                $id,
                $titre,
                $categorie,
                $visibilite,
                $texte
            );
            CtlModifierArticle($id);
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlModifierArticle($id);
    }
}

function CtlSupprimerImageArticle($id) {
    MdlArticlePrecis($id);
    MdlImagesArticle($id, NULL);
    afficherSupprimerImageArticle();
}

function CtlSupprimerImageArticleExecuter($id, $arrayIdImages) {
    try {
        foreach ($arrayIdImages as $idImage) {
            MdlSupprimerImageArticle(RACINE . 'articles/', $idImage, true);
        }
        CtlSupprimerImageArticle($id);
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerImageArticle($id);
    }
}

function CtlSupprimerArticle() {
    MdlArticlesTous();
    afficherSupprimerArticle();
}

function CtlSupprimerArticleExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            MdlSupprimerArticle(
                RACINE . 'articles/',
                $id
            );
            CtlSupprimerArticle();
        } else {
            throw new Exception('Veuillez sélectionner un article.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerArticle();
    }
}

function CtlAjouterArticleVideo() {
    MdlCategoriesArticlesTous();
    afficherAjouterArticleVideo();
}

function CtlAjouterArticleVideoExecuter($titre, $categorie, $visibilite, $lien, $texte) {
    try {
        if (
            !empty($titre) &&
            $categorie != '-1' &&
            $visibilite != '-1' &&
            !empty($lien) &&
            !empty($texte)
        ) {
            MdlAjouterArticleVideo(
                $titre,
                $categorie,
                $visibilite,
                $lien,
                $texte
            );
            CtlAjouterArticleVideo();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterArticleVideo();
    }
}

function CtlChoixArticleVideo() {
    MdlArticlesVideoTous();
    afficherChoixArticleVideo();
}

function CtlChoixArticleVideoExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            CtlModifierArticleVideo($id);
        } else {
            throw new Exception('Veuillez sélectionner un article.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlChoixArticleVideo();
    }
}

function CtlModifierArticleVideo($id) {
    MdlArticleVideoPrecis($id);
    MdlCategoriesArticlesTous();
    afficherModifierArticleVideo();
}

function CtlModifierArticleVideoExecuter($id, $titre, $categorie, $visibilite, $lien, $texte) {
    try {
        if (
            !empty($titre) &&
            $categorie != '-1' &&
            $visibilite != '-1' &&
            !empty($lien) &&
            !empty($texte)
        ) {
            MdlModifierArticleVideo(
                $id,
                $titre,
                $categorie,
                $visibilite,
                $lien,
                $texte
            );
            CtlModifierArticleVideo($id);
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlModifierArticleVideo($id);
    }
}

function CtlSupprimerArticleVideo() {
    MdlArticlesVideoTous();
    afficherSupprimerArticleVideo();
}

function CtlSupprimerArticleVideoExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            MdlSupprimerArticleVideo(
                $id
            );
            CtlSupprimerArticleVideo();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerArticleVideo();
    }
}

function CtlAjouterCategorieArticle() {
    afficherAjouterCategorieArticle();
}

function CtlAjouterCategorieArticleExecuter($titre) {
    try {
        if (
            !empty($titre)
        ) {
            MdlAjouterCategorieArticle(
                $titre
            );
            CtlAjouterCategorieArticle();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterCategorieArticle();
    }
}

function CtlRenommerCategorieArticle() {
    MdlCategoriesArticlesTous();
    afficherRenommerCategorieArticle();
}

function CtlRenommerCategorieArticleExecuter($id, $titre) {
    try {
        if (
            !empty($id) &&
            !empty($titre)
        ) {
            MdlRenommerCategorieArticle(
                $id,
                $titre
            );
            CtlRenommerCategorieArticle();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlRenommerCategorieArticle();
    }
}

# Liens Pratiques
function CtlAjouterLienPratique() {
    afficherAjouterLienPratique();
}

function CtlAjouterLienPratiqueExecuter($titre, $url) {
    try {
        if (
            !empty($titre) &&
            !empty($url)
        ) {
            MdlAjouterLienPratique(
                $titre,
                $url
            );
            CtlAjouterLienPratique();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlAjouterLienPratique();
    }
}

function CtlSupprimerLienPratique() {
    MdlLiensPratiquesTous();
    afficherSupprimerLienPratique();
}

function CtlSupprimerLienPratiqueExecuter($id) {
    try {
        if (
            !empty($id)
        ) {
            MdlSupprimerLienPratique(
                $id
            );
            CtlSupprimerLienPratique();
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlSupprimerLienPratique();
    }
}

# Log
function CtlLog() {
    MdlLogTous();
    afficherLog();
}

########################################################################################################################
# Admin - Inscription                                                                                                  #
########################################################################################################################
function CtlInscription() {
    afficherInscription();
}

function CtlInscriptionExecuter($cleInscription, $prenom, $nom, $login, $mdp) {
    try {
        if (
            !empty($cleInscription) &&
            !empty($prenom) &&
            !empty($nom) &&
            !empty($login) &&
            !empty($mdp)
        ) {
            if (MdlCleExiste($cleInscription)) { // Si trouvée, alors elle est détruite.
                MdlAjouterMembre(
                    $prenom,
                    $nom,
                    $login,
                    $mdp
                );
                CtlInscription();
            } else {
                throw new Exception('La clé d\'inscription saisie n\'existe pas.', 402);
            }
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlInscription();
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
# Association - Trombinoscope                                                                                          #
########################################################################################################################
function CtlTrombinoscope() {
    afficherTrombinoscope();
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
function CtlGoodies($tri, $disponible, $bientot, $rupture, $rechercheEnCours) {
    MdlGoodiesTous($tri, $disponible, $bientot, $rupture);
    afficherGoodies($tri, $disponible, $bientot, $rupture, $rechercheEnCours);
}

function CtlGoodiePrecis($id) {
    try {
        MdlGoodiePrecis($id);
        if ($GLOBALS['retoursModele']['goodie']) {
            MdlImagesGoodie($id);
            afficherGoodiePrecis();
        } else {
            throw new Exception('Le goodie recherché n\'existe pas.', 404);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlGoodies('', true, true, false, false);
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
# Liens                                                                                                                #
########################################################################################################################
function CtlLiens() {
    MdlLiensPratiquesTous();
    afficherLiens();
}

########################################################################################################################
# Mentions légales                                                                                                     #
########################################################################################################################
function CtlMentionsLegales() {
    afficherMentionsLegales();
}

########################################################################################################################
# Mentions légales                                                                                                     #
########################################################################################################################
function CtlParrainage() {
    afficherParrainage();
}

function CtlParrainageReponse($mail) {
    try {
        MdlRecupBinomesParrainages($mail);
        if ($GLOBALS['retoursModele']['parrainage']) {
            afficherParrainageRecherche();
        } else {
            throw new Exception('Cet adresse mail "' . $mail . '" n\'existe pas.', 404);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlParrainage();
    }
}

########################################################################################################################
# Plan du site                                                                                                         #
########################################################################################################################
function CtlPlanDuSite() {
    afficherPlanDuSite();
}

########################################################################################################################
# Trouver une salle                                                                                                    #
########################################################################################################################
function CtlTrouverUneSalle() {
    afficherTrouverUneSalle();
}

function CtlTrouverUneSalleRecherche($nom) {
    try {
        if (
            !empty($nom)
        ) {
            MdlRechercherSalle($nom);
            if ($GLOBALS['retoursModele']['salles']) {
                afficherTrouverUneSalleRecherche();
            } else {
                throw new Exception('Aucune salle de nom "' . $nom . '" n\'a été trouvée.', 604);
            }
        } else {
            throw new Exception('Veuillez remplir tous les champs.', 400);
        }
    } catch (Exception $e) {
        ajouterMessage($e->getCode(), $e->getMessage());
        CtlTrouverUneSalle();
    }
}
