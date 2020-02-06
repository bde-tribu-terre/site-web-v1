<?php
########################################################################################################################
# Gabarit Connexion                                                                                                    #
########################################################################################################################
function afficherConnexion($messageRetour) {
    require_once('gabaritConnexion.php');
}

########################################################################################################################
# Gabarit Menu                                                                                                         #
########################################################################################################################
function afficherMenu($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $nomMembre = $ligneInfoMembre->nomMembre;
    require_once('gabaritMenu.php');
}

function afficherParametresCompte($messageRetour) {
    $ligneInfoMembre = infosMembre($_SESSION['id']);
    $loginMembre = $ligneInfoMembre->loginMembre;
    $nomMembre = $ligneInfoMembre->nomMembre;
    $descMembre = $ligneInfoMembre->descMembre;
    require_once('gabaritParametresCompte.php');
}