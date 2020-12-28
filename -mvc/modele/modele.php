<?php
########################################################################################################################
########################################################################################################################
###                                                                                                                  ###
###                                                BASE DE DONNÉE SQL                                                ###
###                                                                                                                  ###
########################################################################################################################
########################################################################################################################

########################################################################################################################
# Fonction d'automation de requêtes SQL                                                                                #
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

########################################################################################################################
# Membres                                                                                                              #
########################################################################################################################
function MdlVerifConnexion($login, $mdp) {
    $membre = requeteSQL(
        "
        SELECT
            idMembres AS id,
            loginMembres AS login,
            prenomMembres AS prenom,
            nomMembres AS nom,
            mdpHashMembres AS mdpHash,
            mdpSaltMembres AS mdpSalt
        FROM
            Membres
        WHERE
            loginMembres=:login
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
                idMembres AS id,
                loginMembres AS login,
                prenomMembres AS prenom,
                nomMembres AS nom
            FROM
                Membres
            WHERE
                idMembres=:idMembres
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
            Membres
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
            idClesInscriptions AS id,
            strClesInscriptions AS str
        FROM
            ClesInscriptions
        WHERE
            strClesInscriptions=:cle
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
                ClesInscriptions
            WHERE
                idClesInscriptions=:id
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
                idLogActions AS idLog,
                idMembres AS idMembre,
                prenomMembres AS prenomMembre,
                nomMembres AS nomMembre,
                codeLogActions AS code,
                dateLogActions AS date,
                descLogActions AS description
            FROM
                LogActions
                    NATURAL JOIN
                Membres
            ORDER BY
                dateLogActions
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
 * <li>4 : Articles
 * <ul>
 * <li>401 : Ajout d'un article</li>
 * <li>402 : Modification d'un article</li>
 * <li>403 : Suppression d'un article</li>
 * <li>404 : Ajout d'une image à un article</li>
 * <li>405 : Suppression d'une image à un article</li>
 * <li>406 : Ajout d'une catégorie d'article</li>
 * <li>407 : Renommage d'une catégorie d'article</li>
 * </ul>
 * </li>
 * <li>5 : Articles vidéo
 * <ul>
 * <li>501 : Ajout d'un article vidéo</li>
 * <li>502 : Modification d'un article vidéo</li>
 * <li>503 : Suppression d'un article vidéo</li>
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
            LogActions
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
                idEvents AS id,
                titreEvents AS titre,
                descEvents AS description,
                dateEvents AS date,
                heureEvents AS heure,
                lieuEvents AS lieu
            FROM
                Events
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
                idEvents AS id,
                titreEvents AS titre,
                descEvents AS description,
                dateEvents AS date,
                heureEvents AS heure,
                lieuEvents AS lieu
            FROM
                Events
            WHERE
                idEvents=:idEvents
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
            Events
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
            Events
        SET
            titreEvents=:titreEvents,
            descEvents=:descEvents,
            dateEvents=:dateEvents,
            heureEvents=:heureEvents,
            lieuEvents=:lieuEvents
        WHERE
            idEvents=:idEvents
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
            Events
        WHERE
            idEvents=:idEvents
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
                idEvents AS id
            FROM
                Events
            ORDER BY dateEvents
            "
    );

    $arrayEvents = array();
    foreach ($events as $event) {
        array_push($arrayEvents, 'https://bde-tribu-terre.fr/events/?id=' . $event['id']);
    }

    MdlGenererSiteMap($arrayEvents, RACINE . 'events/sitemap-events.xml');
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
                idGoodies AS id,
                titreGoodies AS titre,
                prixADGoodies AS prixAD,
                prixNADGoodies AS prixNAD,
                descGoodies AS description,
                categorieGoodies AS categorie,
                miniatureGoodies AS miniature
            FROM
                Goodies
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
                idGoodies AS id,
                titreGoodies AS titre,
                prixADGoodies AS prixAD,
                prixNADGoodies AS prixNAD,
                descGoodies AS description,
                categorieGoodies AS categorie,
                miniatureGoodies AS miniature
            FROM
                Goodies
            WHERE
                idGoodies=:idGoodies
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
            Goodies
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
            Goodies
        SET
            titreGoodies=:titreGoodies,
            prixADGoodies=:prixADGoodies,
            prixNADGoodies=:prixNADGoodies,
            descGoodies=:descGoodies,
            categorieGoodies=:categorieGoodies
        WHERE
            idGoodies=:idGoodies
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
            idImagesGoodies AS id,
            lienImagesGoodies AS lien
        FROM
            ImagesGoodies
        WHERE
            idGoodies=:idGoodies
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
                miniatureGoodies AS miniature
            FROM
                Goodies
            WHERE
                idGoodies=:idGoodies
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
            Goodies
        WHERE
            idGoodies=:idGoodies
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
                idImagesGoodies AS id,
                lienImagesGoodies AS lien
            FROM
                ImagesGoodies
            WHERE
                idGoodies=:idGoodies
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
                titreGoodies AS titre
            FROM
                Goodies
            WHERE
                idGoodies=:idGoodies
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
            ImagesGoodies
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
                lienImagesGoodies AS lien
            FROM
                ImagesGoodies
            WHERE
                idImagesGoodies=:idImagesGoodies
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
            ImagesGoodies
        WHERE
            idImagesGoodies=:idImagesGoodies
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
                idGoodies AS id
            FROM
                Goodies
            WHERE
                categorieGoodies=1 OR categorieGoodies=2
            ORDER BY titreGoodies
            "
    );

    $arrayGoodies = array();
    foreach ($goodies as $goodie) {
        array_push($arrayGoodies, 'https://bde-tribu-terre.fr/goodies/?id=' . $goodie['id']);
    }

    MdlGenererSiteMap($arrayGoodies, RACINE . 'goodies/sitemap-goodies.xml');
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
                idJournaux AS id,
                titreJournaux AS titre,
                dateJournaux AS date,
                pdfJournaux AS pdf
            FROM
                Journaux
            ORDER BY
                dateJournaux
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
            Journaux
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
                pdfJournaux AS pdf
            FROM
                Journaux
            WHERE
                idJournaux=:idJournaux
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
            Journaux
        WHERE
            idJournaux=:idJournaux
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
                pdfJournaux AS pdf
            FROM
                Journaux
            ORDER BY
                dateJournaux
                DESC
            "
    );

    $arrayJournaux = array();
    foreach ($journaux as $journal) {
        array_push($arrayJournaux, 'https://bde-tribu-terre.fr/journaux/' . $journal['pdf']);
    }

    MdlGenererSiteMap($arrayJournaux, RACINE . 'journaux/sitemap-journaux.xml');
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function MdlArticlesTous($visibles = true, $invisibles = false) {
    ajouterRetourModele(
        'articles',
        requeteSQL(
            "
            SELECT
                idArticles AS id,
                titreArticles AS titre,
                titreCategoriesArticles AS categorie,
                visibiliteArticles AS visibilite,
                texteArticles AS texte,
                prenomMembres AS prenomAuteur,
                nomMembres AS nomAuteur,
                dateCreationArticles AS dateCreation,
                dateModificationArticles AS dateModification
            FROM
                Articles
                    NATURAL JOIN
                Membres
                    NATURAL JOIN
                CategoriesArticles
            WHERE
                1=2" . ($visibles ? " OR visibiliteArticles=1" : "") . ($invisibles ? " OR visibiliteArticles=0" : "") . "
            ORDER BY
                dateCreationArticles
                DESC
            "
        )
    );
}

