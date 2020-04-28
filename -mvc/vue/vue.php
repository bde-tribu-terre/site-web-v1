<?php
########################################################################################################################
########################################################################################################################
###                                                     -- A --                                                      ###
###                                                                                                                  ###
###                                                   INTRODUCTION                                                   ###
########################################################################################################################
########################################################################################################################

########################################################################################################################
# A.I - Constantes Générales                                                                                           #
########################################################################################################################
define('IMAGES', RACINE . '-images/');

########################################################################################################################
# A.II - Fonction d'Initialisation des Constantes Spécifiques & Affichage du Cadre                                     #
########################################################################################################################
function afficherCadre($quelCadre) {
    switch ($quelCadre) {
        case 'ADMIN':
            define('PATH_TO_HEADER', RACINE . '-mvc/vue/gabaritsAdmin/' . '--header.php');
            define('PATH_TO_FOOTER', RACINE . '-mvc/vue/gabaritsAdmin/' . '--footer.php');
            define('PATH_TO_GABARIT', RACINE . '-mvc/vue/gabaritsAdmin/' . GABARIT);
            break;
        case 'PUBLIC':
            define('PATH_TO_HEADER', RACINE . '-mvc/vue/gabaritsPublic/' . '--header.php');
            define('PATH_TO_FOOTER', RACINE . '-mvc/vue/gabaritsPublic/' . '--footer.php');
            define('PATH_TO_GABARIT', RACINE . '-mvc/vue/gabaritsPublic/' . GABARIT);
    }

    require_once(RACINE . '-mvc/vue/cadre.php');
}

function afficherPageFixe($quelCadre, $title, $gabarit) {
    define('TITLE', $title);
    define('GABARIT', $gabarit);
    afficherCadre($quelCadre);
}

########################################################################################################################
# A.III - Fonctions d'affichage                                                                                        #
########################################################################################################################
function genererDate($date) {
    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    return
        (substr($date, 8, 2) == '01' ? '1<sup>er</sup>' : intval(substr($date, 8, 2))) .
        ' ' .
        $arrayMois[substr($date, 5, 2)] .
        ' ' .
        substr($date, 0, 4);
}

function formaterTexte($texte) {
    $texteFormate = preg_replace('/&sect;T(.*)&sect;!T/', "\n<h3>$1</h3>\n", $texte);
    $texteFormate = preg_replace('/\n(\n)*/', "\n", $texteFormate);
    $texteFormate = '<p>' . preg_replace('/\n/', '</p><p>', $texteFormate) . '</p>';
    $texteFormate = preg_replace('/&sect;G(.*)&sect;!G/', '<strong>$1</strong>', $texteFormate);
    $texteFormate = preg_replace('/&sect;I(.*)&sect;!I/', '<i>$1</i>', $texteFormate);
    $texteFormate = preg_replace('/&sect;S(.*)&sect;!S/', '<u>$1</u>', $texteFormate);
    $texteFormate = preg_replace('/&sect;B(.*)&sect;!B/', '<span style="text-decoration: line-through;">$1</span>', $texteFormate);
    $texteFormate = preg_replace('/&sect;C(.*)&sect;!C/', '<span class="pc">$1</span>', $texteFormate);
    $texteFormate = preg_replace('/&sect;L(.*)&sect;!L\[(.*)]/', '<a href="$2">$1</a>', $texteFormate);
    return $texteFormate;
}

########################################################################################################################
########################################################################################################################
###                                                     -- B --                                                      ###
###                                                                                                                  ###
###                                              FONCTION D'AFFICHAGES                                               ###
###                                         CLASSÉES PAR CONTRÔLEUR FRONTAL                                          ###
########################################################################################################################
########################################################################################################################

########################################################################################################################
# B.I - Admin                                                                                                          #
########################################################################################################################
# Système
function afficherConnexion($messageRetour) {
    define('TITLE', 'Connexion');
    define('GABARIT', 'connexion.php');

    define('MESSAGE_RETOUR', $messageRetour);

    afficherCadre('ADMIN');
}

