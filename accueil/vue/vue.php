<?php
########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function afficherAccueil($prefixe) {
    $title = 'Accueil';
    $gabarit = $prefixe . 'vue/gabaritAccueil.php';

    $articles = 'articles';
    $events = 'events';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Qui sommes-nous ?                                                                                            #
########################################################################################################################
function afficherQuiSommesNous($prefixe) {
    $title = 'Qui sommes-nous ?';
    $gabarit = $prefixe . 'vue/gabaritQuiSommesNous.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Communication                                                                                           #
########################################################################################################################
function afficherPoleCommunication($prefixe) {
    $title = 'Pôle Communication';
    $gabarit = $prefixe . 'vue/gabaritPoleCommunication.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Culture                                                                                                 #
########################################################################################################################
function afficherPoleCulture($prefixe) {
    $title = 'Pôle Culture';
    $gabarit = $prefixe . 'vue/gabaritPoleCulture.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Events                                                                                                  #
########################################################################################################################
function afficherPoleEvents($prefixe) {
    $title = 'Pôle Events';
    $gabarit = $prefixe . 'vue/gabaritPoleEvents.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Goodies                                                                                                 #
########################################################################################################################
function afficherPoleGoodies($prefixe) {
    $title = 'Pôle Goodies';
    $gabarit = $prefixe . 'vue/gabaritPoleGoodies.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Informatique                                                                                            #
########################################################################################################################
function afficherPoleInformatique($prefixe) {
    $title = 'Pôle Informatique';
    $gabarit = $prefixe . 'vue/gabaritPoleInformatique.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Jardin                                                                                                  #
########################################################################################################################
function afficherPoleJardin($prefixe) {
    $title = 'Pôle Jardin';
    $gabarit = $prefixe . 'vue/gabaritPoleJardin.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Journal                                                                                                 #
########################################################################################################################
function afficherPoleJournal($prefixe) {
    $title = 'Pôle Journal';
    $gabarit = $prefixe . 'vue/gabaritPoleJournal.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Partenariats                                                                                            #
########################################################################################################################
function afficherPolePartenariats($prefixe) {
    $title = 'Pôle Partenariats';
    $gabarit = $prefixe . 'vue/gabaritPolePartenariats.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Erreur                                                                                                       #
########################################################################################################################
function afficherErreur($prefixe, $messageErreur) {
    $title = 'Une erreur s\'est produite';
    $gabarit = $prefixe . 'vue/gabaritErreur.php';

    require_once($prefixe . 'vue/cadre.php');
}