function MdlArticlePrecis($id) {
    ajouterRetourModele(
        'article',
        requeteSQL(
            "
            SELECT
                idArticles AS id,
                titreArticles AS titre,
                idCategoriesArticles AS idCategorie,
                titreCategoriesArticles AS categorie,
                visibiliteArticles AS visibilite,
                texteArticles AS texte,
                prenomMembres AS prenomAuteur,
                nomMembres AS nomAuteur,
                dateCreationArticles AS dateCreation,
                dateModificationArticles AS dateModification
            FROM
                Articles
                    NATURAL JOIN
                Membres
                    NATURAL JOIN
                CategoriesArticles
            WHERE
                idArticles=:idArticles
            ",
            array(
                [':idArticles', $id, 'INT']
            ),
            1
        )
    );
}

function MdlAjouterArticle($titre, $categorie, $visibilite, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);
    requeteSQL(
        "
        INSERT INTO
            Articles
        VALUES
            (
                0,
                :idMembres,
                :idCategorieArticles,
                :titreArticles,
                :texteArticles,
                :visibiliteArticles,
                :dateCreationArticles,
                :dateModificationArticles
            )
        ",
        array(
            [':idMembres', $_SESSION['membre']['id'], 'INT'],
            [':idCategorieArticles', $categorie, 'INT'],
            [':titreArticles', $titre, 'STR'],
            [':texteArticles', $texte, 'STR'],
            [':visibiliteArticles', $visibilite, 'INT'],
            [':dateCreationArticles', $dt->format('Y-m-d'), 'STR'],
            [':dateModificationArticles', NULL, 'STR']
        ),
        0,
        201,
        'L\'article "' . $titre . '" a été ajouté avec succès !'
    );
    MdlReloadSitemapArticles();
    MdlAjouterLog(401, 'Ajout de l\'article "' . $titre . '".');
}