function afficherMenu($messageRetour) {
    define('TITLE', 'Menu administrateur');
    define('GABARIT', 'menu.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);

    afficherCadre('ADMIN');
}

# Events
function afficherCreerEvent($messageRetour) {
    define('TITLE', 'Créer un évent');
    define('GABARIT', 'creerEvent.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);

    afficherCadre('ADMIN');
}

function afficherChoixEvent($messageRetour) {
    define('TITLE', 'Choisir un évent');
    define('GABARIT', 'choixEvent.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesEvents = idTitreEvents();

    $events = '';
    foreach ($lignesEvents as $ligneEvent) {
        $idEvents = htmlentities($ligneEvent->idEvents, ENT_QUOTES, "UTF-8");
        $titreEvents = htmlentities($ligneEvent->titreEvents, ENT_QUOTES, "UTF-8");
        $dateEvents = htmlentities($ligneEvent->dateEvents, ENT_QUOTES, "UTF-8");
        $events .=
            '<option value="' . $idEvents . '">(' .
            substr($dateEvents, 8, 2) . '/' .
            substr($dateEvents, 5, 2) . '/' .
            substr($dateEvents, 0, 4) . ') ' .
            $titreEvents . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('EVENTS', $events);

    afficherCadre('ADMIN');
}

function afficherModifierEvent($messageRetour, $id) {
    define('TITLE', 'Modifier un évent');
    define('GABARIT', 'modifierEvent.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $ligneEvent = eventPrecis($id);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ID', $id);
    define('TITRE', $ligneEvent->titreEvents);
    define('DESC', $ligneEvent->descEvents);
    define('DATE', $ligneEvent->dateEvents);
    define('HEURE', substr($ligneEvent->heureEvents, 0, 2));
    define('MINUTE', substr($ligneEvent->heureEvents, 3, 2));
    define('LIEU', $ligneEvent->lieuEvents);

    afficherCadre('ADMIN');
}

function afficherSupprimerEvent($messageRetour) {
    define('TITLE', 'Supprimer un évent');
    define('GABARIT', 'supprimerEvent.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesEvents = idTitreEvents();

    $events = '';
    foreach ($lignesEvents as $ligneEvent) {
        $idEvents = htmlentities($ligneEvent->idEvents, ENT_QUOTES, "UTF-8");
        $titreEvents = htmlentities($ligneEvent->titreEvents, ENT_QUOTES, "UTF-8");
        $dateEvents = htmlentities($ligneEvent->dateEvents, ENT_QUOTES, "UTF-8");
        $events .=
            '<option value="' . $idEvents . '">(' .
            substr($dateEvents, 8, 2) . '/' .
            substr($dateEvents, 5, 2) . '/' .
            substr($dateEvents, 0, 4) . ') ' .
            $titreEvents . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('EVENTS', $events);

    afficherCadre('ADMIN');
}

# Goodies
function afficherAjouterGoodie($messageRetour) {
    define('TITLE', 'Ajouter un goodie');
    define('GABARIT', 'ajouterGoodie.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);

    afficherCadre('ADMIN');
}

function afficherAjouterImageGoodie($messageRetour) {
    define('TITLE', 'Ajouter une image à un goodie');
    define('GABARIT', 'ajouterImageGoodie.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesGoodies = idTitreGoodies();

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">' . $titreGoodie . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('GOODIES', $goodies);

    afficherCadre('ADMIN');
}

function afficherChoixGoodie($messageRetour) {
    define('TITLE', 'Choisir un goodie');
    define('GABARIT', 'choixGoodie.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesGoodies = idTitreGoodies();

    $arrayCategories = [
        0 => 'Caché',
        1 => 'Disponible',
        2 => 'Bientôt disponible',
        3 => 'Rupture de stock'
    ];

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $categorieGoodie = htmlentities($ligneGoodie->categorieGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">(' . $arrayCategories[$categorieGoodie] . ') ' . $titreGoodie . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('GOODIES', $goodies);

    afficherCadre('ADMIN');
}

function afficherModifierGoodie($messageRetour, $id) {
    define('TITLE', 'Modifier un goodie');
    define('GABARIT', 'modifierGoodie.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $ligneGoodie = goodiePrecis($id);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ID', $id);
    define('TITRE', $ligneGoodie->titreGoodies);
    define('PRIX_AD_EURO', intval($ligneGoodie->prixADGoodies));
    define('PRIX_AD_CENTIMES', intval(($ligneGoodie->prixADGoodies - intval(PRIX_AD_EURO)) * 100));
    define('PRIX_NAD_EURO', intval($ligneGoodie->prixNADGoodies));
    define('PRIX_NAD_CENTIMES', intval(($ligneGoodie->prixNADGoodies - intval(PRIX_NAD_EURO)) * 100));
    define('CATEGORIE', $ligneGoodie->categorieGoodies);
    define('DESC', $ligneGoodie->descGoodies);

    afficherCadre('ADMIN');
}

function afficherSupprimerImageGoodie($messageRetour, $id) {
    define('TITLE', 'Supprimer une image d\'un goodie');
    define('GABARIT', 'supprimerImageGoodie.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesImages = imagesGoodie($id);

    $images = '';
    foreach ($lignesImages as $ligne) {
        $idImage = $ligne->idImagesGoodies;
        $lienImage = $ligne->lienImagesGoodies;

        $images .=
            '<div class="form-group">' .
                '<label for="' . $idImage . '"><img src="' . RACINE . 'goodies/' . $lienImage . '" width="200" height="100" alt="img"></label>' .
                '<input class="form-control" type="checkbox" name="' . $idImage . '" id="' . $idImage . '">' .
            '</div>' .
            '<br>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ID', $id);
    define('IMAGES_GOODIE', $images); // Car la constante IMAGES existe déjà...

    afficherCadre('ADMIN');
}

function afficherSupprimerGoodie($messageRetour) {
    define('TITLE', 'Supprimer un goodie');
    define('GABARIT', 'supprimerGoodie.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesGoodies = idTitreGoodies();

    $arrayCategories = [
        0 => 'Caché',
        1 => 'Disponible',
        2 => 'Bientôt disponible',
        3 => 'Rupture de stock'
    ];

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $categorieGoodie = htmlentities($ligneGoodie->categorieGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">(' . $arrayCategories[$categorieGoodie] . ') ' . $titreGoodie . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('GOODIES', $goodies);

    afficherCadre('ADMIN');
}

# Journaux
function afficherAjouterJournal($messageRetour) {
    define('TITLE', 'Ajouter un journal');
    define('GABARIT', 'ajouterJournal.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);

    afficherCadre('ADMIN');
}

function afficherSupprimerJournal($messageRetour) {
    define('TITLE', 'Supprimer un journal');
    define('GABARIT', 'supprimerJournal.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesJournaux = idTitreJournaux();

    $journaux = '';
    foreach ($lignesJournaux as $ligneJournal) {
        $idJournal = htmlentities($ligneJournal->idJournaux, ENT_QUOTES, "UTF-8");
        $titreJournal = htmlentities($ligneJournal->titreJournaux, ENT_QUOTES, "UTF-8");
        $journaux .=
            '<option value="' . $idJournal . '">' . $titreJournal . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('JOURNAUX', $journaux);

    afficherCadre('ADMIN');
}

# Articles
function afficherAjouterArticle($messageRetour) {
    define('TITLE', 'Ajouter un article');
    define('GABARIT', 'ajouterArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $categories .=
            '<option value="' . $idCategorieArticle . '">' . $titreCategorieArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('CATEGORIES', $categories);

    afficherCadre('ADMIN');
}

function afficherAjouterImageArticle($messageRetour) {
    define('TITLE', 'Ajouter une image à un article');
    define('GABARIT', 'ajouterImageArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesArticles = idTitreArticles();

    $articles = '';
    foreach ($lignesArticles as $ligneArticle) {
        $idArticle = htmlentities($ligneArticle->idArticles, ENT_QUOTES, "UTF-8");
        $titreArticle = htmlentities($ligneArticle->titreArticles, ENT_QUOTES, "UTF-8");
        $dateArticle = htmlentities($ligneArticle->dateCreationArticles, ENT_QUOTES, "UTF-8");
        $categorieArticle = htmlentities($ligneArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $articles .=
            '<option value="' . $idArticle . '">(' .
            substr($dateArticle, 8, 2) . '/' .
            substr($dateArticle, 5, 2) . '/' .
            substr($dateArticle, 0, 4) .
            ' | ' . $categorieArticle . ') ' .
            $titreArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ARTICLES', $articles);

    afficherCadre('ADMIN');
}

function afficherChoixArticle($messageRetour) {
    define('TITLE', 'Choisir un article');
    define('GABARIT', 'choixArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesArticles = idTitreArticles();

    $articles = '';
    foreach ($lignesArticles as $ligneArticle) {
        $idArticle = htmlentities($ligneArticle->idArticles, ENT_QUOTES, "UTF-8");
        $titreArticle = htmlentities($ligneArticle->titreArticles, ENT_QUOTES, "UTF-8");
        $dateArticle = htmlentities($ligneArticle->dateCreationArticles, ENT_QUOTES, "UTF-8");
        $categorieArticle = htmlentities($ligneArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $articles .=
            '<option value="' . $idArticle . '">(' .
            substr($dateArticle, 8, 2) . '/' .
            substr($dateArticle, 5, 2) . '/' .
            substr($dateArticle, 0, 4) .
            ' | ' . $categorieArticle . ') ' .
            $titreArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ARTICLES', $articles);

    afficherCadre('ADMIN');
}

function afficherModifierArticle($messageRetour, $id) {
    define('TITLE', 'Modifier un article');
    define('GABARIT', 'modifierArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $ligneArticle = articlePrecis($id);
    $categorie = $ligneArticle->idCategoriesArticles;
    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $selected = $categorie == $idCategorieArticle ? 'selected' : '';
        $categories .=
            '<option value="' . $idCategorieArticle . '" ' . $selected . '>' . $titreCategorieArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ID', $id);
    define('TITRE', $ligneArticle->titreArticles);
    define('CATEGORIE', $categorie);
    define('VISIBILITE', $ligneArticle->visibiliteArticles);
    define('TEXTE', $ligneArticle->texteArticles);
    define('CATEGORIES', $categories);

    afficherCadre('ADMIN');
}

function afficherSupprimerImageArticle($messageRetour, $id) {
    define('TITLE', 'Supprimer une image d\'un article');
    define('GABARIT', 'supprimerImageArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesImages = imagesArticle($id);

    $images = '';
    foreach ($lignesImages as $ligne) {
        $idImage = $ligne->idImagesArticles;
        $lienImage = $ligne->lienImagesArticles;

        $images .=
            '<div class="form-group">' .
            '<label for="' . $idImage . '"><img src="' . RACINE . 'articles/' . $lienImage . '" width="200" height="100" alt="img"></label>' .
            '<input class="form-control" type="checkbox" name="' . $idImage . '" id="' . $idImage . '">' .
            '</div>' .
            '<br>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ID', $id);
    define('IMAGES_ARTICLE', $images); // Car la constante IMAGES existe déjà...

    afficherCadre('ADMIN');
}

function afficherSupprimerArticle($messageRetour) {
    define('TITLE', 'Supprimer un article');
    define('GABARIT', 'supprimerArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesArticles = idTitreArticles();

    $articles = '';
    foreach ($lignesArticles as $ligneArticle) {
        $idArticle = htmlentities($ligneArticle->idArticles, ENT_QUOTES, "UTF-8");
        $titreArticle = htmlentities($ligneArticle->titreArticles, ENT_QUOTES, "UTF-8");
        $dateArticle = htmlentities($ligneArticle->dateCreationArticles, ENT_QUOTES, "UTF-8");
        $categorieArticle = htmlentities($ligneArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $articles .=
            '<option value="' . $idArticle . '">(' .
            substr($dateArticle, 8, 2) . '/' .
            substr($dateArticle, 5, 2) . '/' .
            substr($dateArticle, 0, 4) .
            ' | ' . $categorieArticle . ') ' .
            $titreArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ARTICLES', $articles);

    afficherCadre('ADMIN');
}

function afficherAjouterArticleVideo($messageRetour) {
    define('TITLE', 'Ajouter un article vidéo');
    define('GABARIT', 'ajouterArticleVideo.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $categories .=
            '<option value="' . $idCategorieArticle . '">' . $titreCategorieArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('CATEGORIES', $categories);

    afficherCadre('ADMIN');
}

function afficherChoixArticleVideo($messageRetour) {

    define('TITLE', 'Choisir un article vidéo');
    define('GABARIT', 'choixArticleVideo.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesArticles = idTitreArticlesVideo();

    $articlesVideo = '';
    foreach ($lignesArticles as $ligneArticle) {
        $idArticle = htmlentities($ligneArticle->idArticlesYouTube, ENT_QUOTES, "UTF-8");
        $titreArticle = htmlentities($ligneArticle->titreArticlesYouTube, ENT_QUOTES, "UTF-8");
        $dateArticle = htmlentities($ligneArticle->dateCreationArticlesYouTube, ENT_QUOTES, "UTF-8");
        $categorieArticle = htmlentities($ligneArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $articlesVideo .=
            '<option value="' . $idArticle . '">(' .
            substr($dateArticle, 8, 2) . '/' .
            substr($dateArticle, 5, 2) . '/' .
            substr($dateArticle, 0, 4) .
            ' | ' . $categorieArticle . ') ' .
            $titreArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ARTICLES_VIDEO', $articlesVideo);

    afficherCadre('ADMIN');
}

function afficherModifierArticleVideo($messageRetour, $id) {
    define('TITLE', 'Modifier un article vidéo');
    define('GABARIT', 'modifierArticleVideo.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $ligneArticle = articleVideoPrecis($id);
    $categorie = $ligneArticle->idCategoriesArticles;
    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $selected = $categorie == $idCategorieArticle ? 'selected' : '';
        $categories .=
            '<option value="' . $idCategorieArticle . '" ' . $selected . '>' . $titreCategorieArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ID', $id);
    define('TITRE', $ligneArticle->titreArticlesYouTube);
    define('CATEGORIES', $categories);
    define('VISIBILITE', $ligneArticle->visibiliteArticlesYouTube);
    define('LIEN', $ligneArticle->lienArticlesYouTube);
    define('TEXTE', $ligneArticle->texteArticlesYouTube);

    afficherCadre('ADMIN');
}

function afficherSupprimerArticleVideo($messageRetour) {
    define('TITLE', 'Supprimer un article vidéo');
    define('GABARIT', 'supprimerArticleVideo.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesArticles = idTitreArticlesVideo();

    $articlesVideo = '';
    foreach ($lignesArticles as $ligneArticle) {
        $idArticle = htmlentities($ligneArticle->idArticlesYouTube, ENT_QUOTES, "UTF-8");
        $titreArticle = htmlentities($ligneArticle->titreArticlesYouTube, ENT_QUOTES, "UTF-8");
        $dateArticle = htmlentities($ligneArticle->dateCreationArticlesYouTube, ENT_QUOTES, "UTF-8");
        $categorieArticle = htmlentities($ligneArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $articlesVideo .=
            '<option value="' . $idArticle . '">(' .
            substr($dateArticle, 8, 2) . '/' .
            substr($dateArticle, 5, 2) . '/' .
            substr($dateArticle, 0, 4) .
            ' | ' . $categorieArticle . ') ' .
            $titreArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('ARTICLES_VIDEO', $articlesVideo);

    afficherCadre('ADMIN');
}

function afficherAjouterCategorieArticle($messageRetour) {
    define('TITLE', 'Ajouter une catégorie d\'article');
    define('GABARIT', 'ajouterCategorieArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);

    afficherCadre('ADMIN');
}

function afficherRenommerCategorieArticle($messageRetour) {
    define('TITLE', 'Renommer une catégorie d\'article');
    define('GABARIT', 'renommerCategorieArticle.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $categories .=
            '<option value="' . $idCategorieArticle . '>' . $titreCategorieArticle . '</option>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('CATEGORIES', $categories);

    afficherCadre('ADMIN');
}

# Log
function afficherAfficherLog($messageRetour) {
    define('TITLE', 'Log');
    define('GABARIT', 'afficherLog.php');

    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $lignesLog = logTous();

    $log = '';
    foreach ($lignesLog as $ligneLog) {
        $nomMembre = htmlentities($ligneLog->nomMembre, ENT_QUOTES, "UTF-8");
        $codeLogActions = htmlentities($ligneLog->codeLogActions, ENT_QUOTES, "UTF-8");
        $dateLogActions = htmlentities($ligneLog->dateLogActions, ENT_QUOTES, "UTF-8");
        $descLogActions = htmlentities($ligneLog->descLogActions, ENT_QUOTES, "UTF-8");

        $log .=
            '<tr>' .
            '<th scope="row">' . $dateLogActions . '</th>' .
            '<th>' . sprintf('%03d', $codeLogActions) . '</th>' .
            '<th>' . $nomMembre . '</th>' .
            '<th>' . $descLogActions . '</th>' .
            '</tr>';
    }

    define('NOM_MEMBRE', htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8"));
    define('MESSAGE_RETOUR', $messageRetour);
    define('LOG', $log);

    afficherCadre('ADMIN');
}

########################################################################################################################
# B.II - Accueil                                                                                                       #
########################################################################################################################
function afficherAccueil() {
    define('TITLE', 'Accueil');
    define('GABARIT', 'accueil.php');

    # Goodies
    $goodiesIndicators = '';
    $goodies ='';
    $lignesGoodies = goodiesTous('', true, false, false);

    $nb = 0;
    $premier = true;
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $prixAdherentGoodie = htmlentities($ligneGoodie->prixADGoodies, ENT_QUOTES, "UTF-8");
        $prixNonAdherentGoodie = htmlentities($ligneGoodie->prixNADGoodies, ENT_QUOTES, "UTF-8");
        $categorieGoodie = htmlentities($ligneGoodie->categorieGoodies, ENT_QUOTES, "UTF-8");
        $miniatureGoodie = htmlentities($ligneGoodie->miniatureGoodies, ENT_QUOTES, "UTF-8");

        // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock
        if ($categorieGoodie != 1) {
            continue;
        }
        $lienMiniature = RACINE . 'goodies/' . $miniatureGoodie;

        $goodiesIndicators .= '<li data-target="#carouselGoodies" data-slide-to="' . $nb++ . '"';
        if ($premier) {
            $goodiesIndicators .= ' class="active"';
        }
        $goodiesIndicators .= '></li>' . "\n";
        $goodies .= '<div class="item';
        if ($premier) {
            $goodies .= ' active';
            $premier = false;
        }
        $goodies .=
            '">' . "\n" .
            '<a href="' . RACINE . 'goodies/?id=' . $idGoodie . '"><img src="' . $lienMiniature . '" alt="Image"></a>' . "\n" .
            '<div class="carousel-caption">' . "\n" .
            '<a href="' . RACINE . 'goodies/?id=' . $idGoodie . '"><h3>' . $titreGoodie . '</h3></a>' . "\n" .
            '<p>' . $prixAdherentGoodie . '€ Adhérent | ' . $prixNonAdherentGoodie . '€ Non-adhérent</p>' . "\n" .
            '</div>' . "\n" .
            '</div>';
    }
    $carouselGoodies =
        '<div id="carouselGoodies" class="carousel carousel-images slide" data-ride="carousel">' .
            '<!-- Indicators -->' .
            '<ol class="carousel-indicators">' .
                $goodiesIndicators .
            '</ol>' .
            '<!-- Wrapper for slides -->' .
                '<div class="carousel-inner" role="listbox">' .
                '<!-- Ici on liste les goodies -->' .
                $goodies .
            '</div>' .
            '<!-- Left and right controls -->' .
            '<a class="left carousel-control" href="#carouselGoodies" role="button" data-slide="prev">' .
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' .
            '<span class="sr-only">Previous</span>' .
            '</a>' .
            '<a class="right carousel-control" href="#carouselGoodies" role="button" data-slide="next">' .
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' .
            '<span class="sr-only">Next</span>' .
            '</a>' .
        '</div>';

    # Events
    $lignesEvents = eventsTous('PF', true, false, 3);
    $events = '<div class="well">';

    if (empty($lignesEvents)) {
        $events .=
            '<div class="well">' .
            '<p>Oups ! On dirait qu\'il n\'y a aucun évent de prévu dans le futur 🙈</p>' .
            '</div>';
    }

    $count = 0;
    foreach ($lignesEvents as $ligneEvent) {
        $count++;
        $idEvent = htmlentities($ligneEvent->idEvents, ENT_QUOTES, "UTF-8");
        $titreEvent = htmlentities($ligneEvent->titreEvents, ENT_QUOTES, "UTF-8");
        $dateEvent = htmlentities($ligneEvent->dateEvents, ENT_QUOTES, "UTF-8");
        $heureEvent = htmlentities($ligneEvent->heureEvents, ENT_QUOTES, "UTF-8");
        $lieuEvent = htmlentities($ligneEvent->lieuEvents, ENT_QUOTES, "UTF-8");
        $nbJours = round((strtotime($dateEvent) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
        $nbJoursStr = '';
        if ($nbJours == 0) {
            $nbJoursStr .= '<strong><span style="color: red"> (Aujourd\'hui)</span></strong>';
        } elseif ($nbJours == 1) {
            $nbJoursStr .= '<strong><span style="color: red"> (Demain)</span></strong>';
        } else {
            $nbJoursStr .= ' (dans ' . $nbJours . ' jours)';
        }
        if ($count !=1 ) {
            $events .= '<hr>';
        }
        if ($count == 3) {
            $events .= '<div class="alterneur-grand-moyen">';
        }
        $events .=
            '<h3 class="text-center">' . $titreEvent . '</h3>' .
            '<h5>📅&emsp;' . preg_replace('/ [^ ]*$/', '', genererDate($dateEvent)) . $nbJoursStr . '</h5>' .
            '<h5>⌚️&emsp;' . substr($heureEvent, 0, 2) . 'h' . substr($heureEvent, 3, 2) . '</h5>' .
            '<h5>📍&emsp;' . $lieuEvent . '</h5>' .
            '<a class="btn btn-danger btn-block" href="' . RACINE . 'events/?id=' . $idEvent . '">' .
            '<h4>Détails</h4>' .
            '</a>';
        if ($count == 3) {
            $events .= '</div>';
        }
    }
    $events .= '</div>';

    # Journal
    $lignesJournaux = journauxTous(2);
    $journaux ='';

    foreach ($lignesJournaux as $ligneJournal) {
        $titre = htmlentities($ligneJournal->titreJournaux, ENT_QUOTES, "UTF-8");;
        $date = htmlentities($ligneJournal->dateJournaux, ENT_QUOTES, "UTF-8");
        $pdf = htmlentities($ligneJournal->pdfJournaux, ENT_QUOTES, "UTF-8");

        $lienJournal = RACINE . 'journaux/' . $pdf;

        $journaux .=
            '<div class="col-sm-6">' .
            '<div class="well">' .
            '<h3>' . $titre . '</h3>' .
            '<h5>' . preg_replace('/^[^ ]* /', '', genererDate($date)) . '</h5>' .
            '<a href="' . $lienJournal . '" class="btn btn-danger btn-block">' .
            '<h4 class="alterneur-grand-tres-petit"><img src="' . RACINE . '-images/imgPdf.svg" height="28" alt="(PDF)">&emsp;Lire en ligne</h4>' .
            '<h4 class="alterneur-petit">Lire</h4>' .
            '</a>' .
            '</div>' .
            '</div>';
    }

    # Article
    $lignesArticles = articlesTous();
    $lignesArticlesVideo = articlesVideoTous();

    $arrayID = [];
    $arrayArticles = [];
    foreach ($lignesArticles as $ligneArticle) {
        $arrayID['T' . $ligneArticle->id] = $ligneArticle->dateCreation;
        $arrayArticles['T' . $ligneArticle->id] = $ligneArticle;
    }
    foreach ($lignesArticlesVideo as $ligneArticleVideo) {
        $arrayID['V' . $ligneArticleVideo->id] = $ligneArticleVideo->dateCreation;
        $arrayArticles['V' . $ligneArticleVideo->id] = $ligneArticleVideo;
    }
    asort($arrayID);
    $arrayID = array_reverse($arrayID);

    if (empty($arrayID)) {
        $article = 'Il semble qu\'il n\'y ait aucun article sur le site...';
    } else {
        function array_key_first_de_secours($array) { // Car la fonction n'est pas là dans ma version de PHP :(
            foreach ($array as $key => $value) {
                return $key;
            }
            return NULL;
        }
        $ligneArticle = $arrayArticles[array_key_first_de_secours($arrayID)];

        $article =
            '<div class="well">' .
            '<h5>' .
            '<span class="pc">' . $ligneArticle->categorie . '</span>' .
            '</h5>' .
            '<h3>' . $ligneArticle->titre . '</h3>' .
            '<h5>' . genererDate($ligneArticle->dateCreation) . '</h5>' .
            '<a href="' . RACINE . 'articles/?id=' . (!empty($ligneArticle->lien) ? '-' : '') . $ligneArticle->id . '" class="btn btn-danger btn-block">' .
            '<h4>Lire l\'article</h4>' .
            '</a>' .
            '</div>';
    }

    define('CAROUSEL_GOODIES', $carouselGoodies);
    define('EVENTS', $events);
    define('JOURNAUX', $journaux);
    define('ARTICLE', $article);

    afficherCadre('PUBLIC');
}

########################################################################################################################
# B.III - Articles                                                                                                     #
########################################################################################################################
function afficherArticles() {
    define('TITLE', 'Articles');
    define('GABARIT', 'articles.php');

    $tableArticles = '';
    $lignesArticles = articlesTous();
    $lignesArticlesVideo = articlesVideoTous();

    $arrayID = [];
    $arrayArticles = [];
    foreach ($lignesArticles as $ligneArticle) {
        $arrayID['T' . $ligneArticle->id] = $ligneArticle->dateCreation;
        $arrayArticles['T' . $ligneArticle->id] = $ligneArticle;
    }
    foreach ($lignesArticlesVideo as $ligneArticleVideo) {
        $arrayID['V' . $ligneArticleVideo->id] = $ligneArticleVideo->dateCreation;
        $arrayArticles['V' . $ligneArticleVideo->id] = $ligneArticleVideo;
    }
    asort($arrayID);
    $arrayID = array_reverse($arrayID);

    if (empty($arrayArticles)) {
        $tableArticles = '<h3>Hmmm... On dirait qu\'il n\'y a aucun article qui correspond à vos critères de recherches 🤔</h3>';
    } else {
        foreach ($arrayID as $ID => $dateCreation) {
            $id = htmlentities($arrayArticles[$ID]->id, ENT_QUOTES, "UTF-8");
            $titre = htmlentities($arrayArticles[$ID]->titre, ENT_QUOTES, "UTF-8");
            $categorie = htmlentities($arrayArticles[$ID]->categorie, ENT_QUOTES, "UTF-8");
            $visibilite = htmlentities($arrayArticles[$ID]->visibilite, ENT_QUOTES, "UTF-8");
            $texte = htmlentities($arrayArticles[$ID]->texte, ENT_QUOTES, "UTF-8");

            $cadreMiniature = '<div class="imageMiniatureArticlesDiv"><img class="img-fluid imageMiniatureArticles" src="--EMPLACEMENT--" alt="Miniature"></div>';
            switch (substr($ID, 0, 1)) {
                case 'T':
                    $lienArticle = RACINE . 'articles/?id=' . $id;
                    $premiereImage = premiereImageArticle($id);
                    $miniature = $premiereImage ? preg_replace('/--EMPLACEMENT--/', $premiereImage->lienImagesArticles, $cadreMiniature) : '';
                    break;
                case 'V':
                    $lienArticle = RACINE . 'articles/?id=-' . $id;
                    $miniature = preg_replace('/--EMPLACEMENT--/', obtenirInfoYouTube($arrayArticles[$ID]->lien)['thumbnail_url'], $cadreMiniature);
                    break;
                default:
                    $lienArticle = '#';
                    $miniature = '';
                    break;
            }

            $texteNonFormate = preg_replace('/&sect;!?L(\[.*])?/', '', preg_replace('/\n/', ' ', preg_replace('/&sect;!?[GISBCT]/', '', $texte)));
            $texteNonFormateMini = substr($texteNonFormate, 0, 256);

            $tableArticles .=
                '<div class="row">' .
                '<div class="col-sm-2"></div>' .
                '<div class="col-sm-8">' .
                    '<div class="well">' .
                        '<h4 class="pc">' . $categorie . '</h4>' .
                        '<hr>' .
                        '<h2>' . $titre . '</h2>' .
                        '<p><small>' . genererDate($dateCreation) . '</small></p>' .
                        $miniature .
                        '<hr>' .
                        '<p class="text-left retrait">' . $texteNonFormateMini . (strlen($texte) > 256 ? '[...]' : '')  . '</p>' .
                        '<hr>' .
                        '<a class="btn btn-danger btn-block" href="' . $lienArticle . '">' .
                            '<h4>Lire l\'article</h4>' .
                        '</a>' .
                    '</div>' .
                '</div>' .
                '<div class="col-sm-2"></div>' .
                '</div>';
        }
    }

    define('ARTICLES', $tableArticles);

    afficherCadre('PUBLIC');
}

function afficherArticlePrecis($article) {
    // define('TITLE', 'Articles'); Voir ci-après.
    define('GABARIT', 'articlePrecis.php');

    $id = $article->idArticles;
    $lignesImages = imagesArticle($id);

    $carouselArticle = '';
    if (!empty($lignesImages) && count($lignesImages) <= 1) {
        $carouselArticle =
            '<div class="row">' .
                '<div class="col-sm-2"></div>'.
                    '<div class="col-sm-8">' .
                        '<img src="' . RACINE . 'articles/' . $lignesImages[0]->lienImagesArticles . '" class="imageUniqueArticlePrecis" alt="Image">' .
                    '</div>' .
                '<div class="col-sm-2"></div>' .
            '</div><hr>';
    } elseif (!empty($lignesImages)) {
        $nb = 0;
        $carouselArticleIndicator = '<ol class="carousel-indicators">';
        $carouselArticleImages = '<div class="carousel-inner" role="listbox">';

        # Le reste des images
        foreach ($lignesImages as $ligne) {
            $lien = $ligne->lienImagesArticles;
            $carouselArticleIndicator .= '<li data-target="#carouselArticle" data-slide-to="' . $nb++ . '" ' . ($nb == 1 ? ' class="active"' : '') . '></li>';
            $carouselArticleImages .=
                '<div class="item' . ($nb == 1 ? ' active' : '') . '">' .
                    '<img src="' . RACINE . 'articles/' . $lien . '" alt="Image">' .
                '</div>';
        }
        $carouselArticleIndicator .= '</ol>';
        $carouselArticleImages .= '</div>';

        $carouselArticle =
            '<div class="row">' .
                '<div class="col-sm-2"></div>' .
                '<div class="col-sm-8">' .
                    '<div id="carouselArticle" class="carousel carouselImages slide" data-ride="carousel">' .
                        $carouselArticleIndicator .
                        $carouselArticleImages .
                        '<a class="left carousel-control" href="#carouselArticle" role="button" data-slide="prev">' .
                            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' .
                            '<span class="sr-only">Previous</span>' .
                        '</a>' .
                        '<a class="right carousel-control" href="#carouselArticle" role="button" data-slide="next">' .
                            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' .
                            '<span class="sr-only">Next</span>' .
                        '</a>' .
                    '</div>' .
                '</div>' .
                '<div class="col-sm-2"></div>' .
            '</div><hr>';
    }

    define('ID', $id);
    define('TITRE', htmlentities($article->titreArticles, ENT_QUOTES, "UTF-8"));
    define('CATEGORIE', htmlentities($article->titreCategoriesArticles, ENT_QUOTES, "UTF-8"));
    define('VISIBILITE', htmlentities($article->visibiliteArticles, ENT_QUOTES, "UTF-8"));
    define('DATE_CREATION', genererDate(htmlentities($article->dateCreationArticles, ENT_QUOTES, "UTF-8")));
    // define('DATE_MODIFICATION', genererDate(htmlentities($article->dateModificationArticles, ENT_QUOTES, "UTF-8")));
    define('TEXTE', formaterTexte(htmlentities($article->texteArticles)));
    define('AUTEUR', htmlentities($article->nomMembre, ENT_QUOTES, "UTF-8"));
    define('CAROUSEL_ARTICLES', $carouselArticle);
    define('TITLE', TITRE); // Ici.

    afficherCadre('PUBLIC');
}

function afficherArticleVideoPrecis($article) {
    // define('TITLE', 'Articles'); Voir ci-après.
    define('GABARIT', 'articleVideoPrecis.php');

    $lien = $article->lienArticlesYouTube;
    $infoYouTube = obtenirInfoYouTube($lien);

    $integrationVideo =
        '<div class="row">' .
            '<div class="col-sm-2"></div>' .
                '<div class="col-sm-8">' .
                    '<div class="embed-responsive embed-responsive-16by9 integrationArticleVideoPrecis">' .
                        preg_replace('/width="459" height="344"/', 'class="embed-responsive-item"', $infoYouTube['html']) .
                    '</div>' .
                '</div>' .
            '<div class="col-sm-2"></div>' .
        '</div><hr>';

    define('ID', htmlentities($article->idArticlesYouTube, ENT_QUOTES, "UTF-8"));
    define('LIEN', htmlentities($article->lienArticlesYouTube, ENT_QUOTES, "UTF-8"));
    define('TITRE', htmlentities($article->titreArticlesYouTube, ENT_QUOTES, "UTF-8"));
    define('CATEGORIE', htmlentities($article->titreCategoriesArticles, ENT_QUOTES, "UTF-8"));
    define('VISIBILITE', htmlentities($article->visibiliteArticlesYouTube, ENT_QUOTES, "UTF-8"));
    echo $article->dateCreationArticlesYouTube;
    define('DATE_CREATION', genererDate(htmlentities($article->dateCreationArticlesYouTube, ENT_QUOTES, "UTF-8")));
    // define('DATE_MODIFICATION', genererDate(htmlentities($article->dateModificationArticlesYouTube, ENT_QUOTES, "UTF-8")));
    define('TEXTE', formaterTexte(htmlentities($article->texteArticlesYouTube)));
    define('AUTEUR', htmlentities($article->nomMembre, ENT_QUOTES, "UTF-8"));
    define('INTEGRATION_VIDEO', $integrationVideo);
    define('TITLE', TITRE); // Ici.

    afficherCadre('PUBLIC');
}

########################################################################################################################
# B.IV - Association (Présentation)                                                                                    #
########################################################################################################################
function afficherPresentation() {
    afficherPageFixe(
        'PUBLIC',
        'Présentation',
        'presentation.php'
    );
}

########################################################################################################################
# B.IV.I - Association - Contact                                                                                       #
########################################################################################################################
function afficherContact() {
    afficherPageFixe(
        'PUBLIC',
        'Contact',
        'contact.php'
    );
}

########################################################################################################################
# B.IV.II - Association - Fonctionnement                                                                               #
########################################################################################################################
function afficherFonctionnement() {
    afficherPageFixe(
        'PUBLIC',
        'Fonctionnement de l\'association',
        'fonctionnement.php'
    );
}

########################################################################################################################
# B.IV.II.I - Association - Fonctionnement - Statuts                                                                   #
########################################################################################################################
function afficherStatuts() {
    afficherPageFixe(
        'PUBLIC',
        'Statuts',
        'statuts.php'
    );
}

########################################################################################################################
# B.IV.III - Association - Historique                                                                                  #
########################################################################################################################
function afficherHistorique() {
    afficherPageFixe(
        'PUBLIC',
        'Historique de l\'association',
        'historique.php'
    );
}

########################################################################################################################
# B.IV.IV - Association - Où nous trouver ?                                                                            #
########################################################################################################################
function afficherOuNousTrouver() {
    afficherPageFixe(
        'PUBLIC',
        'Où nous trouver ?',
        'ouNousTrouver.php'
    );
}

########################################################################################################################
# B.IV.V - Association - Partenaires                                                                                   #
########################################################################################################################
function afficherPartenaires() {
    afficherPageFixe(
        'PUBLIC',
        'Partenaires',
        'partenaires.php'
    );
}

########################################################################################################################
# B.IV.VI - Association - Pôles                                                                                        #
########################################################################################################################
function afficherPoles() {
    afficherPageFixe(
        'PUBLIC',
        'Pôles',
        'poles.php'
    );
}

########################################################################################################################
# B.IV.VII - Association - Pourquoi adhérer ?                                                                          #
########################################################################################################################
function afficherPourquoiAdherer() {
    afficherPageFixe(
        'PUBLIC',
        'Pourquoi adhérer ?',
        'pourquoiAdherer.php'
    );
}

########################################################################################################################
# B.IV.VIII - Association - Réseau associatif                                                                          #
########################################################################################################################
function afficherReseauAssociatif() {
    afficherPageFixe(
        'PUBLIC',
        'Réseau associatif',
        'reseauAssociatif.php'
    );
}

########################################################################################################################
# B.IV.VIII.I - Association - Réseau associatif - ÔCampus                                                              #
########################################################################################################################
function afficherOCampus() {
    afficherPageFixe(
        'PUBLIC',
        'ÔCampus',
        'oCampus.php'
    );
}

########################################################################################################################
# B.IV.VIII.II - Association - Réseau associatif - FNEB                                                                #
########################################################################################################################
function afficherFneb() {
    afficherPageFixe(
        'PUBLIC',
        'FNEB',
        'fneb.php'
    );
}

########################################################################################################################
# B.IV.IX - Association - Réseaus sociaux                                                                              #
########################################################################################################################
function afficherReseauxSociaux() {
    afficherPageFixe(
        'PUBLIC',
        'Réseaux sociaux',
        'reseauxSociaux.php'
    );
}

########################################################################################################################
# B.IV.X - Association - Université                                                                                    #
########################################################################################################################
function afficherUniversite() {
    afficherPageFixe(
        'PUBLIC',
        'Université d\'Orléans',
        'universite.php'
    );
}

########################################################################################################################
# B.V - Events                                                                                                         #
########################################################################################################################
function afficherEvents($tri, $aVenir, $passes, $rechercheEnCours) {
    define('TITLE', 'Évents');
    define('GABARIT', 'events.php');

    if ($rechercheEnCours) {
        $rechercheEnCoursStr = 'true';
    } else {
        $rechercheEnCoursStr = 'false';
    }
    if ($aVenir) {
        $checkedAVenir = ' checked';
    } else {
        $checkedAVenir = '';
    }
    if ($passes) {
        $checkedPasses = ' checked';
    } else {
        $checkedPasses = '';
    }

    $tableEvents = '';
    $lignesEvents = eventsTous($tri, $aVenir, $passes, -1);

    if (empty($lignesEvents)) {
        $tableEvents = '<h3>Hmmm... On dirait qu\'il n\'y a aucun évent qui correspond à vos critères de recherches 🤔</h3>';
    }

    $pair = true; // On commence à 0 en informatique.
    foreach ($lignesEvents as $ligne) {
        $id = htmlentities($ligne->idEvents, ENT_QUOTES, "UTF-8");
        $titre = htmlentities($ligne->titreEvents, ENT_QUOTES, "UTF-8");
        $date = htmlentities($ligne->dateEvents, ENT_QUOTES, "UTF-8");
        $heure = htmlentities($ligne->heureEvents, ENT_QUOTES, "UTF-8");
        $lieu = htmlentities($ligne->lieuEvents, ENT_QUOTES, "UTF-8");
        $nbJours = round((strtotime($date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
        $nbJoursStr = '';
        $couleur = '';
        if ($nbJours == 0) {
            $nbJoursStr .= '<strong><span style="color: red"> (Aujourd\'hui)</span></strong>';
        } elseif ($nbJours == 1) {
            $nbJoursStr .= '<strong><span style="color: red"> (Demain)</span></strong>';
        } elseif ($nbJours > 0) {
            $nbJoursStr .= ' (dans ' . $nbJours . ' jours)';
        } else {
            $couleur = ' style="background-color: #d1d2ce"';
        }

        if ($pair) {
            $tableEvents .= '<div class="row">';
        }
        $tableEvents .=
            '<div class="col-sm-6">' .
                '<div class="well" ' . $couleur . '>' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>📅 ' . genererDate($date) . $nbJoursStr . '</h4>' .
                    '<h4>⌚️ ' . substr($heure, 0, 2) . 'h' . substr($heure, 3, 2) . '</h4>' .
                    '<h4>📍️ ' . $lieu . '</h4>' .
                    '<a class="btn btn-danger btn-block" href="' . RACINE . 'events/?id=' . $id . '">' .
                        '<h4>Détails</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
        if (!$pair) {
            $tableEvents .= '</div>';
            $pair = true;
        } else {
            $pair = false;
        }
    }
    if (!$pair) { // Si c'est pair il fait fermer la balise.
        $tableEvents .= '</div>';
    }

    define('TRI', $tri);
    define('RECHERCHE_EN_COURS', $rechercheEnCoursStr);
    define('CHECKED_A_VENIR', $checkedAVenir);
    define('CHECKED_PASSES', $checkedPasses);
    define('EVENTS', $tableEvents);

    afficherCadre('PUBLIC');
}

function afficherEventPrecis($event) {
    // define('TITLE', 'Évents');
    define('GABARIT', 'eventPrecis.php');

    $date = $event->idEvents;
    $nbJours = round((strtotime($date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
    $nbJoursStr = '';
    if ($nbJours == 0) {
        $nbJoursStr .= '<strong><span style="color: red">(Aujourd\'hui)</span></strong>';
    } elseif ($nbJours == 1) {
        $nbJoursStr .= '<strong><span style="color: red">(Demain)</span></strong>';
    } elseif ($nbJours > 0) {
        $nbJoursStr .= '(dans ' . $nbJours . ' jours)';
    } else {
        $nbJoursStr .= '<i><span style="color: darkgray">(Il y a ' . abs($nbJours) . ' jours)</span></i>';
    }
    $heureStr = substr($event->heureEvents, 0, 2) . 'h' . substr($event->heureEvents, 3, 2);

    define('ID', $event->idEvents);
    define('TITRE', htmlentities($event->titreEvents, ENT_QUOTES, "UTF-8"));
    define('DESC', nl2br(htmlentities($event->descEvents, ENT_QUOTES, "UTF-8")));
    define('DATE', genererDate($event->dateEvents));
    define('HEURE', $heureStr);
    define('LIEU', htmlentities($event->lieuEvents, ENT_QUOTES, "UTF-8"));
    define('NB_JOURS', $nbJoursStr);
    define('TITLE', TITRE); // Ici.

    afficherCadre('PUBLIC');
}

########################################################################################################################
# B.VI - Goodies                                                                                                       #
########################################################################################################################
function afficherGoodies($tri, $disponible, $bientot, $rupture, $rechercheEnCours) {
    define('TITLE', 'Goodies');
    define('GABARIT', 'goodies.php');

    if ($rechercheEnCours) {
        $rechercheEnCoursStr = 'true';
    } else {
        $rechercheEnCoursStr = 'false';
    }
    if ($disponible) {
        $checkedDisponible = ' checked';
    } else {
        $checkedDisponible = '';
    }
    if ($bientot) {
        $checkedBientot = ' checked';
    } else {
        $checkedBientot = '';
    }
    if ($rupture) {
        $checkedRupture = ' checked';
    } else {
        $checkedRupture = '';
    }

    $tableGoodies = '';
    $lignesGoodies = goodiesTous($tri, $disponible, $bientot, $rupture);

    if (empty($lignesGoodies)) {
        $tableGoodies = '<h3>Hmmm... On dirait qu\'il n\'y a aucun goodie qui correspond à vos critères de recherches 🤔</h3>';
    }

    foreach ($lignesGoodies as $ligne) {
        $id = htmlentities($ligne->idGoodies, ENT_QUOTES, "UTF-8");
        $titre = htmlentities($ligne->titreGoodies, ENT_QUOTES, "UTF-8");
        $prixAdherent = htmlentities($ligne->prixADGoodies, ENT_QUOTES, "UTF-8");
        $prixNonAdherent = htmlentities($ligne->prixNADGoodies, ENT_QUOTES, "UTF-8");
        $categorie = htmlentities($ligne->categorieGoodies, ENT_QUOTES, "UTF-8");
        $miniature = htmlentities($ligne->miniatureGoodies, ENT_QUOTES, "UTF-8");

        $lienMiniature = RACINE . 'goodies/' . $miniature;
        switch ($categorie) {
            case 1:
                $categorieStr = '<span style="color: darkgreen">Disponible</span>';
                break;
            case 2:
                $categorieStr = '<span style="color: darkblue">Bientôt disponible</span>';
                break;
            case 3:
                $categorieStr = '<span style="color: darkred">En rupture de stock</span>';
                break;
            default:
                $categorieStr = '<span style="color: red">Une erreur s\'est produite.</span>';
                break;
        }

        $tableGoodies .=
            '<div class="col-sm-6">' .
                '<div class="well">' .
                    '<a href="' . RACINE . 'goodies/?id=' . $id . '">' .
                        '<img src="' . $lienMiniature . '" class="miniatureGoodies" alt="Miniature">' .
                    '</a>' .
                    '<h3>' . $titre . '</h3>' .
                    '<hr>' .
                    '<h4><strong>' . $categorieStr . '</strong></h4>' .
                    '<h4>Prix pour les adhérents : ' . $prixAdherent . '€</h4>' .
                    '<h4>Prix pour les non-adhérents : ' . $prixNonAdherent . '€</h4>' .
                    '<a class="btn btn-danger btn-block" href="' . RACINE . 'goodies/?id=' . $id . '">' .
                        '<h4>Détails</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    define('RECHERCHE_EN_COURS', $rechercheEnCoursStr);
    define('CHECKED_DISPONIBLE', $checkedDisponible);
    define('CHECKED_BIENTOT', $checkedBientot);
    define('CHECKED_RUPTURE', $checkedRupture);
    define('GOODIES', $tableGoodies);

    afficherCadre('PUBLIC');
}

function afficherGoodiePrecis($goodie) {
    // define('TITLE', 'Évents');
    define('GABARIT', 'goodiePrecis.php');

    $id = $goodie->idGoodies;
    $miniature = $goodie->miniatureGoodies;
    $lignesImages = imagesGoodie($id);

    $carouselGoodie = '';
    if (empty($lignesImages)) {
        $carouselGoodie .= '<img src="' . RACINE . 'goodies/' . $miniature . '" class="imageUniqueGoodiePrecis">';
    } else {
        $nb = 0;
        $carouselGoodieIndicator = '<ol class="carousel-indicators">';
        $carouselGoodieImages = '<div class="carousel-inner" role="listbox">';

        # Image miniature
        $carouselGoodieIndicator .= '<li data-target="#carouselGoodie" data-slide-to="' . $nb++ . '" class="active"></li>';
        $carouselGoodieImages .=
            '<div class="item active">' .
                '<img src="' . RACINE . 'goodies/' . $miniature . '" alt="Image">' .
            '</div>';

        # Le reste des -images
        foreach ($lignesImages as $ligne) {
            $lien = $ligne->lienImagesGoodies;
            $carouselGoodieIndicator .= '<li data-target="#carouselGoodie" data-slide-to="' . $nb++ . '"></li>';
            $carouselGoodieImages .=
                '<div class="item">' .
                    '<img src="' . RACINE . 'goodies/' . $lien . '" alt="Image">' .
                '</div>';
        }
        $carouselGoodieIndicator .= '</ol>';
        $carouselGoodieImages .= '</div>';

        $carouselGoodie =
            '<div id="carouselGoodie" class="carousel carouselImages slide" data-ride="carousel">' .
                $carouselGoodieIndicator .
                $carouselGoodieImages .
                '<a class="left carousel-control" href="#carouselGoodie" role="button" data-slide="prev">' .
                    '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' .
                    '<span class="sr-only">Previous</span>' .
                '</a>' .
                '<a class="right carousel-control" href="#carouselGoodie" role="button" data-slide="next">' .
                    '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' .
                    '<span class="sr-only">Next</span>' .
                '</a>' .
            '</div>';
    }

    define('ID', $id);
    define('TITRE', htmlentities($goodie->titreGoodies, ENT_QUOTES, "UTF-8"));
    define('PRIX_AD', $goodie->prixADGoodies);
    define('PRIX_NAD', $goodie->prixNADGoodies);
    define('CATEGORIE', $goodie->categorieGoodies);
    define('DESC', nl2br(htmlentities($goodie->descGoodies, ENT_QUOTES, "UTF-8")));
    define('CAROUSEL_GOODIES', $carouselGoodie);
    define('TITLE', TITRE); // Ici.

    afficherCadre('PUBLIC');
}

########################################################################################################################
# B.VII - Journaux                                                                                                     #
########################################################################################################################
function afficherJournaux() {
    define('TITLE', 'Journaux');
    define('GABARIT', 'journaux.php');

    $tableJournaux = '';
    $lignesJournaux = journauxTous(-1);

    foreach ($lignesJournaux as $ligne) {
        $titre = htmlentities($ligne->titreJournaux, ENT_QUOTES, "UTF-8");;
        $date = htmlentities($ligne->dateJournaux, ENT_QUOTES, "UTF-8");
        $pdf = htmlentities($ligne->pdfJournaux, ENT_QUOTES, "UTF-8");

        $lienJournal = RACINE . 'journaux/' . $pdf;

        $tableJournaux .=
            '<div class="col-sm-3">' .
                '<div class="well">' .
                    '<h3>' . $titre . '</h3>' .
                    '<h5>' . preg_replace('/^[^ ]* /', '', genererDate($date)) . '</h5>' .
                    '<a href="' . $lienJournal . '" class="btn btn-danger btn-block">' .
                        '<h4 class="alterneur-grand-tres-petit"><img src="' . RACINE . '-images/imgPdf.svg" height="28" alt="(PDF)">&emsp;Lire en ligne</h4>' .
                        '<h4 class="alterneur-petit">Lire</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    define('JOURNAUX', $tableJournaux);

    afficherCadre('PUBLIC');
}

########################################################################################################################
# B.VIII - Mentions légales                                                                                            #
########################################################################################################################
function afficherMentionsLegales() {
    afficherPageFixe(
        'PUBLIC',
        'Mentions légales',
        'mentionsLegales.php'
    );
}

########################################################################################################################
# B.IX - Plan du site                                                                                                  #
########################################################################################################################
function afficherPlanDuSite() {
    define('TITLE', 'Plan du site');
    define('GABARIT', 'planDuSite.php');

    function allerChercherString($a) {
        if (gettype($a) == 'string') {
            return $a;
        }
        return allerChercherString($a[0]);
    }

    function trierEnfants($e1, $e2) {
        return strcmp(
            preg_replace(
                '/index.php\//',
                '',
                allerChercherString($e1)
            ),
            preg_replace(
                '/index.php\//',
                '',
                allerChercherString($e2)
            )
        );
    }

    function chercherTousLesEnfants($cheminParent) {
        if (!is_dir($cheminParent)) {
            return $cheminParent;
        }
        $enfants = array_diff(scandir($cheminParent), ['.', '..']);
        if ($enfants == NULL) {
            return $cheminParent;
        } else {
            $arrayEnfants = [];
            foreach ($enfants as $enfant) {
                $arrayEnfants[] = chercherTousLesEnfants($cheminParent . $enfant . '/');
            }
            usort($arrayEnfants, "trierEnfants");
            return $arrayEnfants;
        }
    }

    function construireListe($array) {
        if (gettype($array) == 'string') {
            $chemin = explode('/', $array);
            $cheminInverse = array_reverse($chemin);
            $lien = implode('/', array_diff($chemin, ['index.php', '']));
            if ($cheminInverse[1] == 'index.php') {
                if ($cheminInverse[2] == '..') {
                    return '<a href="' . $lien . '" class="list-group-item list-group-item-danger">' . 'accueil' . '</a>';
                }
                return '<a href="' . $lien . '" class="list-group-item list-group-item-danger">' . $cheminInverse[2] . '</a>';
            }
            return '';
        } else {
            $str = '<div class="list-group-item"><div class="list-group">';
            foreach ($array as $value) {
                $str .= construireListe($value);
            }
            $str .= '</div></div>';
            return $str;
        }
    }

    function optimiserListe($liste) {
        $oldListe = '';
        while ($oldListe != $liste) {
            $oldListe = $liste;
            $liste = preg_replace('/<div class="list-group-item"><\/div>/', '', $liste);
            $liste = preg_replace('/<div class="list-group"><\/div>/', '', $liste);
        }
        return $liste;
    }

    function retirerDivEnglobant($liste) {
        $liste = preg_replace('/^<div class="list-group-item">/', '', $liste);
        $liste = preg_replace('/<\/div>$/', '', $liste);
        return $liste;
    }

    $plan = retirerDivEnglobant(optimiserListe(construireListe(chercherTousLesEnfants(RACINE))));

    define('PLAN', $plan);
    afficherCadre('PUBLIC');
}

########################################################################################################################
# B.X - Riad (temporaire)                                                                                              #
########################################################################################################################
function afficherRiad() {
    afficherPageFixe(
        'PUBLIC',
        'Riad',
        'riad.php'
    );
}

########################################################################################################################
# B.XI - Erreur                                                                                                        #
########################################################################################################################
function afficherErreur($messageErreur) {
    define('TITLE', 'Une erreur s\'est produite');
    define('GABARIT', 'erreur.php');
    define('MESSAGE_ERREUR', $messageErreur);
    afficherCadre('PUBLIC');
}