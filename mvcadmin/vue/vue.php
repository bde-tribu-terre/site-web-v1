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

function afficherAjouterJournal($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    require_once('gabarits/gabaritAjouterJournal.php');
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