function MdlModifierArticle($id, $titre, $categorie, $visibilite, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);
    requeteSQL(
        "
        UPDATE
            Articles
        SET
            idCategoriesArticles=:idCategoriesArticles,
            titreArticles=:titreArticles,
            visibiliteArticles=:visibiliteArticles,
            texteArticles=:texteArticles,
            dateModificationArticles=:dateModificationArticles
        WHERE
            idArticles=:idArticles
        ",
        array(
            [':idCategoriesArticles', $categorie, 'INT'],
            [':titreArticles', $titre, 'STR'],
            [':visibiliteArticles', $visibilite, 'INT'],
            [':texteArticles', $texte, 'STR'],
            [':idArticles', $id, 'INT'],
            [':dateModificationArticles', $dt->format('Y-m-d'), 'STR']
        ),
        0,
        201,
        'L\'article "' . $titre . '" a été modifié avec succès !'
    );
    MdlReloadSitemapArticles();
    MdlAjouterLog(402, 'Modification de l\'article "' . $titre . '".');
}

function MdlSupprimerArticle($rep, $id) {
    # Suppression des images
    $images = requeteSQL(
        "
        SELECT
            idImagesArticles AS id,
            lienImagesArticles AS lien
        FROM
            ImagesArticles
        WHERE
            idArticles=:idArticles
        ",
        array(
            [':idArticles', $id, 'INT']
        )
    );
    foreach ($images as $image) {
        MdlSupprimerImageArticle($rep, $image['id'], false);
    }

    # Suppression des données
    requeteSQL(
        "
        DELETE FROM
            Articles
        WHERE
            idArticles=:idArticles
        ",
        array(
            [':idArticles', $id, 'INT']
        ),
        0,
        201,
        'L\'article a été supprimée avec succès !'
    );
    MdlReloadSitemapArticles();
    MdlAjouterLog(403, 'Suppression d\'un article (ID : ' . $id . ').');
}

function MdlImagesArticle($id, $maxi) {
    ajouterRetourModele(
        'imagesArticle',
        requeteSQL(
            "
            SELECT
                idImagesArticles AS id,
                lienImagesArticles AS lien
            FROM
                ImagesArticles
            WHERE
                idArticles=:idArticles
            " . ($maxi ? 'LIMIT ' . $maxi : '') . "
            ",
            array(
                [':idArticles', $id, 'INT']
            )
        )
    );
}

