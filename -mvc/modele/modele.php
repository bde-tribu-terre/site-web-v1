<?php
########################################################################################################################
# Fonction techniques                                                                                                  #
########################################################################################################################
function MET_SQLLigneUnique($object) {
    if ($object) {
        $array = array();
        foreach ($object as $key => $val) {
            $array[$key] = is_string($val) ? htmlentities($val, ENT_QUOTES, 'UTF-8') : $val;
        }
        return $array;
    }
    return $object;
}

function MET_SQLLignesMultiples($arrayObject) {
    $array = array();
    foreach ($arrayObject as $objectKey => $objectValue) {
        $array[$objectKey] = MET_SQLLigneUnique($objectValue);
    }
    return $array;
}

function requeteSQL($requete, $variables = array(), $nbResultats = 2, $codeMessageSucces = NULL, $texteMessageSucces = NULL) {
    try {
        $connexion = getConnect();
        $prepare = $connexion->prepare($requete);
        foreach ($variables as $variable) {
            $data_type = $variable[2] == 'INT' ? PDO::PARAM_INT : PDO::PARAM_STR;
            $prepare->bindValue($variable[0], $variable[1], $data_type);
        }
        $prepare->execute();
        switch ($nbResultats) {
            case 0:
                $retour = NULL;
                break;
            case 1:
                $retour = MET_SQLLigneUnique($prepare->fetch());
                break;
            default:
                $retour = MET_SQLLignesMultiples($prepare->fetchAll());
        }
        $prepare->closeCursor();
        if ($codeMessageSucces && $texteMessageSucces) {
            ajouterMessage($codeMessageSucces, $texteMessageSucces);
        }
        return $retour;
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        switch ($nbResultats) {
            case 0:
            case 1:
                return NULL;
            default:
                return array();
        }
    }
}

function genererSiteMap($arrayLiens, $destination) {
    $sitemap = simplexml_load_string(<<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
</urlset>
EOT
    );
    if (count($arrayLiens) == 0) {
        $newURI = $sitemap->addChild('url');
        $newURI->addChild('loc', 'https://bde-tribu-terre.fr');
        $newURI->addChild('lastmod', date('Y-m-d'));
    } else {
        foreach ($arrayLiens as $lien) {
            $newURI = $sitemap->addChild('url');
            $newURI->addChild('loc', $lien);
            $newURI->addChild('lastmod', date('Y-m-d\TH:i:sP'));
        }
    }
    $sitemap->asXML($destination);
}

########################################################################################################################
# Membres                                                                                                              #
########################################################################################################################
function MdlVerifConnexion($login, $mdp) {
    $membre = requeteSQL(
        "
        SELECT
            idMembre AS id,
            loginMembre AS login,
            prenomMembre AS prenom,
            nomMembre AS nom,
            mdpHashMembre AS mdpHash,
            mdpSaltMembre AS mdpSalt
        FROM
            website_membres
        WHERE
            loginMembre=:login
        ",
        array(
            [':login', $login, 'STR']
        ),
        1
    );
    if ($membre) {
        // https://youtu.be/8ZtInClXe1Q pour des explications.
        $mdpSaisieHash = hash('whirlpool', html_entity_decode($membre['mdpSalt'], ENT_QUOTES) . html_entity_decode($mdp, ENT_QUOTES));
        if ($membre['mdpHash'] == $mdpSaisieHash) {
            return $membre;
        }
    }
    return false;
}

function MdlInfosMembre($id) {
    ajouterRetourModele(
        'membre',
        requeteSQL(
            "
            SELECT
                idMembre AS id,
                loginMembre AS login,
                prenomMembre AS prenom,
                nomMembre AS nom
            FROM
                website_membres
            WHERE
                idMembre=:idMembres
            ",
            array(
                [':idMembres', $id, 'INT']
            ),
            1
        )
    );
}

