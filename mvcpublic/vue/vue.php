<?php
########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function afficherAccueil($prefixe) {
    $title = 'Accueil';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritAccueil.php';

    $articles = '>>variable str php articles<<';
    $events = '>>variable str php events<<';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Erreur                                                                                                       #
########################################################################################################################
function afficherErreur($prefixe, $messageErreur) {
    $title = 'Une erreur s\'est produite';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritErreur.php';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Events                                                                                                       #
########################################################################################################################
function afficherEvents($prefixe) {
    $title = 'Events';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritEvents.php';

    $events = '>>variable str php events<<';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Goodies                                                                                                      #
########################################################################################################################
function afficherGoodies($prefixe) {
    $title = 'Goodies';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritGoodies.php';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Journaux                                                                                                     #
########################################################################################################################
function afficherJournaux($prefixe) {
    $title = 'Journaux';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritJournaux.php';

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

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Nous contacter                                                                                               #
########################################################################################################################
function afficherNousContacter($prefixe) {
    $title = 'Nous contacter';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritNousContacter.php';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Qui sommes-nous ?                                                                                            #
########################################################################################################################
function afficherQuiSommesNous($prefixe) {
    $title = 'Qui sommes-nous ?';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritQuiSommesNous.php';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Statuts                                                                                                      #
########################################################################################################################
function afficherStatuts($prefixe) {
    $title = 'Statuts';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritStatuts.php';

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}