function MdlAjouterImageArticle($rep, $id, $fileImput) {
    try {
        # Enregistrement de l'image.
        $titre = requeteSQL(
            "
            SELECT
                titreArticles AS titre
            FROM
                Articles
            WHERE
                idArticles=:idArticles
            ",
            array(
                [':idArticles', $id, 'INT']
            ),
            1
        )['titre'];
        $infosFichier = pathinfo($_FILES[$fileImput]['name']);
        $extension = $infosFichier['extension'];
        $newName = 'img-' . preg_replace('/[\W|.]/', '', $titre) . '-' . time() . '.' . $extension; # time() => aucun doublon imaginable.
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
            ImagesArticles
        VALUES
            (
                0,
                :idArticles,
                :lienImagesArticles
            )
        ",
        array(
            [':idArticles', $id, 'INT'],
            [':lienImagesArticles', $newName, 'STR']
        ),
        0,
        201,
        'L\'image de l\'article a été ajoutée avec succès !'
    );
    MdlAjouterLog(404, 'Ajout d\'une image d\'un article (ID : ' . $id . ').');
}

function MdlSupprimerImageArticle($rep, $id, $logguer) {
    # Suppression de l'image
    $image = requeteSQL(
        "
        SELECT
            lienImagesArticles AS lien
        FROM
            ImagesArticles
        WHERE
            idImagesArticles=:idImagesArticles
        ",
        array(
            [':idImagesArticles', $id, 'INT']
        ),
        1
    )['lien'];
    unlink($rep . $image);

    # Suppression des données
    requeteSQL(
        "
        DELETE FROM
            ImagesArticles
        WHERE
            idImagesArticles=:idImagesArticles
        ",
        array(
            [':idImagesArticles', $id, 'INT']
        ),
        0,
        $logguer ? 201 : NULL,
        $logguer ? 'L\'image de l\'article a été supprimé avec succès !' : NULL
    );
    if ($logguer) {
        MdlAjouterLog(405, 'Suppression d\'une image d\'un article (ID : ' . $id . ').');
    }
}

function MdlMiniaturesArticles($visibles = true, $invisibles = false) {
    $retour = array();
    $miniatures = requeteSQL(
        "
        SELECT
            idArticles AS id,
            lienImagesArticles AS lien
        FROM
            (
                SELECT
                    MIN(idImagesArticles) AS idImagesArticles,
                    idArticles
                FROM
                    ImagesArticles
                GROUP BY
                    idArticles
            ) AS T
                NATURAL JOIN
            ImagesArticles
                NATURAL JOIN
            Articles   
        WHERE
            1=2" . ($visibles ? " OR visibiliteArticles=1" : "") . ($invisibles ? " OR visibiliteArticles=0" : "") . "
        "
    );
    foreach ($miniatures as $miniature) {
        $retour[$miniature['id']] = $miniature['lien'];
    }
    ajouterRetourModele(
        'miniaturesArticles',
        $retour
    );
}

########################################################################################################################
# Articles vidéo                                                                                                       #
########################################################################################################################
function MdlArticlesVideoTous($visibles = true, $invisibles = false) {
    $arrayRetour = requeteSQL(
        "
        SELECT
            idArticlesYouTube AS id,
            titreArticlesYouTube AS titre,
            titreCategoriesArticles AS categorie,
            visibiliteArticlesYouTube AS visibilite,
            lienArticlesYouTube AS lien,
            texteArticlesYouTube AS texte,
            prenomMembres AS prenomAuteur,
            nomMembres AS nomAuteur,
            dateCreationArticlesYouTube AS dateCreation,
            dateModificationArticlesYouTube AS dateModification
        FROM
            ArticlesYouTube
                NATURAL JOIN
            Membres
                NATURAL JOIN
            CategoriesArticles
        WHERE
            1=2" . ($visibles ? " OR visibiliteArticlesYouTube=1" : "") . ($invisibles ? " OR visibiliteArticlesYouTube=0" : "") . "
        ORDER BY
            dateCreationArticlesYouTube
            DESC
        "
    );
    foreach ($arrayRetour as $articleVideo) {
        try {
            $youtube = "http://www.youtube.com/oembed?url=" . $articleVideo['lien'] . "&format=json";
            $curl = curl_init($youtube);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $return = curl_exec($curl);
            curl_close($curl);
            $articleVideo['API_YouTube'] = MET_SQLLigneUnique(json_decode($return));
        } catch (Exception $e) {
            ajouterMessage(601, 'Les informations sur la vidéo à l\'adresse "' . $arrayRetour['lien'] . '" n\'ont pas pu être récupérées sur l\'API YouTube.');
            $articleVideo['API_YouTube'] = NULL;
        }
    }
    ajouterRetourModele(
        'articlesVideo',
        $arrayRetour
    );
}

