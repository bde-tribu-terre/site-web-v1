<?php
require_once(racine() . '-mvc/modele/connect/connect.php');
require_once(racine() . '-mvc/modele/modele.php');
require_once(racine() . '-mvc/vue/vue.php');
########################################################################################################################
# Vérification du protocole (les deux fonctionnent mais on veut forcer le passage par HTTPS)                           #
########################################################################################################################
if($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

########################################################################################################################
# Définition de la fonction racine.                                                                                    #
########################################################################################################################
/**
 * Retourne le chemin vers la racine du site web. À n'utiliser que du côté serveur PHP car cela indique le nom de
 * l'hébergeur, et potentiellement d'autres données sensibles.
 * @return string
 */
function racine() {
    $chemin = preg_split('/\//', __DIR__);
    while (!file_exists(join('/', $chemin) . '/sitemapindex.xml')) {
        array_pop($chemin);
    }
    return join('/', $chemin) . '/';
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
if (!file_exists(racine() . 'events/sitemap-events.xml')) {
    MdlReloadSitemapEvents();
}
if (!file_exists(racine() . 'goodies/sitemap-goodies.xml')) {
    MdlReloadSitemapGoodies();
}
if (!file_exists(racine() . 'journaux/sitemap-journaux.xml')) {
    MdlReloadSitemapJournaux();
}

########################################################################################################################
# Fonction de renvoi REST                                                                                              #
########################################################################################################################
function restReturn($httpCode, $data) {
    header("Content-Type: application/json");
    http_response_code($httpCode);
    $meta['source'] = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $meta['start'] = $_SERVER['REQUEST_TIME_FLOAT'];
    $meta['end'] = microtime(true);
    $meta['credits'] = 'Anaël BARODINE, étudiant en informatique à l\'Université d\'Orléans, au nom de l\'association étudiante Tribu-Terre.';
    echo json_encode(
        array(
            'metadata' => $meta,
            'data' => $data
        )
    );
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
                racine() . 'goodies/',
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
                racine() . 'goodies/',
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
            MdlSupprimerImageGoodie(
                racine() . 'goodies/',
                $idImage,
                true
            );
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
                racine() . 'goodies/',
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
                racine() . 'journaux/',
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
                racine() . 'journaux/',
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

# Liens
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
    MdlGetLog();
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
# API - Université                                                                                                     #
########################################################################################################################
function CtlApiUniversite() {
    try {
        MdlApiGetBatiments();
        restReturn(
            200,
            $GLOBALS['retoursModele']['batiments']
        );
        return;
    } catch (Exception $e) {
        MdlLogApi('ERROR', 'Erreur interne survenue lors de la requête des bâtiments : ' . '(' . $e->getCode() . ')' . $e->getMessage());
        restReturn(
            500,
            'Erreur interne survenue lors de la requête des bâtiments.'
        );
        return;
    }
}

########################################################################################################################
# API - Université - Salles                                                                                            #
########################################################################################################################
function CtlApiUniversiteSalles($idBatiment) {
    try {
        if (!empty($idBatiment) && ctype_digit($idBatiment)) {
            MdlApiGetSalles($idBatiment);
            restReturn(
                200,
                $GLOBALS['retoursModele']['salles']
            );
        } else {
            restReturn(
                400,
                'Veuillez saisir un ID de bâtiment (nombre entier) comme paramètre HTTP \'id\'.'
            );
        }
    } catch (Exception $e) {
        MdlLogApi('ERROR', 'Erreur interne survenue lors de la requête des salles : ' . '(' . $e->getCode() . ')' . $e->getMessage());
        restReturn(
            500,
            'Erreur interne survenue lors de la requête des salles.'
        );
        return;
    }
}

########################################################################################################################
# API - Université - GeoJSON                                                                                           #
########################################################################################################################
function CtlApiUniversiteGeoJson($idBatiment) {
    try {
        if (!empty($idBatiment) && ctype_digit($idBatiment)) {
            MdlApiGetGeoJson($idBatiment);
            restReturn(
                200,
                $GLOBALS['retoursModele']['geoJson']
            );
        } else {
            restReturn(
                400,
                'Veuillez saisir un ID de bâtiment (nombre entier) comme paramètre HTTP \'id\'.'
            );
        }
    } catch (Exception $e) {
        MdlLogApi('ERROR', 'Erreur interne survenue lors de la requête du GeoJSON : ' . '(' . $e->getCode() . ')' . $e->getMessage());
        restReturn(
            500,
            'Erreur interne survenue lors de la requête du GeoJSON.'
        );
        return;
    }
}

########################################################################################################################
# Accueil                                                                                                              #
########################################################################################################################
function CtlAccueil() {
    MdlGoodiesTous('', true, false, false);
    MdlEventsTous('PF', true, false, 3);
    MdlJournauxTous(2);
    afficherAccueil();
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
