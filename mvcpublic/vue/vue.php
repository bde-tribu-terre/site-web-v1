<?php
########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function afficherAccueil($prefixe) {
    $title = 'Accueil';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritAccueil.php';

    # Goodies
    $goodiesIndicators = '';
    $goodies ='';
    $listeGoodies = scandir($prefixe . 'ressources/goodies');
    natsort($listeGoodies);

    foreach ($listeGoodies as $repertoire) {
        if (
            file_exists($prefixe . 'ressources/journaux/' . $repertoire . '/desc.txt') &&
            file_exists($prefixe . 'ressources/journaux/' . $repertoire . '/attr.txt') &&
            file_exists($prefixe . 'ressources/journaux/' . $repertoire . '/img.png') &&
            $repertoire != '.' &&
            $repertoire != '..'
        ) {
            $attr = file($prefixe . 'ressources/goodies/' . $repertoire . '/attr.txt');
            $nomGoodie = $attr[0];
            $prixAdherent = $attr[1];
            $prixNonAdherent = $attr[2];
            $etat = $attr[3]; // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock
            if ($etat != 1) {
                continue;
            }
            $lienImg = $prefixe . 'ressources/goodies/' . $repertoire . '/img.png';
            $goodiesIndicators .= '<li data-target="carouselGoodies" data-slide-to="' . $repertoire . '"';
            if ($listeGoodies[0] == $repertoire) {
                $goodiesIndicators .= ' class="active"';
            }
            $goodiesIndicators .= '></li>';
            $goodies .= '<div class="item';
            if ($listeGoodies[0] == $repertoire) {
                $goodies .= ' active';
            }
            $goodies .=
                '">' .
                    '<img src="' . $lienImg . '" alt="Image">' .
                    '<div class="carousel-caption">' .
                        '<h3>' . $nomGoodie . '</h3>' .
                        '<p>' . $prixAdherent . '€ Adhérent | ' . $prixNonAdherent . '€ Non-adhérent</p>' .
                    '</div>' .
                '</div>';
        }
    }

    # Events
    # pass

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

    $tableJournaux = '';
    $journaux = scandir($prefixe . 'ressources/journaux');
    natsort($journaux);
    array_reverse($journaux);

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];
    foreach ($journaux as $repertoire) {
        if (file_exists($prefixe . 'ressources/journaux/' . $repertoire . '/desc.txt') && $repertoire != '.' && $repertoire != '..') {
            $desc = file($prefixe . 'ressources/journaux/' . $repertoire . '/desc.txt');
            $titre = $desc[2];
            $nomFichier = $desc[0];
            $lienJournal = $prefixe . 'ressources/journaux/' . $repertoire . '/' . $nomFichier;
            $dateParution = $desc[1];
            $tableJournaux .=
                '<div class="col-sm-3">' .
                    '<div class="well">' .
                        '<h3>' . $titre . '</h3>' .
                        '<h4>' . $arrayMois[substr($dateParution, 5, 2)] . ' ' . substr($dateParution, 0, 4) . '</h4>' .
                        '<a href="' . $lienJournal . '">' .
                            '<h4>Lire en ligne</h4>' .
                        '</a>' .
                    '</div>' .
                '</div>';
        }
    }

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