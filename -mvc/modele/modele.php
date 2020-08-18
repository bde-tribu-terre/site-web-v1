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
        $mdpSaisieHash = hash('whirlpool', html_entity_decode($membre['mdpSalt']) . $mdp);
        if (html_entity_decode($membre['mdpHash']) == $mdpSaisieHash) {
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

function MdlAjouterLog($code, $message) {
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
            [':idMembres', $_SESSION['membre']['id'], 'STR'],
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
    MdlAjouterLog(103, 'Suppression d\'un évent (ID : ' . $id . ').');
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
    MdlAjouterLog(101, 'Ajout du goodie "' . $titre . '".');
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
    MdlAjouterLog(302, 'Suppression d\'un journal (ID : ' . $id . ').');
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
    MdlAjouterLog(403, 'Suppression d\'un article (ID : ' . $id . ').');
}

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
# Salles (API)                                                                                                         #
########################################################################################################################
function MdlRechercherSalle($nom) {
    try {
        $api = 'http://' . $_SERVER['HTTP_HOST'] . preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']) . RACINE . 'api/requete/?r=salles&ns=' . preg_replace('/ /', '+', $nom);
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