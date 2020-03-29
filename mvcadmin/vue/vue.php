<?php
########################################################################################################################
# Gabarit Connexion                                                                                                    #
########################################################################################################################
function afficherConnexion($messageRetour) {
    require_once('gabarits/gabaritConnexion.php');
}

function afficherCreerEvent($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    require_once('gabarits/gabaritCreerEvent.php');
}

function afficherChoixEvent($messageRetour) {
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

    require_once('gabarits/gabaritChoixEvent.php');
}

function afficherModifierEvent($messageRetour, $id) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $ligneEvent = infoEvent($id);

    $idEvents = $id;
    $titreEvents = $ligneEvent->titreEvents;
    $descEvents = $ligneEvent->descEvents;
    $dateEvents = $ligneEvent->dateEvents;
    $heureEvents = $ligneEvent->heureEvents;
    $lieuEvents = $ligneEvent->lieuEvents;

    $heure = substr($heureEvents, 0, 2);
    $minute = substr($heureEvents, 3, 2);

    require_once('gabarits/gabaritModifierEvent.php');
}

function afficherSupprimerEvent($messageRetour) {
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

    require_once('gabarits/gabaritSupprimerEvent.php');
}

function afficherAjouterGoodie($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    require_once('gabarits/gabaritAjouterGoodie.php');
}

function afficherAjouterImageGoodie($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $lignesGoodies = idTitreGoodies();

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">' . $titreGoodie . '</option>';
    }

    require_once('gabarits/gabaritAjouterImageGoodie.php');
}

function afficherChoixGoodie($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $lignesGoodies = idTitreGoodies();

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">' . $titreGoodie . '</option>';
    }

    require_once('gabarits/gabaritChoixGoodie.php');
}

function afficherModifierGoodie($messageRetour, $id) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $ligneGoodie = infoGoodie($id);

    $idGoodie = $id;
    $titreGoodie = $ligneGoodie->titreGoodies;
    $prixADEuroGoodie = intval($ligneGoodie->prixADGoodies);
    $prixADCentimesGoodie = $ligneGoodie->prixADGoodies - intval($prixADEuroGoodie);
    $prixNADEuroGoodie = intval($ligneGoodie->prixNADGoodies);
    $prixNADCentimesGoodie = $ligneGoodie->prixNADGoodies - intval($prixNADEuroGoodie);
    $descGoodie = $ligneGoodie->descGoodies;

    require_once('gabarits/gabaritModifierGoodie.php');
}

function afficherSupprimerImageGoodie($messageRetour, $id) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $idGoodie = $id;

    $lignesImages = imagesGoodie($id);
    $images = '';

    foreach ($lignesImages as $ligne) {
        $idImage = $ligne->idImagesGoodies;
        $lienImage = $ligne->lienImagesGoodies;

        $images .=
            '<fieldset>' .
                '<img src="./ressources/goodies/' . $lienImage . '" width="200" height="100">' .
                '<p><input type="checkbox" name="' . $idImage . '" id="' . $idImage . '"></p>' .
            '</fieldset>';
    }

    require_once('gabarits/gabaritSupprimerImageGoodie.php');
}

function afficherSupprimerGoodie($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $lignesGoodies = idTitreGoodies();

    $goodies = '';
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $goodies .=
            '<option value="' . $idGoodie . '">' . $titreGoodie . '</option>';
    }

    require_once('gabarits/gabaritSupprimerGoodie.php');
}

function afficherAjouterJournal($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    require_once('gabarits/gabaritAjouterJournal.php');
}

function afficherSupprimerJournal($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);

    $lignesJournaux = idTitreJournaux();

    $journaux = '';
    foreach ($lignesJournaux as $ligneJournal) {
        $idJournal = htmlentities($ligneJournal->idJournaux, ENT_QUOTES, "UTF-8");
        $titreJournal = htmlentities($ligneJournal->titreJournaux, ENT_QUOTES, "UTF-8");
        $journaux .=
            '<option value="' . $idJournal . '">' . $titreJournal . '</option>';
    }

    require_once('gabarits/gabaritSupprimerJournal.php');
}

function afficherMenu($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = $ligneInfoMembre->nomMembre;
    require_once('gabarits/gabaritMenu.php');
}

function afficherParametresCompte($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $loginMembre = $ligneInfoMembre->loginMembre;
    $nomMembre = $ligneInfoMembre->nomMembre;
    $descMembre = $ligneInfoMembre->descMembre;
    require_once('gabarits/gabaritParametresCompte.php');
}