function MdlAjouterMembre($prenom, $nom, $login, $mdp) {
    $salt = '';
    for ($i = 0; $i < 32; $i++) {
        $salt .= chr(rand(33, 126));
    }
    $mdpHash = hash('whirlpool', $salt . $mdp);

    requeteSQL(
        "
        INSERT INTO
            website_membres
        VALUES
            (
                0,
                :login,
                :mdpHash,
                :mdpSalt,
                :prenom,
                :nom
            )
        ",
        array(
            [':login', $login, 'STR'],
            [':mdpHash', $mdpHash, 'STR'],
            [':mdpSalt', $salt, 'STR'],
            [':prenom', $prenom, 'STR'],
            [':nom', $nom, 'STR']
        ),
        0,
        201,
        'L\'inscription a bien été enregistrée.'
    );
    MdlAjouterLog(601, $prenom . ' ' . $nom . ' s\'est inscrit(e) avec succès sous le login "' . $login . '".', True);
}

########################################################################################################################
# Clés d'inscription                                                                                                   #
########################################################################################################################
function MdlCleExiste($cle) {
    $cle = requeteSQL(
        "
        SELECT
            idCleInscription AS id,
            strCleInscription AS str
        FROM
            website_cles_inscription
        WHERE
            strCleInscription=:cle
        ",
        array(
            [':cle', $cle, 'STR']
        ),
        1,
        NULL,
        NULL
    );
    if ($cle) {
        requeteSQL(
            "
            DELETE FROM
                website_cles_inscription
            WHERE
                idCleInscription=:id
            ",
            array(
                [':id', $cle['id'], 'INT']
            ),
            false,
            201,
            'La clé d\'inscription "' . $cle['str'] . '" a été détruite avec succès.'
        );
        return true;
    }
    return false;
}

########################################################################################################################
# Log des actions                                                                                                      #
########################################################################################################################
function MdlLogTous() {
    ajouterRetourModele(
        'log',
        requeteSQL(
            "
            SELECT
                idLog AS idLog,
                idMembre AS idMembre,
                prenomMembre AS prenomMembre,
                nomMembre AS nomMembre,
                codeLog AS code,
                dateLog AS date,
                descLog AS description
            FROM
                website_log
                    NATURAL JOIN
                website_membres
            ORDER BY
                dateLog
                DESC
            "
        )
    );
}

/**
 * Ajoute au log un code accompagné d'un message.
 * @param string $code
 * Le code du log qui est la caractéristique principale pour identifier l'action.
 * <ul>
 * <li>1 : Évents
 * <ul>
 * <li>101 : Ajout d'un évent</li>
 * <li>102 : Modification d'un évent</li>
 * <li>103 : Suppression d'un évent</li>
 * </ul>
 * </li>
 * <li>2 : Goodies
 * <ul>
 * <li>201 : Ajout d'un goodie</li>
 * <li>202 : Modification d'un goodie</li>
 * <li>203 : Suppression d'un goodie</li>
 * <li>204 : Ajout d'une image de goodie</li>
 * <li>205 : Suppression d'une image de goodie</li>
 * </ul>
 * </li>
 * <li>3 : Journaux
 * <ul>
 * <li>301 : Ajout d'un journal</li>
 * <li>302 : Suppression d'un journal</li>
 * </ul>
 * </li>
 * <li>6 : Membres
 * <ul>
 * <li>601 : Inscription d'un membre</li>
 * </ul>
 * </li>
 * <li>7 : Liens
 * <ul>
 * <li>701 : Ajout d'un lien</li>
 * <li>702 : Suppression d'un lien</li>
 * </ul>
 * </li>
 * </ul>
 * @param string $message
 * Une description de l'action.
 * @param boolean $anonyme
 * Si omit alors l'auteur sera la personne identifiée par la session ouverte. Si mit à True, alors l'auteur sera le
 * système (anonyme).
 * @throws Exception
 */
function MdlAjouterLog($code, $message, $anonyme = False) {
    $timestamp = time();
    $dt = new DateTime('now', new DateTimeZone('Europe/Paris'));
    $dt->setTimestamp($timestamp);
    requeteSQL(
        "
        INSERT INTO
            website_log
        VALUES
            (
                0,
                :idMembres,
                :codeLogActions,
                :dateLogActions,
                :descLogActions
            )
        ",
        array(
            [':idMembres', !$anonyme ? $_SESSION['membre']['id'] : 0, 'INT'],
            [':codeLogActions', $code, 'INT'],
            [':dateLogActions', $dt->format('Y-m-d H-i-s'), 'STR'],
            [':descLogActions', $message, 'STR']
        ),
        0
    );
}

