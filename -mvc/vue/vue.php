<?php
########################################################################################################################
# Admin                                                                                                                #
########################################################################################################################
# Système
function afficherConnexion($prefixe, $messageRetour) {
    $title = 'Connexion';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritConnexion.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherMenu($prefixe, $messageRetour) {
    $title = 'Menu administrateur';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritMenu.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    require_once($prefixe . '-mvc/vue/cadre.php');
}

# Events
function afficherCreerEvent($prefixe, $messageRetour) {
    $title = 'Créer un évent';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritCreerEvent.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherChoixEvent($prefixe, $messageRetour) {
    $title = 'Choisir un évent';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritChoixEvent.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherModifierEvent($prefixe, $messageRetour, $id) {
    $title = 'Modifier un évent';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritModifierEvent.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $ligneEvent = eventPrecis($id);

    $idEvents = $id;
    $titreEvents = $ligneEvent->titreEvents;
    $descEvents = $ligneEvent->descEvents;
    $dateEvents = $ligneEvent->dateEvents;
    $heureEvents = $ligneEvent->heureEvents;
    $lieuEvents = $ligneEvent->lieuEvents;

    $heure = substr($heureEvents, 0, 2);
    $minute = substr($heureEvents, 3, 2);

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherSupprimerEvent($prefixe, $messageRetour) {
    $title = 'Supprimer un évent';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritSupprimerEvent.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

# Goodies
function afficherAjouterGoodie($prefixe, $messageRetour) {
    $title = 'Ajouter un goodie';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAjouterGoodie.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherAjouterImageGoodie($prefixe, $messageRetour) {
    $title = 'Ajouter une image à un goodie';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAjouterImageGoodie.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $lignesGoodies = idTitreGoodies();

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">' . $titreGoodie . '</option>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherChoixGoodie($prefixe, $messageRetour) {
    $title = 'Choisir un goodie';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritChoixGoodie.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherModifierGoodie($prefixe, $messageRetour, $id) {
    $title = 'Modifier un goodie';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritModifierGoodie.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $ligneGoodie = goodiePrecis($id);

    $idGoodie = $id;
    $titreGoodie = $ligneGoodie->titreGoodies;
    $prixADEuroGoodie = intval($ligneGoodie->prixADGoodies);
    $prixADCentimesGoodie = intval(($ligneGoodie->prixADGoodies - intval($prixADEuroGoodie)) * 100);
    $prixNADEuroGoodie = intval($ligneGoodie->prixNADGoodies);
    $prixNADCentimesGoodie = intval(($ligneGoodie->prixNADGoodies - intval($prixNADEuroGoodie)) * 100);
    $categorieGoodie = $ligneGoodie->categorieGoodies;
    $descGoodie = $ligneGoodie->descGoodies;

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherSupprimerImageGoodie($prefixe, $messageRetour, $id) {
    $title = 'Supprimer une image d\'un goodie';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritSupprimerImageGoodie.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $idGoodie = $id;

    $lignesImages = imagesGoodie($id);
    $images = '';

    foreach ($lignesImages as $ligne) {
        $idImage = $ligne->idImagesGoodies;
        $lienImage = $ligne->lienImagesGoodies;

        $images .=
            '<div class="form-group">' .
            '<label for="' . $idImage . '"><img src="' . $prefixe . 'goodies/' . $lienImage . '" width="200" height="100" alt="img"></label>' .
            '<input class="form-control" type="checkbox" name="' . $idImage . '" id="' . $idImage . '">' .
            '</div>' .
            '<br>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherSupprimerGoodie($prefixe, $messageRetour) {
    $title = 'Supprimer un goodie';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritSupprimerGoodie.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

# Journaux
function afficherAjouterJournal($prefixe, $messageRetour) {
    $title = 'Ajouter un journal';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAjouterJournal.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherSupprimerJournal($prefixe, $messageRetour) {
    $title = 'Supprimer un journal';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritSupprimerJournal.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $lignesJournaux = idTitreJournaux();

    $journaux = '';
    foreach ($lignesJournaux as $ligneJournal) {
        $idJournal = htmlentities($ligneJournal->idJournaux, ENT_QUOTES, "UTF-8");
        $titreJournal = htmlentities($ligneJournal->titreJournaux, ENT_QUOTES, "UTF-8");
        $journaux .=
            '<option value="' . $idJournal . '">' . $titreJournal . '</option>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

# Articles
function afficherAjouterArticle($prefixe, $messageRetour) {
    $title = 'Ajouter un article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAjouterArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $categories .=
            '<option value="' . $idCategorieArticle . '">' . $titreCategorieArticle . '</option>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherAjouterImageArticle($prefixe, $messageRetour) {
    $title = 'Ajouter une image à un article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAjouterImageArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherChoixArticle($prefixe, $messageRetour) {
    $title = 'Choisir un article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritChoixArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherModifierArticle($prefixe, $messageRetour, $id) {
    $title = 'Modifier un Article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritModifierArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $ligneArticle = articlePrecis($id);

    $idArticle = $id;
    $titreArticle = $ligneArticle->titreArticles;
    $categorieArticle = $ligneArticle->idCategoriesArticles;
    $visibiliteArticle = $ligneArticle->visibiliteArticles;
    $texteArticle = $ligneArticle->texteArticles;

    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idCategorieArticle = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreCategorieArticle = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $selected = $categorieArticle == $idCategorieArticle ? ' selected' : '';
        $categories .=
            '<option value="' . $idCategorieArticle . '"' . $selected . '>' . $titreCategorieArticle . '</option>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherSupprimerImageArticle($prefixe, $messageRetour, $id) {
    $title = 'Supprimer une image d\'un article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritSupprimerImageArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $idArticle = $id;

    $lignesImages = imagesArticle($id);
    $images = '';

    foreach ($lignesImages as $ligne) {
        $idImage = $ligne->idImagesArticles;
        $lienImage = $ligne->lienImagesArticles;

        $images .=
            '<div class="form-group">' .
            '<label for="' . $idImage . '"><img src="' . $prefixe . 'articles/' . $lienImage . '" width="200" height="100" alt="img"></label>' .
            '<input class="form-control" type="checkbox" name="' . $idImage . '" id="' . $idImage . '">' .
            '</div>' .
            '<br>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherAjouterCategorieArticle($prefixe, $messageRetour) {
    $title = 'Ajouter une catégorie d\'article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAjouterCategorieArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherRenommerCategorieArticle($prefixe, $messageRetour) {
    $title = 'Renommer une catégorie d\'article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritRenommerCategorieArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $lignesCategoriesArticle = idTitreCategoriesArticles();

    $categories = '';
    foreach ($lignesCategoriesArticle as $ligneCategorisArticle) {
        $idGoodie = htmlentities($ligneCategorisArticle->idCategoriesArticles, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneCategorisArticle->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $categories .=
            '<option value="' . $idGoodie . '">' . $titreGoodie . '</option>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherSupprimerArticle($prefixe, $messageRetour) {
    $title = 'Supprimer un article';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritSupprimerArticle.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

# Log
function afficherAfficherLog($prefixe, $messageRetour) {
    $title = 'Log';
    $header = $prefixe . '-mvc/vue/gabaritsAdmin/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsAdmin/gabaritAfficherLog.php';
    $footer = $prefixe . '-mvc/vue/gabaritsAdmin/footer.php';
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = htmlentities($ligneInfoMembre->nomMembre, ENT_QUOTES, "UTF-8");

    $lignesLog = logTous();

    $log = '';
    foreach ($lignesLog as $ligneLog) {
        $idMembre = htmlentities($ligneLog->idMembre, ENT_QUOTES, "UTF-8");
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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Accueil                                                                                                              #
########################################################################################################################
function afficherAccueil($prefixe) {
    $title = 'Accueil';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritAccueil.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

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
        $lienMiniature = $prefixe . 'goodies/' . $miniatureGoodie;

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
                '<a href="' . $prefixe . 'goodies/?id=' . $idGoodie . '"><img src="' . $lienMiniature . '" alt="Image"></a>' . "\n" .
                '<div class="carousel-caption">' . "\n" .
                    '<a href="' . $prefixe . 'goodies/?id=' . $idGoodie . '"><h3>' . $titreGoodie . '</h3></a>' . "\n" .
                    '<p>' . $prixAdherentGoodie . '€ Adhérent | ' . $prixNonAdherentGoodie . '€ Non-adhérent</p>' . "\n" .
                '</div>' . "\n" .
            '</div>';
    }

    # Events
    $lignesEvents = eventsTous('PF', true, false, 3);
    $events = '';

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

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
        $hide = '';
        if ($count == 3) {
            $hide = ' accueilTroisiemeEvent';
        }
        $events .=
            '<a href="' . $prefixe . 'events/?id=' . $idEvent . '">' .
                '<div class="well' . $hide . '">' .
                    '<h4>' . $titreEvent . '</h4>' .
                    '<p>📅 ' . substr($dateEvent, 8, 2) . ' ' . $arrayMois[substr($dateEvent, 5, 2)] . $nbJoursStr . '</p>' .
                    '<p>⌚️ ' . substr($heureEvent, 0, 2) . 'h' . substr($heureEvent, 3, 2) . '</p>' .
                    '<p>📍 ' . $lieuEvent . '</p>' .
                '</div>' .
            '</a>';
    }

    # Journal
    $lignesJournaux = journauxTous(2);
    $journaux ='';

    foreach ($lignesJournaux as $ligneJournal) {
        $titre = htmlentities($ligneJournal->titreJournaux, ENT_QUOTES, "UTF-8");;
        $date = htmlentities($ligneJournal->dateJournaux, ENT_QUOTES, "UTF-8");
        $pdf = htmlentities($ligneJournal->pdfJournaux, ENT_QUOTES, "UTF-8");

        $lienJournal = $prefixe . 'journaux/' . $pdf;

        $journaux .=
            '<div class="col-sm-3">' .
                '<div class="well">' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . '</h4>' .
                    '<a href="' . $lienJournal . '">' .
                        '<h4><img src="' . $prefixe . '-images/imgPdf.svg" width="32" height="32" alt="(PDF)"> Lire en ligne</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function afficherArticles($prefixe) {
    $title = 'Articles';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritArticles.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    $tableArticles = '';
    $lignesArticles = articlesTous();

    if (empty($lignesArticles)) {
        $tableArticles = '<h3>Hmmm... On dirait qu\'il n\'y a aucun évent qui correspond à vos critères de recherches 🤔</h3>';
    }

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    foreach ($lignesArticles as $ligne) {
        $id = htmlentities($ligne->idArticles, ENT_QUOTES, "UTF-8");
        $titre = htmlentities($ligne->titreArticles, ENT_QUOTES, "UTF-8");
        $categorie = htmlentities($ligne->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
        $visibilite = htmlentities($ligne->visibiliteArticles, ENT_QUOTES, "UTF-8");
        $dateCreation = htmlentities($ligne->dateCreationArticles, ENT_QUOTES, "UTF-8");
        $dateModification = htmlentities($ligne->dateModificationArticles, ENT_QUOTES, "UTF-8");
        $texte = htmlentities($ligne->texteArticles, ENT_QUOTES, "UTF-8");
        $auteur = htmlentities($ligne->nomMembre, ENT_QUOTES, "UTF-8");

        if ($visibilite == 0) {
            continue;
        }

        $texteNonFormate = preg_replace('/&sect;!?L(\[.*\])?/', '', preg_replace('/\n/', ' ', preg_replace('/&sect;!?[GISBCT]/', '', $texte)));
        $texteNonFormateMini = substr($texteNonFormate, 0, 100);

        $tableArticles .=
            '<div class="row">' .
                '<div class="col-sm-2"></div>' .
                    '<div class="col-sm-8">' .
                        '<div class="well">' .
                            '<h4 class="pc">' . $categorie . '</h4>' .
                            '<hr>' .
                            '<h2>' . $titre . '</h2>' .
                            '<small>Publié le ' . substr($dateCreation, 8, 2) . ' ' . $arrayMois[substr($dateCreation, 5, 2)] . ' ' . substr($dateCreation, 0, 4) . '</small>' .
                            '<hr>' .
                            '<p class="text-left retrait">' . $texteNonFormate . (strlen($texte) > 100 ? '[...]' : '')  . '</p>' .
                            '<hr>' .
                            '<a class="btn btn-primary btn-block" href="' . $prefixe . 'articles/?id=' . $id . '">' .
                                'Lire l\'article' .
                            '</a>' .
                        '</div>' .
                    '</div>' .
                '<div class="col-sm-2"></div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherArticlePrecis($prefixe, $article) {
    // $title = 'Article'; Voir ci-après.
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritArticlePrecis.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    $id = htmlentities($article->idArticles, ENT_QUOTES, "UTF-8");
    $titre = htmlentities($article->titreArticles, ENT_QUOTES, "UTF-8");
    $categorie = htmlentities($article->titreCategoriesArticles, ENT_QUOTES, "UTF-8");
    $visibilite = htmlentities($article->visibiliteArticles, ENT_QUOTES, "UTF-8");
    $dateCreation = htmlentities($article->dateCreationArticles, ENT_QUOTES, "UTF-8");
    $dateModification = htmlentities($article->dateModificationArticles, ENT_QUOTES, "UTF-8");
    $texte = htmlentities($article->texteArticles, ENT_QUOTES, "UTF-8");
    $auteur = htmlentities($article->nomMembre, ENT_QUOTES, "UTF-8");

    $title = $titre;

    $lignesImages = imagesArticle($id);

    $carouselArticle = '';
    if (!empty($lignesImages) && count($lignesImages) <= 1) {
        $carouselArticle =
            '<div class="row">' .
                '<div class="col-sm-2"></div>'.
                    '<div class="col-sm-8">' .
                        '<img src="' . $prefixe . 'articles/' . $lignesImages[0]->lienImagesArticles . '" class="imageUniqueArticlePrecis" alt="Image">' .
                    '</div>' .
                '<div class="col-sm-2"></div>' .
            '</div><br>';;
    } elseif (!empty($lignesImages)) {
        $nb = 0;
        $carouselArticleIndicator = '<ol class="carousel-indicators">';
        $carouselArticleImages = '<div class="carousel-inner" role="listbox">';

        # Le reste des -images
        foreach ($lignesImages as $ligne) {
            $lien = $ligne->lienImagesArticles;
            $carouselArticleIndicator .= '<li data-target="#carouselArticle" data-slide-to="' . $nb++ . '"' . ($nb == 1 ? ' class="active"' : '') . '></li>';
            $carouselArticleImages .=
                '<div class="item' . ($nb == 1 ? ' active' : '') . '">' .
                    '<img src="' . $prefixe . 'articles/' . $lien . '" alt="Image">' .
                '</div>';
        }
        $carouselArticleIndicator .= '</ol>';
        $carouselArticleImages .= '</div>';

        $carouselArticle =
            '<div class="row">' .
                '<div class="col-sm-2"></div>' .
                '<div class="col-sm-8">' .
                    '<div id="carouselArticle" class="carousel slide" data-ride="carousel">' .
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
            '</div><br>';
    }

    $texteFormate = preg_replace('/\n(\n)*/', "\n", $texte);
    $texteFormate = preg_replace('/\n/', '</p><p>', $texteFormate);
    $texteFormate = preg_replace('/\n/', '<p>', $texteFormate);
    $texteFormate = '<p>' . $texteFormate . '</p>';
    $texteFormate = preg_replace('/&sect;G/', '<strong>', $texteFormate);
    $texteFormate = preg_replace('/&sect;!G/', '</strong>', $texteFormate);
    $texteFormate = preg_replace('/&sect;I/', '<i>', $texteFormate);
    $texteFormate = preg_replace('/&sect;!I/', '</i>', $texteFormate);
    $texteFormate = preg_replace('/&sect;S/', '<u>', $texteFormate);
    $texteFormate = preg_replace('/&sect;!S/', '</u>', $texteFormate);
    $texteFormate = preg_replace('/&sect;B/', '<span style="text-decoration: line-through;">', $texteFormate);
    $texteFormate = preg_replace('/&sect;!B/', '</span>', $texteFormate);
    $texteFormate = preg_replace('/&sect;C/', '<span class="pc">', $texteFormate);
    $texteFormate = preg_replace('/&sect;!C/', '</span>', $texteFormate);

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Erreur                                                                                                               #
########################################################################################################################
function afficherErreur($prefixe, $messageErreur) {
    $title = 'Une erreur s\'est produite';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritErreur.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association (Présentation)                                                                                           #
########################################################################################################################
function afficherPresentation($prefixe) {
    $title = 'Présentation';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritPresentation.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Contact                                                                                                #
########################################################################################################################
function afficherContact($prefixe) {
    $title = 'Contact';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritContact.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Fonctionnement                                                                                         #
########################################################################################################################
function afficherFonctionnement($prefixe) {
    $title = 'Fonctionnement de l\'association';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritFonctionnement.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Historique                                                                                             #
########################################################################################################################
function afficherHistorique($prefixe) {
    $title = 'Historique de l\'association';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritHistorique.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Où nous trouver ?                                                                                      #
########################################################################################################################
function afficherOuNousTrouver($prefixe) {
    $title = 'Où nous trouver ?';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritOuNousTrouver.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Partenaires                                                                                            #
########################################################################################################################
function afficherPartenaires($prefixe) {
    $title = 'Partenaires';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritPartenaires.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Pôles                                                                                                  #
########################################################################################################################
function afficherPoles($prefixe) {
    $title = 'Pôles';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritPoles.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Pourquoi adhérer ?                                                                                     #
########################################################################################################################
function afficherPourquoiAdherer($prefixe) {
    $title = 'Pourquoi adhérer ?';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritPourquoiAdherer.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Réseau associatif                                                                                      #
########################################################################################################################
function afficherReseauAssociatif($prefixe) {
    $title = 'Réseau associatif';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritReseauAssociatif.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Réseau associatif - ÔCampus                                                                            #
########################################################################################################################
function afficherOCampus($prefixe) {
    $title = 'ÔCampus';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritOCampus.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Réseau associatif - FNEB                                                                               #
########################################################################################################################
function afficherFneb($prefixe) {
    $title = 'FNEB';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritFneb.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Réseaus sociaux                                                                                        #
########################################################################################################################
function afficherReseauxSociaux($prefixe) {
    $title = 'Réseaux sociaux';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritReseauxSociaux.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Association - Université                                                                                             #
########################################################################################################################
function afficherUniversite($prefixe) {
    $title = 'Université d\'Orléans';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritUniversite.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Events                                                                                                               #
########################################################################################################################
function afficherEvents($prefixe, $tri, $aVenir, $passes, $rechercheEnCours) {
    $title = 'Évents';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritEvents.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

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

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    $pair = true; // On commence à 0 en informatique.
    foreach ($lignesEvents as $ligne) {
        $id = htmlentities($ligne->idEvents, ENT_QUOTES, "UTF-8");
        $titre = htmlentities($ligne->titreEvents, ENT_QUOTES, "UTF-8");
        $desc = htmlentities($ligne->descEvents, ENT_QUOTES, "UTF-8");
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
                '<div class="well"' . $couleur . '>' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>📅 ' . substr($date, 8, 2) . ' ' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . $nbJoursStr . '</h4>' .
                    '<h4>⌚️ ' . substr($heure, 0, 2) . 'h' . substr($heure, 3, 2) . '</h4>' .
                    '<h4>📍️ ' . $lieu . '</h4>' .
                    '<a class="btn btn-primary" href="' . $prefixe . 'events/?id=' . $id . '">' .
                        'Voir les détails...' .
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

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherEventPrecis($prefixe, $event) {
    // $title = 'Event'; Voir ci-après.
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritEventPrecis.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    $id = htmlentities($event->idEvents, ENT_QUOTES, "UTF-8");
    $titre = htmlentities($event->titreEvents, ENT_QUOTES, "UTF-8");
    $desc = htmlentities($event->descEvents, ENT_QUOTES, "UTF-8");
    $date = htmlentities($event->dateEvents, ENT_QUOTES, "UTF-8");
    $heure = htmlentities($event->heureEvents, ENT_QUOTES, "UTF-8");
    $lieu = htmlentities($event->lieuEvents, ENT_QUOTES, "UTF-8");
    $nbJours = round((strtotime($date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));

    $title = $titre;

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

    $descStr = nl2br($desc);
    $dateStr = substr($date, 8, 2) . ' ' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4);
    $heureStr = substr($heure, 0, 2) . 'h' . substr($heure, 3, 2);

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function afficherGoodies($prefixe, $tri, $disponible, $bientot, $rupture, $rechercheEnCours) {
    $title = 'Goodies';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritGoodies.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

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

        // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock
        if ($categorie == 0) {
            continue;
        }
        $lienMiniature = $prefixe . 'goodies/' . $miniature;
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
                    '<a href="' . $prefixe . 'goodies/?id=' . $id . '">' .
                        '<img src="' . $lienMiniature . '" class="miniatureGoodies" alt="Miniature">' .
                    '</a>' .
                    '<h3>' . $titre . '</h3>' .
                    '<hr>' .
                    '<h4><strong>' . $categorieStr . '</strong></h4>' .
                    '<h4>Prix pour les adhérents : ' . $prixAdherent . '€</h4>' .
                    '<h4>Prix pour les non-adhérents : ' . $prixNonAdherent . '€</h4>' .
                    '<a class="btn btn-primary" href="' . $prefixe . 'goodies/?id=' . $id . '">' .
                        'Voir les détails...' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

function afficherGoodiePrecis($prefixe, $goodie) {
    // $title = 'Goodies'; Voir ci-après.
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritGoodiePrecis.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    $id = htmlentities($goodie->idGoodies, ENT_QUOTES, "UTF-8");
    $titreGoodie = htmlentities($goodie->titreGoodies, ENT_QUOTES, "UTF-8");
    $prixAdherent = htmlentities($goodie->prixADGoodies, ENT_QUOTES, "UTF-8");
    $prixNonAdherent = htmlentities($goodie->prixNADGoodies, ENT_QUOTES, "UTF-8");
    $categorie = htmlentities($goodie->categorieGoodies, ENT_QUOTES, "UTF-8");
    $descGoodie = htmlentities($goodie->descGoodies, ENT_QUOTES, "UTF-8");
    $miniature = htmlentities($goodie->miniatureGoodies, ENT_QUOTES, "UTF-8");

    $title = $titreGoodie;

    $lignesImages = imagesGoodie($id);

    $carouselGoodie = '';
    if (empty($lignesImages)) {
        $carouselGoodie .= '<img src="' . $prefixe . 'goodies/' . $miniature . '" class="imageUniqueGoodiePrecis">';
    } else {
        $nb = 0;
        $carouselGoodieIndicator = '<ol class="carousel-indicators">';
        $carouselGoodieImages = '<div class="carousel-inner" role="listbox">';

        # Image miniature
        $carouselGoodieIndicator .= '<li data-target="#carouselGoodie" data-slide-to="' . $nb++ . '" class="active"></li>';
        $carouselGoodieImages .=
            '<div class="item active">' .
                '<img src="' . $prefixe . 'goodies/' . $miniature . '" alt="Image">' .
            '</div>';

        # Le reste des -images
        foreach ($lignesImages as $ligne) {
            $lien = $ligne->lienImagesGoodies;
            $carouselGoodieIndicator .= '<li data-target="#carouselGoodie" data-slide-to="' . $nb++ . '"></li>';
            $carouselGoodieImages .=
                '<div class="item">' .
                    '<img src="' . $prefixe . 'goodies/' . $lien . '" alt="Image">' .
                '</div>';
        }
        $carouselGoodieIndicator .= '</ol>';
        $carouselGoodieImages .= '</div>';

        $carouselGoodie =
            '<div id="carouselGoodie" class="carousel slide" data-ride="carousel">' .
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

    $descStr = nl2br($descGoodie);

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function afficherJournaux($prefixe) {
    $title = 'Journaux';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritJournaux.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    $tableJournaux = '';
    $lignesJournaux = journauxTous(-1);

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    foreach ($lignesJournaux as $ligne) {
        $titre = htmlentities($ligne->titreJournaux, ENT_QUOTES, "UTF-8");;
        $date = htmlentities($ligne->dateJournaux, ENT_QUOTES, "UTF-8");
        $pdf = htmlentities($ligne->pdfJournaux, ENT_QUOTES, "UTF-8");

        $lienJournal = $prefixe . 'journaux/' . $pdf;

        $tableJournaux .=
            '<div class="col-sm-3">' .
                '<div class="well">' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . '</h4>' .
                    '<a href="' . $lienJournal . '">' .
                        '<h4><img src="' . $prefixe . '-images/imgPdf.svg" width="32" height="32" alt="(PDF)"> Lire en ligne</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Journaux - Contribuer                                                                                                #
########################################################################################################################
function afficherContribuer($prefixe) {
    $title = 'Contribuer au journal';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritContribuer.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Mentions légales                                                                                                     #
########################################################################################################################
function afficherMentionsLegales($prefixe) {
    $title = 'Mentions légales';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritMentionsLegales.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

    require_once($prefixe . '-mvc/vue/cadre.php');
}

########################################################################################################################
# Plan du site                                                                                                         #
########################################################################################################################
function afficherPlanDuSite($prefixe) {
    $title = 'Plan du site';
    $header = $prefixe . '-mvc/vue/gabaritsPublic/header.php';
    $gabarit = $prefixe . '-mvc/vue/gabaritsPublic/gabaritPlanDuSite.php';
    $footer = $prefixe . '-mvc/vue/gabaritsPublic/footer.php';

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
                    return '<a href="' . $lien . '" class="list-group-item list-group-item-info">' . 'accueil' . '</a>';
                }
                return '<a href="' . $lien . '" class="list-group-item list-group-item-info">' . $cheminInverse[2] . '</a>';
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

    $plan = retirerDivEnglobant(optimiserListe(construireListe(chercherTousLesEnfants($prefixe))));

    require_once($prefixe . '-mvc/vue/cadre.php');
}