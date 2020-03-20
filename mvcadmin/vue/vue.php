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
function afficherJournal($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    require_once('gabarits/gabaritJournal.php');
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