########################################################################################################################
# Évents                                                                                                               #
########################################################################################################################
function MdlEventsTous($tri, $aVenir, $passes, $maxi) {
    switch ($tri) {
        case 'FP':
            $triSQL = ' ORDER BY dateEvents DESC';
            break;
        case 'PF':
            $triSQL = ' ORDER BY dateEvents';
            break;
        default:
            $triSQL = ''; // Normalement jamais atteint.
    }
    switch ($maxi) {
        case NULL:
            $maxiSQL = '';
            break;
        default:
            $maxiSQL = ' LIMIT ' . $maxi;
            break;
    }
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);
    $ajd = $dt->format('Y-m-d');
    $where = " WHERE 1=2"; // Condition useless pour concaténer après.
    if ($aVenir) {
        $where .= " OR dateEvents>='" . $ajd . "'";
    }
    if ($passes) {
        $where .= " OR dateEvents<'" . $ajd . "'";
    }
    ajouterRetourModele(
        'events',
        requeteSQL(
            "
            SELECT
                idEvent AS id,
                titreEvent AS titre,
                descEvent AS description,
                dateEvent AS date,
                heureEvent AS heure,
                lieuEvent AS lieu
            FROM
                website_events
            " . $where . "
            " . $triSQL . "
            " . $maxiSQL . "
            "
        )
    );
}

function MdlEventPrecis($id) {
    ajouterRetourModele(
        'event',
        requeteSQL(
            "
            SELECT
                idEvent AS id,
                titreEvent AS titre,
                descEvent AS description,
                dateEvent AS date,
                heureEvent AS heure,
                lieuEvent AS lieu
            FROM
                website_events
            WHERE
                idEvent=:idEvents
            ",
            array(
                [':idEvents', $id, 'INT']
            ),
            1
        )
    );
}

function MdlCreerEvent($titre, $date, $heure, $minute, $lieu, $desc) {
    requeteSQL(
        "
        INSERT INTO
            website_events
        VALUES
            (
                0,
                :titreEvents,
                :descEvents,
                :dateEvents,
                :heureEvents,
                :lieuEvents
            )
        ",
        array(
            [':titreEvents', $titre, 'STR'],
            [':descEvents', $desc, 'STR'],
            [':dateEvents', $date, 'STR'],
            [':heureEvents', $heure . ':' . $minute . ':00', 'STR'],
            [':lieuEvents', $lieu, 'STR']
        ),
        0,
        201,
        'L\'évent "' . $titre . '" a été ajouté avec succès !'
    );
    MdlReloadSitemapEvents();
    MdlAjouterLog(101, 'Ajout de l\'évent "' . $titre . '".');
}

function MdlModifierEvent($id, $titre, $date, $heure, $minute, $lieu, $desc) {
    requeteSQL(
        "
        UPDATE
            website_events
        SET
            titreEvent=:titreEvents,
            descEvent=:descEvents,
            dateEvent=:dateEvents,
            heureEvent=:heureEvents,
            lieuEvent=:lieuEvents
        WHERE
            idEvent=:idEvents
        ",
        array(
            [':idEvents', $id, 'INT'],
            [':titreEvents', $titre, 'STR'],
            [':descEvents', $desc, 'STR'],
            [':dateEvents', $date, 'STR'],
            [':heureEvents', $heure . ':' . $minute . ':00', 'STR'],
            [':lieuEvents', $lieu, 'STR']
        ),
        0,
        201,
        'L\'évent "' . $titre . '" a été modifié avec succès !'
    );
    MdlAjouterLog(102, 'Modification de l\'évent "' . $titre . '".');
}

function MdlSupprimerEvent($id) {
    requeteSQL(
        "
        DELETE FROM
            website_events
        WHERE
            idEvent=:idEvents
        ",
        array(
            [':idEvents', $id, 'INT']
        ),
        0,
        201,
        'L\'évent a été supprimé avec succès !'
    );
    MdlReloadSitemapEvents();
    MdlAjouterLog(103, 'Suppression d\'un évent (ID : ' . $id . ').');
}