function MdlArticleVideoPrecis($id, $article = false) {
    $arrayRetour = requeteSQL(
        "
        SELECT
            idArticlesYouTube AS id,
            titreArticlesYouTube AS titre,
            idCategoriesArticles AS idCategorie,
            titreCategoriesArticles AS categorie,
            visibiliteArticlesYouTube AS visibilite,
            lienArticlesYouTube AS lien,
            texteArticlesYouTube AS texte,
            prenomMembres AS prenomAuteur,
            nomMembres AS nomAuteur,
            dateCreationArticlesYouTube AS dateCreation,
            dateModificationArticlesYouTube AS dateModification
        FROM
            ArticlesYouTube
                NATURAL JOIN
            Membres
                NATURAL JOIN
            CategoriesArticles
        WHERE
            idArticlesYouTube=:idArticlesYouTube
        ",
        array(
            [':idArticlesYouTube', $id, 'INT']
        ),
        1
    );
    try {
        $youtube = "http://www.youtube.com/oembed?url=" . $arrayRetour['lien'] . "&format=json";
        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        $arrayRetour['API_YouTube'] = MET_SQLLigneUnique(json_decode($return));
    } catch (Exception $e) {
        ajouterMessage(601, 'Les informations sur la vidéo à l\'adresse "' . $arrayRetour['lien'] . '" n\'ont pas pu être récupérées sur l\'API YouTube.');
        $arrayRetour['API_YouTube'] = NULL;
    }
    ajouterRetourModele(
        $article ? 'article' : 'articleVideo',
        $arrayRetour
    );
}

function MdlAjouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);
    requeteSQL(
        "
        INSERT INTO
            ArticlesYouTube
        VALUES
            (
                0,
                :idCategorieArticles,
                :idMembres,
                :titreArticlesYouTube,
                :texteArticlesYouTube,
                :lienArticlesYouTube,
                :visibiliteArticlesYouTube,
                :dateCreationArticlesYouTube,
                :dateModificationArticlesYouTube
             )
        ",
        array(
            [':idMembres', $_SESSION['membre']['id'], 'INT'],
            [':idCategorieArticles', $categorie, 'INT'],
            [':titreArticlesYouTube', $titre, 'STR'],
            [':lienArticlesYouTube', $lien, 'STR'],
            [':texteArticlesYouTube', $texte, 'STR'],
            [':visibiliteArticlesYouTube', $visibilite, 'INT'],
            [':dateCreationArticlesYouTube', $dt->format('Y-m-d'), 'STR'],
            [':dateModificationArticlesYouTube', NULL, 'STR'],
        ),
        0,
        201,
        'L\'article vidéo ' . $titre . ' a été ajouté avec succès'
    );
    MdlReloadSitemapArticles();
    MdlAjouterLog(501, 'Ajout de l\'article vidéo "' . $titre . '".');
}

function MdlModifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);
    requeteSQL(
        "
        UPDATE
            ArticlesYouTube
        SET
            idCategoriesArticles=:idCategoriesArticles,
            titreArticlesYouTube=:titreArticlesYouTube,
            visibiliteArticlesYouTube=:visibiliteArticlesYouTube,
            lienArticlesYouTube=:lienArticlesYouTube,
            texteArticlesYouTube=:texteArticlesYouTube,
            dateModificationArticlesYouTube=:dateModificationArticlesYouTube
        WHERE
            idArticlesYouTube=:idArticlesYouTube
        ",
        array(
            [':idCategoriesArticles', $categorie, 'INT'],
            [':titreArticlesYouTube', $titre, 'STR'],
            [':visibiliteArticlesYouTube', $visibilite, 'INT'],
            [':texteArticlesYouTube', $texte, 'STR'],
            [':lienArticlesYouTube', $lien, 'STR'],
            [':idArticlesYouTube', $id, 'INT'],
            [':dateModificationArticlesYouTube', $dt->format('Y-m-d'), 'STR']
        ),
        0,
        201,
        'L\'article vidéo ' . $titre . ' a été modifié avec succès !'
    );
    MdlReloadSitemapArticles();
    MdlAjouterLog(502, 'Modification de l\'article vidéo "' . $titre . '".');
}

