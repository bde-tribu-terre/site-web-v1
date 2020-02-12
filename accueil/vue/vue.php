<?php
########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function afficherAccueil() {
    $title = 'Accueil';
    $gabarit = './vue/gabaritAccueil.php';

    $articles = 'articles';
    $events = 'events';

    require_once('./vue/cadre.php');
}

########################################################################################################################
# Gabarit Qui sommes-nous ?                                                                                            #
########################################################################################################################
function afficherQuiSommesNous() {
    $title = 'Qui sommes-nous ?';
    $gabarit = './vue/gabaritQuiSommesNous.php';

    require_once('./vue/cadre.php');
}

########################################################################################################################
# Gabarit Erreur                                                                                                       #
########################################################################################################################
function afficherErreur($messageErreur) {
    $title = 'Une erreur s\'est produite';
    $gabarit = './vue/gabaritErreur.php';

    require_once('./vue/cadre.php');
}