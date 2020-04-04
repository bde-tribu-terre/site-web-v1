<?php
########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function afficherAccueil($prefixe) {
    $title = 'Accueil';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritAccueil.php';

    # Goodies
    $goodiesIndicators = '';
    $goodies ='';
    $lignesGoodies = goodiesTous('', true, false, false);

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
        $lienMiniature = $prefixe . 'goodies/' . $miniatureGoodie;

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
                '<a href="' . $prefixe . 'goodies/?id=' . $idGoodie . '"><img src="' . $lienMiniature . '" alt="Image"></a>' . "\n" .
                '<div class="carousel-caption">' . "\n" .
                    '<a href="' . $prefixe . 'goodies/?id=' . $idGoodie . '"><h3>' . $titreGoodie . '</h3></a>' . "\n" .
                    '<p>' . $prixAdherentGoodie . '€ Adhérent | ' . $prixNonAdherentGoodie . '€ Non-adhérent</p>' . "\n" .
                '</div>' . "\n" .
            '</div>';
    }

    # Events
    $lignesEvents = eventsTous('PF', true, false);
    $events = '';

    $arrayMois = [
        '01' => 'Janvier', '02' => 'Février',  '03' => 'Mars',
        '04' => 'Avril',   '05' => 'Mai',      '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août',     '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    if (empty($lignesEvents)) {
        $events .=
            '<div class="well">' .
            '<p>Oups ! On dirait qu\'il n\'y a aucun évent de prévu dans le futur 🙈</p>' .
            '</div>';
    }

    $count = 0;
    foreach ($lignesEvents as $ligneEvent) {
        $count++;
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
        $hide = '';
        if ($count == 3) {
            $hide = ' accueilTroisiemeEvent';
        }
        $events .=
            '<a href="' . $prefixe . 'events/?id=' . $idEvent . '">' .
                '<div class="well' . $hide . '">' .
                    '<h4>' . $titreEvent . '</h4>' .
                    '<p>📅 ' . substr($dateEvent, 8, 2) . ' ' . $arrayMois[substr($dateEvent, 5, 2)] . $nbJoursStr . '</p>' .
                    '<p>⌚️ ' . substr($heureEvent, 0, 2) . 'h' . substr($heureEvent, 3, 2) . '</p>' .
                    '<p>📍 ' . $lieuEvent . '</p>' .
                '</div>' .
            '</a>';
    }

    # Journal
    $lignesJournaux = derniersJournaux();
    $journaux ='';

    foreach ($lignesJournaux as $ligneJournal) {
        $titre = htmlentities($ligneJournal->titreJournaux, ENT_QUOTES, "UTF-8");;
        $date = htmlentities($ligneJournal->dateJournaux, ENT_QUOTES, "UTF-8");
        $pdf = htmlentities($ligneJournal->pdfJournaux, ENT_QUOTES, "UTF-8");

        $lienJournal = $prefixe . 'journaux/' . $pdf;

        $journaux .=
            '<div class="col-sm-3">' .
                '<div class="well">' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . '</h4>' .
                    '<a href="' . $lienJournal . '">' .
                        '<h4><img src="' . $prefixe . 'global/images/imgPdf.svg" width="32" height="32" alt="(PDF)"> Lire en ligne</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Erreur                                                                                                       #
########################################################################################################################
function afficherErreur($prefixe, $messageErreur) {
    $title = 'Une erreur s\'est produite';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritErreur.php';

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Events                                                                                                       #
########################################################################################################################
function afficherEvents($prefixe, $tri, $aVenir, $passes, $rechercheEnCours) {
    $title = 'Évents';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritEvents.php';

    if ($rechercheEnCours) {
        $rechercheEnCoursStr = 'true';
    } else {
        $rechercheEnCoursStr = 'false';
    }
    if ($aVenir) {
        $checkedAVenir = ' checked';
    } else {
        $checkedAVenir = '';
    }
    if ($passes) {
        $checkedPasses = ' checked';
    } else {
        $checkedPasses = '';
    }

    $tableEvents = '';
    $lignesEvents = eventsTous($tri, $aVenir, $passes);

    if (empty($lignesEvents)) {
        $tableEvents = '<h3>Hmmm... On dirait qu\'il n\'y a aucun évent qui correspond à vos critères de recherches 🤔</h3>';
    }

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
                    '<a class="btn btn-primary" href="' . $prefixe . 'events/?id=' . $id . '">' .
                        'Voir les détails...' .
                    '</a>' .
                '</div>' .
            '</div>';
        if (!$pair) {
            $tableEvents .= '</div>';
            $pair = true;
        } else {
            $pair = false;
        }
    }
    if (!$pair) { // Si c'est pair il fait fermer la balise.
        $tableEvents .= '</div>';
    }

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

function afficherEventPrecis($prefixe, $event) {
    // $title = 'Event'; Voir ci-après.
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritEventPrecis.php';

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

    $descStr = nl2br($desc);
    $dateStr = substr($date, 8, 2) . ' ' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4);
    $heureStr = substr($heure, 0, 2) . 'h' . substr($heure, 3, 2);

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Goodies                                                                                                      #
########################################################################################################################
function afficherGoodies($prefixe, $tri, $disponible, $bientot, $rupture, $rechercheEnCours) {
    $title = 'Goodies';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritGoodies.php';

    if ($rechercheEnCours) {
        $rechercheEnCoursStr = 'true';
    } else {
        $rechercheEnCoursStr = 'false';
    }
    if ($disponible) {
        $checkedDisponible = ' checked';
    } else {
        $checkedDisponible = '';
    }
    if ($bientot) {
        $checkedBientot = ' checked';
    } else {
        $checkedBientot = '';
    }
    if ($rupture) {
        $checkedRupture = ' checked';
    } else {
        $checkedRupture = '';
    }

    $tableGoodies = '';
    $lignesGoodies = goodiesTous($tri, $disponible, $bientot, $rupture);

    if (empty($lignesGoodies)) {
        $tableGoodies = '<h3>Hmmm... On dirait qu\'il n\'y a aucun goodie qui correspond à vos critères de recherches 🤔</h3>';
    }

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
        $lienMiniature = $prefixe . 'goodies/' . $miniature;
        switch ($categorie) {
            case 1:
                $categorieStr = '<span style="color: darkgreen">Disponible</span>';
                break;
            case 2:
                $categorieStr = '<span style="color: darkblue">Bientôt disponible</span>';
                break;
            case 3:
                $categorieStr = '<span style="color: darkred">En rupture de stock</span>';
                break;
            default:
                $categorieStr = '<span style="color: red">Une erreur s\'est produite.</span>';
                break;
        }

        $tableGoodies .=
            '<div class="col-sm-6">' .
                '<div class="well">' .
                    '<a href="' . $prefixe . 'goodies/?id=' . $id . '">' .
                        '<img src="' . $lienMiniature . '" class="miniatureGoodies" alt="Miniature">' .
                    '</a>' .
                    '<h3>' . $titre . '</h3>' .
                    '<hr>' .
                    '<h4><strong>' . $categorieStr . '</strong></h4>' .
                    '<h4>Prix pour les adhérents : ' . $prixAdherent . '€</h4>' .
                    '<h4>Prix pour les non-adhérents : ' . $prixNonAdherent . '€</h4>' .
                    '<a class="btn btn-primary" href="' . $prefixe . 'goodies/?id=' . $id . '">' .
                        'Voir les détails...' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

function afficherGoodiePrecis($prefixe, $goodie) {
    // $title = 'Goodies'; Voir ci-après.
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritGoodiePrecis.php';

    $id = htmlentities($goodie->idGoodies, ENT_QUOTES, "UTF-8");
    $titreGoodie = htmlentities($goodie->titreGoodies, ENT_QUOTES, "UTF-8");
    $prixAdherent = htmlentities($goodie->prixADGoodies, ENT_QUOTES, "UTF-8");
    $prixNonAdherent = htmlentities($goodie->prixNADGoodies, ENT_QUOTES, "UTF-8");
    $categorie = htmlentities($goodie->categorieGoodies, ENT_QUOTES, "UTF-8");
    $descGoodie = htmlentities($goodie->descGoodies, ENT_QUOTES, "UTF-8");
    $miniature = htmlentities($goodie->miniatureGoodies, ENT_QUOTES, "UTF-8");

    $title = $titreGoodie;

    $lignesImages = imagesGoodie($id);

    $carouselGoodie = '';
    if (empty($lignesImages)) {
        $carouselGoodie .= '<img src="' . $prefixe . 'goodies/' . $miniature . '" class="imageUniqueGoodiePrecis">';
    } else {
        $nb = 0;
        $carouselGoodieIndicator = '<ol class="carousel-indicators">';
        $carouselGoodieImages = '<div class="carousel-inner" role="listbox">';

        # Image miniature
        $carouselGoodieIndicator .= '<li data-target="#myCarousel" data-slide-to="' . $nb++ . '" class="active"></li>';
        $carouselGoodieImages .=
            '<div class="item active">' .
                '<img src="' . $prefixe . 'goodies/' . $miniature . '" alt="Image">' .
            '</div>';

        # Le reste des images
        foreach ($lignesImages as $ligne) {
            $lien = $ligne->lienImagesGoodies;
            $carouselGoodieIndicator .= '<li data-target="#myCarousel" data-slide-to="' . $nb++ . '"></li>';
            $carouselGoodieImages .=
                '<div class="item">' .
                    '<img src="' . $prefixe . 'goodies/' . $lien . '" alt="Image">' .
                '</div>';
        }
        $carouselGoodieIndicator .= '</ol>';
        $carouselGoodieImages .= '</div>';

        $carouselGoodie =
            '<div id="carouselGoodie" class="carousel slide" data-ride="carousel">' .
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

    $descStr = nl2br($descGoodie);

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Journaux                                                                                                     #
########################################################################################################################
function afficherJournaux($prefixe) {
    $title = 'Journaux';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritJournaux.php';

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

        $lienJournal = $prefixe . 'journaux/' . $pdf;

        $tableJournaux .=
            '<div class="col-sm-3">' .
                '<div class="well">' .
                    '<h3>' . $titre . '</h3>' .
                    '<h4>' . $arrayMois[substr($date, 5, 2)] . ' ' . substr($date, 0, 4) . '</h4>' .
                    '<a href="' . $lienJournal . '">' .
                        '<h4><img src="' . $prefixe . 'global/images/imgPdf.svg" width="32" height="32" alt="(PDF)"> Lire en ligne</h4>' .
                    '</a>' .
                '</div>' .
            '</div>';
    }

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Nous contacter                                                                                               #
########################################################################################################################
function afficherNousContacter($prefixe) {
    $title = 'Nous contacter';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritNousContacter.php';

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Qui sommes-nous ?                                                                                            #
########################################################################################################################
function afficherQuiSommesNous($prefixe) {
    $title = 'Qui sommes-nous ?';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritQuiSommesNous.php';

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}

########################################################################################################################
# Gabarit Statuts                                                                                                      #
########################################################################################################################
function afficherStatuts($prefixe) {
    $title = 'Statuts';
    $gabarit = $prefixe . '-mvc-public/vue/gabarits/gabaritStatuts.php';

    require_once($prefixe . '-mvc-public/vue/cadre.php');
}