function MdlSupprimerArticleVideo($id) {
    requeteSQL(
        "DELETE FROM ArticlesYouTube WHERE idArticlesYouTube=:idArticlesYouTube",
        array(
            [':idArticlesYouTube', $id, 'INT']
        ),
        0,
        201,
        'L\'article vidéo a été supprimé avec succès !'
    );
    MdlReloadSitemapArticles();
    MdlAjouterLog(503, 'Suppression d\'un article vidéo (ID : ' . $id . ').');
}

function MdlMiniaturesArticlesVideo($visibles = true, $invisibles = false) {
    $retour = array();
    $articlesVideo = requeteSQL(
        "
        SELECT
            idArticlesYouTube AS id,
            lienArticlesYouTube AS lien
        FROM
            ArticlesYouTube
        WHERE
            1=2" . ($visibles ? " OR visibiliteArticlesYouTube=1" : "") . ($invisibles ? " OR visibiliteArticlesYouTube=0" : "") . "
        "
    );
    foreach ($articlesVideo as $articleVideo) {
        try {
            $youtube = "http://www.youtube.com/oembed?url=" . $articleVideo['lien'] . "&format=json";
            $curl = curl_init($youtube);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $return = curl_exec($curl);
            curl_close($curl);
            $retour[$articleVideo['id']] = MET_SQLLigneUnique(json_decode($return))['thumbnail_url'];
        } catch (Exception $e) {
            ajouterMessage(601, 'Les informations sur la vidéo à l\'adresse "' . $articleVideo['lien'] . '" n\'ont pas pu être récupérées sur l\'API YouTube.');
            $retour[$articleVideo['id']] = NULL;
        }
    }
    ajouterRetourModele(
        'miniaturesArticlesVideo',
        $retour
    );
}

########################################################################################################################
# Articles texte et vidéo en commun                                                                                    #
########################################################################################################################
function MdlDernierArticleTexteVideo($visibles = true, $invisibles = false) {
    $articleTexte = requeteSQL(
        "
        SELECT
            idArticles AS id,
            MAX(dateCreationArticles) AS date
        FROM
            Articles
        WHERE
            1=2" . ($visibles ? " OR visibiliteArticles=1" : "") . ($invisibles ? " OR visibiliteArticles=0" : "") . "
        ",
        array(),
        1
    );
    $articleVideo = requeteSQL(
        "
        SELECT
            idArticlesYouTube AS id,
            MAX(dateCreationArticlesYouTube) AS date
        FROM
            ArticlesYouTube
        WHERE
            1=2" . ($visibles ? " OR visibiliteArticlesYouTube=1" : "") . ($invisibles ? " OR visibiliteArticlesYouTube=0" : "") . "
        ",
        array(),
        1
    );
    if ($articleTexte['id'] && $articleVideo['id']) {
        if (strcmp($articleTexte['date'], $articleVideo['date']) >= 0) {
            MdlArticlePrecis($articleTexte['id']);
        } else {
            MdlArticleVideoPrecis($articleVideo['id'], true);
        }
    } elseif ($articleTexte['id']) {
        MdlArticlePrecis($articleTexte['id']);
    } elseif ($articleVideo['id']) {
        MdlArticleVideoPrecis($articleVideo['id'], true);
    } else {
        ajouterRetourModele(
            'article',
            NULL
        );
    }
}

