<?php
require_once('./modele/connect.php');
require_once('./modele/modele.php');
require_once('./vue/vue.php');

########################################################################################################################
# Gabarit Connexion                                                                                                    #
########################################################################################################################
function CtlConnexion($messageRetour) {
    afficherConnexion($messageRetour);
}

function CtlConnexionErreur($messageErreur) {
    afficherConnexion($messageErreur);
}

########################################################################################################################
# Gabarit Menu                                                                                                         #
########################################################################################################################
function CltMenu($messageRetour) {
    afficherMenu($messageRetour);
}

function CtlMenuErreur($messageErreur) {
    afficherMenu($messageErreur);
}