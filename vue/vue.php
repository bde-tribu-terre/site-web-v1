<?php
########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function afficherAccueil($prefixe) {
    $title = 'Accueil';
    $gabarit = $prefixe . 'vue/gabarits/gabaritAccueil.php';

    $articles = '>>variable str php articles<<';
    $events = '>>variable str php events<<';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Articles                                                                                                     #
########################################################################################################################
function afficherArticles($prefixe) {
    $title = 'Articles';
    $gabarit = $prefixe . 'vue/gabarits/gabaritArticles.php';

    $articles = '>>variable str php articles<<';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Erreur                                                                                                       #
########################################################################################################################
function afficherErreur($prefixe, $messageErreur) {
    $title = 'Une erreur s\'est produite';
    $gabarit = $prefixe . 'vue/gabarits/gabaritErreur.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Events                                                                                                       #
########################################################################################################################
function afficherEvents($prefixe) {
    $title = 'Events';
    $gabarit = $prefixe . 'vue/gabarits/gabaritEvents.php';

    $events = '>>variable str php events<<';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Nous contacter                                                                                               #
########################################################################################################################
function afficherNousContacter($prefixe) {
    $title = 'Nous contacter';
    $gabarit = $prefixe . 'vue/gabarits/gabaritNousContacter.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Communication                                                                                           #
########################################################################################################################
function afficherPoleCommunication($prefixe) {
    $title = 'Pôle Communication';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleCommunication.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Culture                                                                                                 #
########################################################################################################################
function afficherPoleCulture($prefixe) {
    $title = 'Pôle Culture';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleCulture.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Events                                                                                                  #
########################################################################################################################
function afficherPoleEvents($prefixe) {
    $title = 'Pôle Events';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleEvents.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Goodies                                                                                                 #
########################################################################################################################
function afficherPoleGoodies($prefixe) {
    $title = 'Pôle Goodies';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleGoodies.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Informatique                                                                                            #
########################################################################################################################
function afficherPoleInformatique($prefixe) {
    $title = 'Pôle Informatique';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleInformatique.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Jardin                                                                                                  #
########################################################################################################################
function afficherPoleJardin($prefixe) {
    $title = 'Pôle Jardin';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleJardin.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Journal                                                                                                 #
########################################################################################################################
function afficherPoleJournal($prefixe) {
    $title = 'Pôle Journal';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPoleJournal.php';

    $tableJournaux = '<table><tr><th>Fichier</th><th>Date de parution</th></tr>';
    $journaux = scandir($prefixe . 'ressources/journaux');
    natsort($journaux);
    foreach ($journaux as $repertoire) {
        if (file_exists($prefixe . 'ressources/journaux/' . $repertoire . '/desc.txt') && $repertoire != '.' && $repertoire != '..') {
            $desc = file($prefixe . 'ressources/journaux/' . $repertoire . '/desc.txt');
            $titre = $desc[2];
            $nomFichier = $desc[0];
            $lienJournal = $prefixe . 'ressources/journaux/' . $repertoire . '/' . $nomFichier;
            $dateParution = $desc[1];
            $tableJournaux .= '<tr><td><a href="'. $lienJournal . '">' . $titre . '</a></td><td>' . $dateParution . '</td></tr>';
        }
    }
    $tableJournaux .= '</table>';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Pôle Partenariats                                                                                            #
########################################################################################################################
function afficherPolePartenariats($prefixe) {
    $title = 'Pôle Partenariats';
    $gabarit = $prefixe . 'vue/gabarits/gabaritPolePartenariats.php';

    require_once($prefixe . 'vue/cadre.php');
}

########################################################################################################################
# Gabarit Qui sommes-nous ?                                                                                            #
########################################################################################################################
function afficherQuiSommesNous($prefixe) {
    $title = 'Qui sommes-nous ?';
    $gabarit = $prefixe . 'vue/gabarits/gabaritQuiSommesNous.php';

    require_once($prefixe . 'vue/cadre.php');
}