function MdlReloadSitemapArticles() {
    $articles = requeteSQL(
        "
            SELECT
                idArticles AS id
            FROM
                Articles
            WHERE
                visibiliteArticles=1
            ORDER BY
                dateCreationArticles
                DESC
            "
    );
    $articlesVideo = requeteSQL(
        "
            SELECT
                idArticlesYouTube AS id
            FROM
                ArticlesYouTube
            WHERE
                visibiliteArticlesYouTube=1
            ORDER BY
                dateCreationArticlesYouTube
                DESC
            "
    );

    $arrayArticles = array();
    foreach ($articles as $article) {
        array_push($arrayArticles, 'https://bde-tribu-terre.fr/articles/?id=T' . $article['id']);
    }
    foreach ($articlesVideo as $articleVideo) {
        array_push($arrayArticles, 'https://bde-tribu-terre.fr/articles/?id=V' . $articleVideo['id']);
    }

    MdlGenererSiteMap($arrayArticles, RACINE . 'articles/sitemap-articles.xml');
}

########################################################################################################################
# Cétégories d'articles                                                                                                #
########################################################################################################################
function MdlCategoriesArticlesTous() {
    ajouterRetourModele(
        'categoriesArticles',
        requeteSQL(
            "
            SELECT
                idCategoriesArticles AS id,
                titreCategoriesArticles AS titre
            FROM
                CategoriesArticles
            ORDER BY
                titreCategoriesArticles
            "
        )
    );
}

function MdlAjouterCategorieArticle($titre) {
    requeteSQL(
        "
        INSERT INTO
            CategoriesArticles
        VALUES
            (
                0,
                :titreCategoriesArticles
            )
        ",
        array(
            [':titreCategoriesArticles', $titre, 'STR']
        ),
        0,
        201,
        'La catégorie d\'articles "' . $titre . '" a été ajouté avec succès !'
    );
    MdlAjouterLog(406, 'Ajout de la catégorie d\'articles "' . $titre . '".');
}

function MdlRenommerCategorieArticle($id, $titre) {
    requeteSQL(
        "
        UPDATE
            CategoriesArticles
        SET
            titreCategoriesArticles=:titreCategoriesArticles
        WHERE
            idCategoriesArticles=:idCategoriesArticles
        ",
        array(
            [':idCategoriesArticles', $id, 'INT'],
            [':titreCategoriesArticles', $titre, 'STR']
        ),
        0,
        201,
        'La catégorie d\'articles a été renommée en "' . $titre . '" avec succès !'
    );
    MdlAjouterLog(407, 'Renommage de la catégorie d\'article en "' . $titre . '" (ID : ' . $id . ').');
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
                idLiensPratiques AS id,
                titreLiensPratiques AS titre,
                urlLiensPratiques AS url
            FROM
                LiensPratiques
            ORDER BY
                idLiensPratiques
            "
        )
    );
}

function MdlAjouterLienPratique($titre, $url) {
    requeteSQL(
        "
        INSERT INTO
            LiensPratiques
        VALUES
            (
                0,
                :titreLiensPratiques,
                :urlLiensPratiques
            )
        ",
        array(
            [':titreLiensPratiques', $titre, 'STR'],
            [':urlLiensPratiques', $url, 'STR']
        ),
        0,
        201,
        'Le lien "' . $titre . '" vers "' . $url . '" a été ajouté avec succès !'
    );
    MdlAjouterLog(701, 'Ajout du lien "' . $titre . '" vers "' . $url . '".');
}

function MdlSupprimerLienPratique($id) {
    requeteSQL(
        "DELETE FROM LiensPratiques WHERE idLiensPratiques=:idLiensPratiques",
        array(
            [':idLiensPratiques', $id, 'INT']
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
                    Parrainage p0
                        JOIN
                    Parrainage p1
                        JOIN
                    Parrainage p2
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
        $api = 'https://' . $_SERVER['HTTP_HOST'] . preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']) . RACINE . 'api/requete/?r=salles&nse=' . preg_replace('/ /', '+', $nom);
        $curl = curl_init($api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        $arrayRetour = MET_SQLLignesMultiples(json_decode($return)->retour);
    } catch (Exception $e) {
        ajouterMessage(601, 'Les informations sur la salle "' . $nom . '" n\'ont pas pu être récupérées sur l\'API Tribu-Terre.');
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
