<?php
########################################################################################################################
# Gabarit Connexion                                                                                                    #
########################################################################################################################
function afficherConnexion($messageRetour) {
    require_once('gabarits/gabaritConnexion.php');
}

########################################################################################################################
# Gabarit Menu                                                                                                         #
########################################################################################################################
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


    require_once('gabarits/gabaritSupprimerImageGoodie.php');
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