function MdlReloadSitemapEvents() {
    $events = requeteSQL(
        "
            SELECT
                idEvent AS id
            FROM
                website_events
            ORDER BY dateEvent
            "
    );

    $arrayEvents = array();
    foreach ($events as $event) {
        array_push($arrayEvents, 'https://bde-tribu-terre.fr/events/?id=' . $event['id']);
    }

    genererSiteMap($arrayEvents, racine() . 'events/sitemap-events.xml');
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function MdlGoodiesTous($tri, $disponible, $bientot, $rupture) {
    switch ($tri) {
        case 'nom':
            $triSQL = ' ORDER BY titreGoodies';
            break;
        case 'prixAD':
            $triSQL = ' ORDER BY prixADGoodies';
            break;
        case 'prixADD':
            $triSQL = ' ORDER BY prixADGoodies DESC';
            break;
        case 'prixNAD':
            $triSQL = ' ORDER BY prixNADGoodies';
            break;
        case 'prixNADD':
            $triSQL = ' ORDER BY prixNADGoodies DESC';
            break;
        default:
            $triSQL = '';
    }
    $where = " WHERE 1=2"; // Condition useless pour concaténer après.
    $where .= $disponible ? " OR categorieGoodies=1" : '';
    $where .= $bientot ? " OR categorieGoodies=2" : '';
    $where .= $rupture ? " OR categorieGoodies=3" : '';
    ajouterRetourModele(
        'goodies',
        requeteSQL(
            "
            SELECT
                idGoodie AS id,
                titreGoodie AS titre,
                prixADGoodie AS prixAD,
                prixNADGoodie AS prixNAD,
                descGoodie AS description,
                categorieGoodie AS categorie,
                miniatureGoodie AS miniature
            FROM
                website_goodies
            " . $where . "
            " . $triSQL . "
            "
        )
    );
}

function MdlGoodiePrecis($id) {
    ajouterRetourModele(
        'goodie',
        requeteSQL(
            "
            SELECT
                idGoodie AS id,
                titreGoodie AS titre,
                prixADGoodie AS prixAD,
                prixNADGoodie AS prixNAD,
                descGoodie AS description,
                categorieGoodie AS categorie,
                miniatureGoodie AS miniature
            FROM
                website_goodies
            WHERE
                idGoodie=:idGoodies
            ",
            array(
                [':idGoodies', $id, 'INT']
            ),
            true
        )
    );
}

function MdlAjouterGoodie($rep, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    try {
        # Enregistrement de la miniature.
        $infosFichier = pathinfo($_FILES[$fileImput]['name']);
        $extension = $infosFichier['extension'];
        $newName = 'img-m-' . preg_replace('/[\W|.]/', '', $titre) . '-' . time() . '.' . $extension; # time() => aucun doublon imaginable.
        move_uploaded_file(
            $_FILES[$fileImput]['tmp_name'],
            $rep . $newName
        );
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    # Enregistrement des données dans la BDD SQL.
    requeteSQL(
        "
        INSERT INTO
            website_goodies
        VALUES
            (
                0,
                :titreGoodies,
                :prixADGoodies,
                :prixNADGoodies,
                :descGoodies,
                :categorieGoodies,
                :miniatureGoodies
            )
        ",
        array(
            [':titreGoodies', $titre, 'STR'],
            [':prixADGoodies', $prixADEuro + ($prixADCentimes / 100), 'STR'],
            [':prixNADGoodies', $prixNADEuro + ($prixNADCentimes / 100), 'STR'],
            [':descGoodies', $desc, 'STR'],
            [':categorieGoodies', $categorie, 'INT'],
            [':miniatureGoodies', $newName, 'STR']
        ),
        0,
        201,
        'Le goodie "' . $titre . '" a été ajouté avec succès !'
    );
    MdlReloadSitemapGoodies();
    MdlAjouterLog(201, 'Ajout du goodie "' . $titre . '".');
}

function MdlModifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    requeteSQL(
        "
        UPDATE
            website_goodies
        SET
            titreGoodie=:titreGoodies,
            prixADGoodie=:prixADGoodies,
            prixNADGoodie=:prixNADGoodies,
            descGoodie=:descGoodies,
            categorieGoodie=:categorieGoodies
        WHERE
            idGoodie=:idGoodies
        ",
        array(
            [':idGoodies', $id, 'INT'],
            [':titreGoodies', $titre, 'STR'],
            [':prixADGoodies', $prixADEuro + ($prixADCentimes / 100), 'STR'],
            [':prixNADGoodies', $prixNADEuro + ($prixNADCentimes / 100), 'STR'],
            [':descGoodies', $desc, 'STR'],
            [':categorieGoodies', $categorie, 'INT']
        ),
        0,
        201,
        'Le goodie ' . $titre . ' a été modifié avec succès !'
    );
    MdlReloadSitemapGoodies();
    MdlAjouterLog(202, 'Modification du goodie "' . $titre . '".');
}

function MdlSupprimerGoodie($rep, $id) {
    # Suppression des images
    $images = requeteSQL(
        "
        SELECT
            idImageGoodie AS id,
            lienImageGoodie AS lien
        FROM
            website_images_goodie
        WHERE
            idGoodie=:idGoodies
        ",
        array(
            [':idGoodies', $id, 'INT']
        )
    );
    foreach ($images as $image) {
        MdlSupprimerImageGoodie($rep, $image['id'], false);
    }

    try {
        # Suppression de la miniature du goodie
        $miniature = requeteSQL(
            "
            SELECT
                miniatureGoodie AS miniature
            FROM
                website_goodies
            WHERE
                idGoodie=:idGoodies
            ",
            array(
                [":idGoodies", $id, 'INT']
            ),
            1
        )['miniature'];
        unlink($rep . $miniature);
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    # Suppression des données
    requeteSQL(
        "
        DELETE FROM
            website_goodies
        WHERE
            idGoodie=:idGoodies
        ",
        array(
            [':idGoodies', $id, 'INT']
        ),
        0,
        201,
        'Le goodie a été supprimée avec succès !'
    );
    MdlReloadSitemapGoodies();
    MdlAjouterLog(203, 'Suppression d\'un goodie (ID : ' . $id . ').');
}

function MdlImagesGoodie($id) {
    ajouterRetourModele(
        'imagesGoodie',
        requeteSQL(
            "
            SELECT
                idImageGoodie AS id,
                lienImageGoodie AS lien
            FROM
                website_images_goodie
            WHERE
                idGoodie=:idGoodies
            ",
            array(
                [':idGoodies', $id, 'INT']
            )
        )
    );
}

function MdlAjouterImageGoodie($rep, $id, $fileImput) {
    try {
        # Enregistrement de la miniature.
        $titre = requeteSQL(
            "
            SELECT
                titreGoodie AS titre
            FROM
                website_goodies
            WHERE
                idGoodie=:idGoodies
            ",
            array(
                [':idGoodies', $id, 'INT']
            ),
            1
        )['titre'];
        $infosFichier = pathinfo($_FILES[$fileImput]['name']);
        $extension = $infosFichier['extension'];
        $newName = 'img-i-' . preg_replace('/[\W|.]/', '', $titre) . '-' . time() . '.' . $extension; # time() => aucun doublon imaginable.
        move_uploaded_file(
            $_FILES[$fileImput]['tmp_name'],
            $rep . $newName
        );
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    # Enregistrement des données dans la BDD SQL.
    requeteSQL(
        "
        INSERT INTO
            website_images_goodie
        VALUES
            (
                0,
                :idGoodies,
                :lienImagesgoodies
            )
        ",
        array(
            [':idGoodies', $id, 'INT'],
            [':lienImagesgoodies', $newName, 'STR']
        ),
        0,
        201,
        'L\'image a été ajoutée avec succès !'
    );
    MdlAjouterLog(204, 'Ajout d\'une image d\'un goodie (ID : ' . $id . ').');
}

function MdlSupprimerImageGoodie($rep, $id, $logguer) {
    try {
        $lienImage = requeteSQL(
            "
            SELECT
                lienImageGoodie AS lien
            FROM
                website_images_goodie
            WHERE
                idImageGoodie=:idImagesGoodies
            ",
            array(
                [':idImagesGoodies', $id, 'INT']
            ),
            1
        )['lien'];
        unlink($rep . $lienImage);
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    # Suppression des données
    requeteSQL(
        "
        DELETE FROM
            website_images_goodie
        WHERE
            idImageGoodie=:idImagesGoodies
        ",
        array(
            [':idImagesGoodies', $id, 'INT']
        ),
        0,
        $logguer ? 201 : NULL,
        $logguer ? 'L\'image a été supprimée avec succès !' : NULL
    );
    if ($logguer) {
        MdlAjouterLog(205, 'Suppression d\'une image d\'un goodie (ID : ' . $id . ').');
    }
}

function MdlReloadSitemapGoodies() {
    $goodies = requeteSQL(
        "
            SELECT
                idGoodie AS id
            FROM
                website_goodies
            WHERE
                categorieGoodie=1 OR categorieGoodie=2
            ORDER BY titreGoodie
            "
    );

    $arrayGoodies = array();
    foreach ($goodies as $goodie) {
        array_push($arrayGoodies, 'https://bde-tribu-terre.fr/goodies/?id=' . $goodie['id']);
    }

    genererSiteMap($arrayGoodies, racine() . 'goodies/sitemap-goodies.xml');
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function MdlJournauxTous($maxi = NULL) {
    ajouterRetourModele(
        'journaux',
        requeteSQL(
            "
            SELECT
                idJournal AS id,
                titreJournal AS titre,
                dateJournal AS date,
                pdfJournal AS pdf
            FROM
                website_journaux
            ORDER BY
                dateJournal
                DESC
            " . ($maxi ? 'LIMIT ' . $maxi : '') . "
            "
        )
    );
}

function MdlAjouterJournal($rep, $titre, $mois, $annee, $fileImput) {
    try {
        # Enregistrement du fichier PDF.
        $newName = preg_replace('/[\W]/', '', $titre) . '-' . time() . '.pdf'; # time() => aucun doublon imaginable.
        move_uploaded_file(
            $_FILES[$fileImput]['tmp_name'],
            $rep . $newName
        );
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    # Enregistrement des données dans la BDD SQL.
    requeteSQL(
        "
        INSERT INTO
            website_journaux
        VALUES
            (
                0,
                :titreJournaux,
                :dateJournaux,
                :pdfJournaux
            )
        ",
        array(
            [':titreJournaux', $titre, 'STR'],
            [':dateJournaux', $annee . '-' . $mois . '-' . '01', 'STR'],
            [':pdfJournaux', $newName, 'STR']
        ),
        0,
        201,
        'Le journal "' . $titre . '" a été ajouté avec succès !'
    );
    MdlReloadSitemapJournaux();
    MdlAjouterLog(301, 'Ajout du journal "' . $titre . '".');
}

function MdlSupprimerJournal($rep, $id) {
    try {
        # Suppression du journal
        $pdf = requeteSQL(
            "
            SELECT
                pdfJournal AS pdf
            FROM
                website_journaux
            WHERE
                idJournal=:idJournaux
            ",
            array(
                [':idJournaux', $id, 'INT']
            ),
            1
        )['pdf'];
        unlink($rep . $pdf);
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    # Suppression des données
    requeteSQL(
        "
        DELETE FROM
            website_journaux
        WHERE
            idJournal=:idJournaux
        ",
        array(
            [':idJournaux', $id, 'INT']
        ),
        0,
        201,
        'Le journal a été supprimé avec succès !'
    );
    MdlReloadSitemapJournaux();
    MdlAjouterLog(302, 'Suppression d\'un journal (ID : ' . $id . ').');
}

function MdlReloadSitemapJournaux() {
    $journaux = requeteSQL(
        "
            SELECT
                pdfJournal AS pdf
            FROM
                website_journaux
            ORDER BY
                dateJournal
                DESC
            "
    );

    $arrayJournaux = array();
    foreach ($journaux as $journal) {
        array_push($arrayJournaux, 'https://bde-tribu-terre.fr/journaux/' . $journal['pdf']);
    }

    genererSiteMap($arrayJournaux, racine() . 'journaux/sitemap-journaux.xml');
}

########################################################################################################################
# Liens Pratiques                                                                                                      #
########################################################################################################################
function MdlLiensPratiquesTous() {
    ajouterRetourModele(
        'liensPratiques',
        requeteSQL(
            "
            SELECT
                idLien AS id,
                titreLien AS titre,
                urlLien AS url
            FROM
                website_liens
            ORDER BY
                idLien
            "
        )
    );
}

function MdlAjouterLienPratique($titre, $url) {
    requeteSQL(
        "
        INSERT INTO
            website_liens
        VALUES
            (
                0,
                :titreLien,
                :urlLien
            )
        ",
        array(
            [':titreLien', $titre, 'STR'],
            [':urlLien', $url, 'STR']
        ),
        0,
        201,
        'Le lien "' . $titre . '" vers "' . $url . '" a été ajouté avec succès !'
    );
    MdlAjouterLog(701, 'Ajout du lien "' . $titre . '" vers "' . $url . '".');
}

function MdlSupprimerLienPratique($id) {
    requeteSQL(
        "DELETE FROM website_liens WHERE idLien=:idLien",
        array(
            [':idLien', $id, 'INT']
        ),
        0,
        201,
        'Le lien a été supprimé avec succès !'
    );
    MdlAjouterLog(702, 'Suppression d\'un lien (ID : ' . $id . ').');
}

########################################################################################################################
# Parrainage                                                                                                           #
########################################################################################################################
function MdlRecupBinomesParrainages($email) {
    ajouterRetourModele(
        'parrainage',
        requeteSQL(
            "
                SELECT
                    p0.email AS p0email,
                    p0.nom AS p0nom,
                    p0.parrain AS p0parrain,
                    p1.email AS p1email,
                    p1.nom AS p1nom,
                    p1.parrain AS p1parrain,
                    p2.email AS p2email,
                    p2.nom AS p2nom,
                    p2.parrain AS p2parrain,
                    p0.groupe AS groupe
                FROM
                    website_parrainage p0
                        JOIN
                    website_parrainage p1
                        JOIN
                    website_parrainage p2
                        ON
                            p1.email = p0.binome1
                                AND
                            p2.email = p0.binome2
                WHERE
                      p0.email = :email
                ",
            array(
                [':email', $email, 'STR']
            ),
            1
        )
    );
}

########################################################################################################################
# Salles (API)                                                                                                         #
########################################################################################################################
function MdlRechercherSalle($nom) {
    try {
        // La connexion va être extérieure. On récupère l'adresse publique de la racine du site (qui peut ne pas être
        // que le nom de domaine), et on ajoute l'adresse de l'API.
        $api =
            'https://' . $_SERVER['HTTP_HOST'] . preg_replace(
                '/\?.*$/',
                '',
                $_SERVER['REQUEST_URI']
            ) . RACINE . 'api/requete/?r=salles&nse=' . preg_replace(
                '/ /',
                '+',
                $nom
            );
        $curl = curl_init($api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        $arrayRetour = MET_SQLLignesMultiples(json_decode($return)->retour);
    } catch (Exception) {
        ajouterMessage(
            601,
            'Les informations sur la salle "' . $nom . '" n\'ont pas pu être récupérées sur l\'API Tribu-Terre.'
        );
        $arrayRetour = NULL;
    }
    ajouterRetourModele(
        'salles',
        $arrayRetour
    );
}

########################################################################################################################
# Génération de sitemap                                                                                                #
########################################################################################################################
function MdlGenererSiteMap($arrayLiens, $destination) {
    $sitemap = simplexml_load_string(<<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
</urlset>
EOT
    );
    if (count($arrayLiens) == 0) {
        $newURI = $sitemap->addChild('url');
        $newURI->addChild('loc', 'https://bde-tribu-terre.fr');
        $newURI->addChild('lastmod', date('Y-m-d'));
    } else {
        foreach ($arrayLiens as $lien) {
            $newURI = $sitemap->addChild('url');
            $newURI->addChild('loc', $lien);
            $newURI->addChild('lastmod', date('Y-m-d\TH:i:sP'));
        }
    }
    $sitemap->asXML($destination);
}
