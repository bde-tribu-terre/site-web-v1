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
    $lignesGoodies = goodiesTous();

    $nb = 0;
    $premier = true;
    foreach ($lignesGoodies as $ligneGoodie) {
        $idGoodie = htmlentities($ligneGoodie->idGoodies, ENT_QUOTES, "UTF-8");
        $titreGoodie = htmlentities($ligneGoodie->titreGoodies, ENT_QUOTES, "UTF-8");
        $prixAdherentGoodie = htmlentities($ligneGoodie->prixADGoodies, ENT_QUOTES, "UTF-8");
        $prixNonAdherentGoodie = htmlentities($ligneGoodie->prixNADGoodies, ENT_QUOTES, "UTF-8");
        $categorieGoodie = htmlentities($ligneGoodie->categorieGoodies, ENT_QUOTES, "UTF-8");
        $miniatureGoodie = htmlentities($ligneGoodie->miniatureGoodies, ENT_QUOTES, "UTF-8");

        // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock
        if ($categorieGoodie != 1) {
            continue;
        }
        $lienMiniature = $prefixe . 'ressources/goodies/miniatures/' . $miniatureGoodie;

        $goodiesIndicators .= '<li data-target="#carouselGoodies" data-slide-to="' . $nb++ . '"';
        if ($premier) {
            $goodiesIndicators .= ' class="active"';
        }
        $goodiesIndicators .= '></li>' . "\n";
        $goodies .= '<div class="item';
        if ($premier) {
            $goodies .= ' active';
            $premier = false;
        }
        $goodies .=
            '">' . "\n" .
                '<a href="' . $prefixe . 'goodies?id=' . $idGoodie . '"><img src="' . $lienMiniature . '" alt="Image"></a>' . "\n" .
                '<div class="carousel-caption">' . "\n" .
                    '<a href="' . $prefixe . 'goodies?id=' . $idGoodie . '"><h3>' . $titreGoodie . '</h3></a>' . "\n" .
                    '<p>' . $prixAdherentGoodie . '€ Adhérent | ' . $prixNonAdherentGoodie . '€ Non-adhérent</p>' . "\n" .
                '</div>' . "\n" .
            '</div>';
    }

    # Events
    $lignesEvents = eventsFuturs(date('Y-m-d'));
    $events = '';

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    foreach ($lignesEvents as $ligneEvent) {
        $idEvent = htmlentities($ligneEvent->idEvents, ENT_QUOTES, "UTF-8");
        $titreEvent = htmlentities($ligneEvent->titreEvents, ENT_QUOTES, "UTF-8");
        $dateEvent = htmlentities($ligneEvent->dateEvents, ENT_QUOTES, "UTF-8");
        $heureEvent = htmlentities($ligneEvent->heureEvents, ENT_QUOTES, "UTF-8");
        $lieuEvent = htmlentities($ligneEvent->lieuEvents, ENT_QUOTES, "UTF-8");
        $nbJours = round((strtotime($dateEvent) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
        $nbJoursStr = '';
        if ($nbJours == 0) {
            $nbJoursStr .= '<strong><span style="color: red"> (Aujourd\'hui)</span></strong>';
        } elseif ($nbJours == 1) {
            $nbJoursStr .= '<strong><span style="color: red"> (Demain)</span></strong>';
        } else {
            $nbJoursStr .= ' (dans ' . $nbJours . ' jours)';
        }
        $events .=
            '<a href="' . $prefixe . 'events?id=' . $idEvent . '">' .
                '<div class="well">' .
                    '<h4>' . $titreEvent . '</h4>' .
                    '<p>📅 ' . substr($dateEvent, 8, 2) . ' ' . $arrayMois[substr($dateEvent, 5, 2)] . $nbJoursStr . '</p>' .
                    '<p>⌚️ ' . substr($heureEvent, 0, 2) . 'h' . substr($heureEvent, 3, 2) . '</p>' .
                    '<p>📍 ' . $lieuEvent . '</p>' .
                '</div>' .
            '</a>';
    }

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

    $tableEvents = '';
    $lignesEvents = eventsTous();

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    $pair = true; // On commence à 0 en informatique.
    foreach ($lignesEvents as $ligne) {
        $id = htmlentities($ligne->idEvents, ENT_QUOTES, "UTF-8");
        $titre = htmlentities($ligne->titreEvents, ENT_QUOTES, "UTF-8");
        $desc = htmlentities($ligne->descEvents, ENT_QUOTES, "UTF-8");
        $date = htmlentities($ligne->dateEvents, ENT_QUOTES, "UTF-8");
        $heure = htmlentities($ligne->heureEvents, ENT_QUOTES, "UTF-8");
        $lieu = htmlentities($ligne->lieuEvents, ENT_QUOTES, "UTF-8");
        $nbJours = round((strtotime($date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
        $nbJoursStr = '';
        $couleur = '';
        if ($nbJours == 0) {
            $nbJoursStr .= '<strong><span style="color: red"> (Aujourd\'hui)</span></strong>';
        } elseif ($nbJours == 1) {
            $nbJoursStr .= '<strong><span style="color: red"> (Demain)</span></strong>';
        } elseif ($nbJours > 0) {
            $nbJoursStr .= ' (dans ' . $nbJours . ' jours)';
        } else {
            $couleur = ' style="background-color: #d1d2ce"';
        }

        if ($pair) {
            $tableEvents .= '<div class="row">';
        }
        $tableEvents .=
            '<div class="col-sm-6">' .
                '<div class="well"' . $couleur . '>' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>📅 ' . substr($date, 8, 2) . ' ' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . $nbJoursStr . '</h4>' .
                    '<h4>⌚️ ' . substr($heure, 0, 2) . 'h' . substr($heure, 3, 2) . '</h4>' .
                    '<h4>📍️ ' . $lieu . '</h4>' .
                    '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#event' . $id . '" aria-expanded="false" aria-controls="collapseExample">' .
                        'En savoir plus...' .
                    '</button>' .
                    '<div class="collapse" id="event' . $id . '">' .
                        '<div class="card card-body">' .
                            '<h5>' .
                                preg_replace("/\r|\n/", '<br>', $desc) .
                            '</h5>' .
                        '</div>' .
                    '</div>' .
                '</div>' .
            '</div>';
        if (!$pair) {
            $tableEvents .= '</div>';
            $pair = true;
        } else {
            $pair = false;
        }
    }

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

function afficherEventPrecis($prefixe, $event) {
    // $title = 'Event'; Voir ci-après.
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritEventPrecis.php';

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    $id = htmlentities($event->idEvents, ENT_QUOTES, "UTF-8");
    $titre = htmlentities($event->titreEvents, ENT_QUOTES, "UTF-8");
    $desc = htmlentities($event->descEvents, ENT_QUOTES, "UTF-8");
    $date = htmlentities($event->dateEvents, ENT_QUOTES, "UTF-8");
    $heure = htmlentities($event->heureEvents, ENT_QUOTES, "UTF-8");
    $lieu = htmlentities($event->lieuEvents, ENT_QUOTES, "UTF-8");
    $nbJours = round((strtotime($date) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));

    $title = $titre;

    $nbJoursStr = '';
    if ($nbJours == 0) {
        $nbJoursStr .= '<strong><span style="color: red">(Aujourd\'hui)</span></strong>';
    } elseif ($nbJours == 1) {
        $nbJoursStr .= '<strong><span style="color: red">(Demain)</span></strong>';
    } elseif ($nbJours > 0) {
        $nbJoursStr .= '(dans ' . $nbJours . ' jours)';
    } else {
        $nbJoursStr .= '<i><span style="color: darkgray">(Il y a ' . abs($nbJours) . ' jours)</span></i>';
    }

    $descStr = preg_replace("/\r|\n/", '<br>', $desc);
    $dateStr = substr($date, 8, 2) . ' ' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4);
    $heureStr = substr($heure, 0, 2) . 'h' . substr($heure, 3, 2);

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Goodies                                                                                                      #
########################################################################################################################
function afficherGoodies($prefixe) {
    $title = 'Goodies';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritGoodies.php';

    $tableGoodies = '';
    $lignesGoodies = goodiesTous();

    foreach ($lignesGoodies as $ligne) {
        $id = htmlentities($ligne->idGoodies, ENT_QUOTES, "UTF-8");
        $titre = htmlentities($ligne->titreGoodies, ENT_QUOTES, "UTF-8");
        $prixAdherent = htmlentities($ligne->prixADGoodies, ENT_QUOTES, "UTF-8");
        $prixNonAdherent = htmlentities($ligne->prixNADGoodies, ENT_QUOTES, "UTF-8");
        $categorie = htmlentities($ligne->categorieGoodies, ENT_QUOTES, "UTF-8");
        $miniature = htmlentities($ligne->miniatureGoodies, ENT_QUOTES, "UTF-8");

        // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock
        if ($categorie == 0) {
            continue;
        }
        $lienMiniature = $prefixe . 'ressources/goodies/miniatures/' . $miniature;

        $tableGoodies .=
            '<div class="col-sm-6">' .
                '<div class="well">' .
                    '<a href="' . $prefixe . 'goodies?id=' . $id . '">' .
                        '<img src="' . $lienMiniature . '" class="miniatureGoodies" alt="Miniature">' .
                    '</a>' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>Prix pour les adhérents : ' . $prixAdherent . '€</h4>' .
                    '<h4>Prix pour les non-adhérents : ' . $prixNonAdherent . '€</h4>' .
                    '<a class="btn btn-primary" href="' . $prefixe . 'goodies?id=' . $id . '">' .
                        'Voir les détails...' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

function afficherGoodiePrecis($prefixe, $id) {
    // $title = 'Goodies'; Voir ci-après.
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritGoodiePrecis.php';

    $attr = file($prefixe . 'ressources/goodies/' . $id . '/attr.txt');
    $nomGoodie = preg_replace("/\r|\n/", "", $attr[0]);
    $prixAdherent = preg_replace("/\r|\n/", "", $attr[1]);
    $prixNonAdherent = preg_replace("/\r|\n/", "", $attr[2]);
    $descGoodie = nl2br(file_get_contents($prefixe . 'ressources/goodies/' . $id . '/desc.txt'));
    $etat = preg_replace("/\r|\n/", "", $attr[3]);
    // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock

    $title = $nomGoodie;

    $listeImages = scandir($prefixe . 'ressources/goodies/' . $id . '/img');
    natsort($listeImages);

    $carouselGoodie = '';
    if (count($listeImages) == 3) { // Si il n'y a qu'une seule image... (car il y a . et .. )
        $carouselGoodie .= '<img src="' . $prefixe . 'ressources/goodies/' . $id . '/img.png' . '" class="imageUniqueGoodiePrecis">';
    } else {
        $first = true;
        $nb = 0;
        $carouselGoodieIndicator = '<ol class="carousel-indicators">';
        $carouselGoodieImages = '<div class="carousel-inner" role="listbox">';
        foreach ($listeImages as $image) {
            if ($image != '.' && $image != '..') {
                $carouselGoodieIndicator .= '<li data-target="#myCarousel" data-slide-to="' . $nb++ . '"';
                $carouselGoodieImages .= '<div class="item';
                if ($first) {
                    $carouselGoodieIndicator .= ' class="active"';
                    $carouselGoodieImages .= ' active';
                    $first = false;
                }
                $carouselGoodieIndicator .= '></li>';
                $carouselGoodieImages .= '">' .
                    '<img src="' . $prefixe . 'ressources/goodies/' . $id . '/img/' . $image . '" alt="Image">' .
                    '</div>';
            }
        }
        $carouselGoodieIndicator .= '</ol>';
        $carouselGoodieImages .= '</div>';

        $carouselGoodie = '<div id="carouselGoodie" class="carousel slide" data-ride="carousel">' .
                $carouselGoodieIndicator .
                $carouselGoodieImages .
                '<a class="left carousel-control" href="#carouselGoodie" role="button" data-slide="prev">' .
                    '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' .
                    '<span class="sr-only">Previous</span>' .
                '</a>' .
                '<a class="right carousel-control" href="#carouselGoodie" role="button" data-slide="next">' .
                    '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' .
                    '<span class="sr-only">Next</span>' .
                '</a>' .
            '</div>';
    }

    require_once($prefixe . 'mvcpublic/vue/cadre.php');
}

########################################################################################################################
# Gabarit Journaux                                                                                                     #
########################################################################################################################
function afficherJournaux($prefixe) {
    $title = 'Journaux';
    $gabarit = $prefixe . 'mvcpublic/vue/gabarits/gabaritJournaux.php';

    $tableJournaux = '';
    $lignesJournaux = journauxTous();

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    foreach ($lignesJournaux as $ligne) {
        $titre = htmlentities($ligne->titreJournaux, ENT_QUOTES, "UTF-8");;
        $date = htmlentities($ligne->dateJournaux, ENT_QUOTES, "UTF-8");
        $pdf = htmlentities($ligne->pdfJournaux, ENT_QUOTES, "UTF-8");

        $lienJournal = $prefixe . 'ressources/journaux/' . $pdf;

        $tableJournaux .=
            '<div class="col-sm-3">' .
                '<div class="well">' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . '</h4>' .
                    '<a href="' . $lienJournal . '">' .
                        '<h4>Lire en ligne</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
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