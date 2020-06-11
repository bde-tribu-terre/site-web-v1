<?php
########################################################################################################################
# Fonctions de mise en tableau                                                                                         #
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

########################################################################################################################
# Fonction d'automation de requêtes SQL                                                                                #
########################################################################################################################
function requeteSQL($requete, $variables = array(), $resultatUnique = false, $codeMessageSucces = NULL, $texteMessageSucces = NULL) {
    try {
        $connexion = getConnect();
        $prepare = $connexion->prepare($requete);
        foreach ($variables as $variable) {
            $data_type = $variable[2] == 'INT' ? PDO::PARAM_INT : PDO::PARAM_STR;
            $prepare->bindValue($variable[0], $variable[1], $data_type);
        }
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        if ($resultatUnique) {
            $retour = MET_SQLLigneUnique($prepare->fetch());
        } else {
            $retour = MET_SQLLignesMultiples($prepare->fetchAll());
        }
        $prepare->closeCursor();
        if ($codeMessageSucces && $texteMessageSucces) {
            ajouterMessage($codeMessageSucces, $texteMessageSucces);
        }
        return $retour;
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        if ($resultatUnique) {
            return NULL;
        }
        return array();
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
        true
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
            true
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
        false,
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
        true,
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
        )
    );
}

########################################################################################################################
# Évents                                                                                                               #
########################################################################################################################
function MdlEventsTous($tri, $aVenir, $passes, $maxi) {
    try {
        $timestamp = time();
        $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
        $dt->setTimestamp($timestamp);

        $ajd = $dt->format('Y-m-d');
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
        $where = " WHERE 1=2"; // Condition useless pour concaténer après.
        if ($aVenir) {
            $where .= " OR dateEvents>='" . $ajd . "'";
        }
        if ($passes) {
            $where .= " OR dateEvents<'" . $ajd . "'";
        }
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('events', MET_SQLLignesMultiples($prepare->fetchall()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('events', array());
    }
}

function MdlEventPrecis($id) {
    try {
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('event', MET_SQLLigneUnique($prepare->fetch()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('event', NULL);
    }
}

function MdlCreerEvent($titre, $date, $heure, $minute, $lieu, $desc) {
    try {
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':titreEvents', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':descEvents', $desc, PDO::PARAM_STR);
        $prepare->bindValue(':dateEvents', $date, PDO::PARAM_STR);
        $prepare->bindValue(':heureEvents', $heure . ':' . $minute . ':00', PDO::PARAM_STR);
        $prepare->bindValue(':lieuEvents', $lieu, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'L\'évent "' . $titre . '" a été ajouté avec succès !');
        MdlAjouterLog(101, 'Ajout de l\'évent "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlModifierEvent($id, $titre, $date, $heure, $minute, $lieu, $desc) {
    try {
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
        $prepare->bindValue(':titreEvents', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':descEvents', $desc, PDO::PARAM_STR);
        $prepare->bindValue(':dateEvents', $date, PDO::PARAM_STR);
        $prepare->bindValue(':heureEvents', $heure . ':' . $minute . ':00', PDO::PARAM_STR);
        $prepare->bindValue(':lieuEvents', $lieu, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'L\'évent "' . $titre . '" a été modifié avec succès !');
        MdlAjouterLog(102, 'Modification de l\'évent "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlSupprimerEvent($id) {
    try {
        $connexion = getConnect();
        $requete =
            "
            DELETE FROM
                Events
            WHERE
                idEvents=:idEvents
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'L\'évent a été supprimé avec succès !');
        MdlAjouterLog(103, 'Suppression d\'un évent (ID : ' . $id . ').');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function MdlGoodiesTous($tri, $disponible, $bientot, $rupture) {
    try {
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
        if ($disponible) {
            $where .= " OR categorieGoodies=1";
        }
        if ($bientot) {
            $where .= " OR categorieGoodies=2";
        }
        if ($rupture) {
            $where .= " OR categorieGoodies=3";
        }
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('goodies', MET_SQLLignesMultiples($prepare->fetchAll()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterRetourModele('goodies', array());
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlGoodiePrecis($id) {
    try {
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('goodie', MET_SQLLigneUnique($prepare->fetch()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('goodie', NULL);
    }
}

function MdlImagesGoodie($id) {
    try {
        $connexion = getConnect();
        $requete =
            "
            SELECT
                idImagesGoodies AS id,
                lienImagesGoodies AS lien
            FROM
                ImagesGoodies
            WHERE
                idGoodies=:idGoodies
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('imagesGoodie', MET_SQLLignesMultiples($prepare->fetchAll()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterRetourModele('imagesGoodie', array());
        ajouterMessage(600, $e->getMessage());
    }
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
    try {
        $connexion = getConnect();
        $requete =
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
             ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':titreGoodies', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':prixADGoodies', $prixADEuro + ($prixADCentimes / 100), PDO::PARAM_STR);
        $prepare->bindValue(':prixNADGoodies', $prixNADEuro + ($prixNADCentimes / 100), PDO::PARAM_STR);
        $prepare->bindValue(':descGoodies', $desc, PDO::PARAM_STR);
        $prepare->bindValue(':categorieGoodies', $categorie, PDO::PARAM_INT);
        $prepare->bindValue(':miniatureGoodies', $newName, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'Le goodie "' . $titre . '" a été ajouté avec succès !');
        MdlAjouterLog(101, 'Ajout du goodie "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlAjouterImageGoodie($rep, $id, $titre, $fileImput) {
    try {
        # Enregistrement de la miniature.
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

    try {
        # Enregistrement des données dans la BDD SQL.
        $connexion = getConnect();
        $requete =
            "
            INSERT INTO
                ImagesGoodies
            VALUES
                (
                    0,
                    :idGoodies,
                    :lienImagesgoodies
                )
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->bindValue(':lienImagesgoodies', $newName, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'L\'image a été ajoutée avec succès !');
        MdlAjouterLog(204, 'Ajout d\'une image d\'un goodie (ID : ' . $id . ').');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlModifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    try {
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->bindValue(':titreGoodies', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':prixADGoodies', $prixADEuro + ($prixADCentimes / 100), PDO::PARAM_STR);
        $prepare->bindValue(':prixNADGoodies', $prixNADEuro + ($prixNADCentimes / 100), PDO::PARAM_STR);
        $prepare->bindValue(':descGoodies', $desc, PDO::PARAM_STR);
        $prepare->bindValue(':categorieGoodies', $categorie, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'Le goodie ' . $titre . ' a été modifié avec succès !');
        MdlAjouterLog(202, 'Modification du goodie "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlSupprimerImageGoodie($rep, $id, $logguer) {
    try {
        # Suppression de l'image
        $connexion = getConnect();
        $requete =
            "
            SELECT
                lienImagesGoodies
            FROM
                ImagesGoodies
            WHERE
                idImagesGoodies=:idImagesGoodies
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idImagesGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        $ligne = $prepare->fetch();
        $prepare->closeCursor();
        $image = $ligne->lienImagesGoodies;
        unlink($rep . $image);
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    try {
        # Suppression des données
        $connexion = getConnect();
        $requete =
            "
            DELETE FROM
                ImagesGoodies
            WHERE
                idImagesGoodies=:idImagesGoodies
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idImagesGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }

    if ($logguer) {
        ajouterMessage(201, 'L\'image a été supprimée avec succès !');
        MdlAjouterLog(205, 'Suppression d\'une image d\'un goodie (ID : ' . $id . ').');
    }
}

function MdlSupprimerGoodie($rep, $id) {
    try {
        # Suppression des images
        $connexion = getConnect();
        $requete =
            "
            SELECT
                idImagesGoodies,
                lienImagesGoodies
            FROM
                ImagesGoodies
            WHERE
                idGoodies=:idGoodies
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        $lignes = $prepare->fetchall();
        $prepare->closeCursor();
        foreach ($lignes as $ligne) {
            MdlSupprimerImageGoodie($rep, $ligne->idImagesGoodies, false);
        }
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    try {
        # Suppression de la miniature du goodie
        $connexion = getConnect();
        $requete =
            "
            SELECT
                miniatureGoodies
            FROM
                Goodies
            WHERE
                idGoodies=:idGoodies
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        $ligne = $prepare->fetch();
        $prepare->closeCursor();
        $miniature = $ligne->miniatureGoodies;
        unlink($rep . $miniature);
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    try {
        # Suppression des données
        $connexion = getConnect();
        $requete =
            "
            DELETE FROM
                Goodies
            WHERE
                idGoodies=:idGoodies
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'Le goodie a été supprimée avec succès !');
        MdlAjouterLog(203, 'Suppression d\'un goodie (ID : ' . $id . ').');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function MdlJournauxTous($maxi) {
    try {
        switch ($maxi) {
            case NULL:
                $maxiSQL = '';
                break;
            default:
                $maxiSQL = ' LIMIT ' . $maxi;
                break;
        }
        $connexion = getConnect();
        $requete =
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
            " . $maxiSQL . "
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('journaux', MET_SQLLignesMultiples($prepare->fetchall()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('journaux', array());
    }
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

    try {
        # Enregistrement des données dans la BDD SQL.
        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':titreJournaux', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':dateJournaux', $annee . '-' . $mois . '-' . '01', PDO::PARAM_STR);
        $prepare->bindValue(':pdfJournaux', $newName, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'Le journal "' . $titre . '" a été ajouté avec succès !');
        MdlAjouterLog(301, 'Ajout du journal "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlSupprimerJournal($rep, $id) {
    try {
        # Suppression du journal
        $connexion = getConnect();
        $requete =
            "
            SELECT
                pdfJournaux
            FROM
                Journaux
            WHERE
                idJournaux=:idJournaux
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idJournaux', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        $ligne = $prepare->fetch();
        $prepare->closeCursor();
        $pdf = $ligne->pdfJournaux;
        unlink($rep . $pdf);
    } catch (Exception $e) {
        ajouterMessage(501, $e->getMessage());
        return;
    }

    try {
        # Suppression des données
        $connexion = getConnect();
        $requete =
            "
            DELETE FROM
                Journaux
            WHERE
                idJournaux=:idJournaux
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idJournaux', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->closeCursor();
        MdlAjouterLog(302, 'Suppression d\'un journal (ID : ' . $id . ').');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function MdlCategoriesArticlesTous() {
    try {
        $connexion = getConnect();
        $requete =
            "
            SELECT
                idCategoriesArticles AS id,
                titreCategoriesArticles AS titre
            FROM
                CategoriesArticles
            ORDER BY
                titreCategoriesArticles
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('categoriesArticles', MET_SQLLignesMultiples($prepare->fetchall()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterRetourModele('categoriesArticles', array());
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlAjouterArticle($titre, $categorie, $visibilite, $texte) {
    try {
        $timestamp = time();
        $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
        $dt->setTimestamp($timestamp);

        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idMembres', $_SESSION['id'], PDO::PARAM_INT);
        $prepare->bindValue(':idCategorieArticles', $categorie, PDO::PARAM_INT);
        $prepare->bindValue(':titreArticles', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':texteArticles', $texte, PDO::PARAM_STR);
        $prepare->bindValue(':visibiliteArticles', $visibilite, PDO::PARAM_INT);
        $prepare->bindValue(':dateCreationArticles', $dt->format('Y-m-d'), PDO::PARAM_STR);
        $prepare->bindValue(':dateModificationArticles', NULL, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'L\'article "' . $titre . '" a été ajouté avec succès !');
        MdlAjouterLog(401, 'Ajout de l\'article "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlAjouterCategorieArticle($titre) {
    try {
        $connexion = getConnect();
        $requete =
            "
            INSERT INTO
                CategoriesArticles
            VALUES
                (
                    0,
                    :titreCategoriesArticles
                )
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':titreCategoriesArticles', $titre, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'La catégorie d\'articles "' . $titre . '" a été ajouté avec succès !');
        MdlAjouterLog(406, 'Ajout de la catégorie d\'articles "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlRenommerCategorieArticle($id, $titre) {
    try {
        $connexion = getConnect();
        $requete =
            "
            UPDATE
                CategoriesArticles
            SET
                titreCategoriesArticles=:titreCategoriesArticles
            WHERE
                idCategoriesArticles=:idCategoriesArticles
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idCategoriesArticles', $id, PDO::PARAM_INT);
        $prepare->bindValue(':titreCategoriesArticles', $titre, PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'La catégorie d\'articles a été renommée en "' . $titre . '" avec succès !');
        MdlAjouterLog(407, 'Renommage de la catégorie d\'article en "' . $titre . '" (ID : ' . $id . ').');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlArticlePrecis($id) {
    try {
        $connexion = getConnect();
        $requete =
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
                dateCreationArticles,
                dateModificationArticles
            FROM
                Articles
                    NATURAL JOIN
                Membres
                    NATURAL JOIN
                CategoriesArticles
            WHERE
                idArticles=:idArticles
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idArticles', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('article', MET_SQLLigneUnique($prepare->fetch()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('article', NULL);
    }
}

function MdlModifierArticle($id, $titre, $categorie, $visibilite, $texte) {
    try {
        $timestamp = time();
        $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
        $dt->setTimestamp($timestamp);

        $connexion = getConnect();
        $requete =
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
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':idCategoriesArticles', $categorie, PDO::PARAM_INT);
        $prepare->bindValue(':titreArticles', $titre, PDO::PARAM_STR);
        $prepare->bindValue(':visibiliteArticles', $visibilite, PDO::PARAM_INT);
        $prepare->bindValue(':texteArticles', $texte, PDO::PARAM_STR);
        $prepare->bindValue(':idArticles', $id, PDO::PARAM_INT);
        $prepare->bindValue(':dateModificationArticles', $dt->format('Y-m-d'), PDO::PARAM_STR);
        $prepare->execute();
        $prepare->closeCursor();
        ajouterMessage(201, 'L\'article "' . $titre . '" a été modifié avec succès !');
        MdlAjouterLog(402, 'Modification de l\'article "' . $titre . '".');
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
    }
}

function ajouterImageArticle($rep, $id, $titre, $fileImput) {
    # Enregistrement de l'image.
    $infosFichier = pathinfo($_FILES[$fileImput]['name']);
    $extension = $infosFichier['extension'];
    $newName = 'img-' . preg_replace('/[\W|.]/', '', $titre). '-' . time() . '.' . $extension; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $rep . $newName
    );

    # Enregistrement des données dans la BDD SQL.
    $connexion = getConnect();
    $requete = "INSERT INTO ImagesArticles VALUES (0, :idArticles, :lienImagesArticles)";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idArticles', $id, PDO::PARAM_INT);
    $prepare->bindValue(':lienImagesArticles', $newName, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    MdlAjouterLog(404, 'Ajout d\'une image d\'un article (ID : ' . $id . ').');
}

function MdlImagesArticle($id) {
    try {
        $connexion = getConnect();
        $requete =
            "
            SELECT
                idImagesArticles,
                lienImagesArticles
            FROM
                ImagesArticles
            WHERE
                idArticles=:id
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->bindValue(':id', $id, PDO::PARAM_INT);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('imagesArticle', MET_SQLLignesMultiples($prepare->fetchAll()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterRetourModele('imagesArticle', array());
        ajouterMessage(600, $e->getMessage());
    }
}

function MdlPremiereImageArticle($id) {
    $requete =
        "
        SELECT
            idImagesArticles,
            lienImagesArticles
        FROM
            ImagesArticles
        WHERE
            idArticles=:idArticles
        LIMIT 1
        ";
    $variables = array(
        [':idArticles', $id, 'INT']
    );
    ajouterRetourModele('imagesArticle', requeteSQL($requete, $variables));
}

function supprimerImageArticle($rep, $id, $logguer) {
    # Suppression de l'image
    $connexion = getConnect();
    $requete = "SELECT lienImagesArticles FROM ImagesArticles WHERE idImagesArticles=:idImagesArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idImagesArticles', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    $image = $ligne->lienImagesArticles;
    unlink($rep . $image);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM ImagesArticles WHERE idImagesArticles=:idImagesArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idImagesArticles', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();

    if ($logguer) {
        MdlAjouterLog(405, 'Suppression d\'une image d\'un article (ID : ' . $id . ').');
    }
}

function supprimerArticle($rep, $id) {
    # Suppression des images
    $connexion = getConnect();
    $requete = "SELECT idImagesArticles, lienImagesArticles FROM ImagesArticles WHERE idArticles=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $lignes = $prepare->fetchall();
    $prepare->closeCursor();
    foreach ($lignes as $ligne) {
        supprimerImageArticle($rep, $ligne->idImagesArticles, false);
    }

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM Articles WHERE idArticles=:idArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idArticles', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
    MdlAjouterLog(403, 'Suppression d\'un article (ID : ' . $id . ').');
}

function MdlArticlesTous() {
    try {
        $connexion = getConnect();
        $requete =
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
                (
                    SELECT
                        idArticles,
                        titreArticles,
                        titreCategoriesArticles,
                        visibiliteArticles,
                        texteArticles,
                        prenomMembres,
                        nomMembres,
                        dateCreationArticles,
                        dateModificationArticles
                    FROM
                        Articles
                            NATURAL JOIN
                        Membres
                            NATURAL JOIN
                        CategoriesArticles
                    ORDER BY
                        dateCreationArticles
                        DESC
                ) AS T
            WHERE
                visibiliteArticles<>0
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('articles', MET_SQLLignesMultiples($prepare->fetchall()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('articles', array());
    }
}

########################################################################################################################
# Articles vidéo                                                                                                       #
########################################################################################################################
function ajouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);

    $connexion = getConnect();
    $requete = "INSERT INTO ArticlesYouTube VALUES (0, :idCategorieArticles, :idMembres, :titreArticlesYouTube, :texteArticlesYouTube, :lienArticlesYouTube, :visibiliteArticlesYouTube, :dateCreationArticlesYouTube, :dateModificationArticlesYouTube)";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idMembres', $_SESSION['id'], PDO::PARAM_INT);
    $prepare->bindValue(':idCategorieArticles', $categorie, PDO::PARAM_INT);
    $prepare->bindValue(':titreArticlesYouTube', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':lienArticlesYouTube', $lien, PDO::PARAM_STR);
    $prepare->bindValue(':texteArticlesYouTube', $texte, PDO::PARAM_STR);
    $prepare->bindValue(':visibiliteArticlesYouTube', $visibilite, PDO::PARAM_INT);
    $prepare->bindValue(':dateCreationArticlesYouTube', $dt->format('Y-m-d'), PDO::PARAM_STR);
    $prepare->bindValue(':dateModificationArticlesYouTube', NULL, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    MdlAjouterLog(501, 'Ajout de l\'article vidéo "' . $titre . '".');
}

function articleVideoPrecis($id) {
    $connexion = getConnect();
    $requete = "SELECT idArticlesYouTube, titreArticlesYouTube, idCategoriesArticles, titreCategoriesArticles, visibiliteArticlesYouTube, lienArticlesYouTube, texteArticlesYouTube, prenomMembres, nomMembres, dateCreationArticlesYouTube, dateModificationArticlesYouTube FROM ArticlesYouTube NATURAL JOIN Membres NATURAL JOIN CategoriesArticles WHERE idArticlesYouTube=:idArticlesYouTube";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idArticlesYouTube', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}

function modifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);

    $connexion = getConnect();
    $requete = "UPDATE ArticlesYouTube SET idCategoriesArticles=:idCategoriesArticles, titreArticlesYouTube=:titreArticlesYouTube, visibiliteArticlesYouTube=:visibiliteArticlesYouTube, lienArticlesYouTube=:lienArticlesYouTube, texteArticlesYouTube=:texteArticlesYouTube, dateModificationArticlesYouTube=:dateModificationArticlesYouTube WHERE idArticlesYouTube=:idArticlesYouTube";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idCategoriesArticles', $categorie, PDO::PARAM_INT);
    $prepare->bindValue(':titreArticlesYouTube', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':visibiliteArticlesYouTube', $visibilite, PDO::PARAM_INT);
    $prepare->bindValue(':texteArticlesYouTube', $texte, PDO::PARAM_STR);
    $prepare->bindValue(':lienArticlesYouTube', $lien, PDO::PARAM_STR);
    $prepare->bindValue(':idArticlesYouTube', $id, PDO::PARAM_INT);
    $prepare->bindValue(':dateModificationArticlesYouTube', $dt->format('Y-m-d'), PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    MdlAjouterLog(502, 'Modification de l\'article vidéo "' . $titre . '".');
}

function supprimerArticleVideo($id) {
    $connexion = getConnect();
    $requete = "DELETE FROM ArticlesYouTube WHERE idArticlesYouTube=:idArticlesYouTube";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idArticlesYouTube', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
    MdlAjouterLog(503, 'Suppression d\'un article vidéo (ID : ' . $id . ').');
}

function obtenirInfoYouTube($url) {
    $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";
    $curl = curl_init($youtube);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return json_decode($return);
}

function MdlArticlesVideoTous() {
    try {
        $connexion = getConnect();
        $requete =
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
                (
                    SELECT
                        idArticlesYouTube,
                        titreArticlesYouTube,
                        titreCategoriesArticles,
                        visibiliteArticlesYouTube,
                        lienArticlesYouTube,
                        texteArticlesYouTube,
                        prenomMembres,
                        nomMembres,
                        dateCreationArticlesYouTube,
                        dateModificationArticlesYouTube
                    FROM
                        ArticlesYouTube
                            NATURAL JOIN
                        Membres
                            NATURAL JOIN
                        CategoriesArticles
                    ORDER BY
                        dateCreationArticlesYouTube
                        DESC
                ) AS T
            WHERE
                visibiliteArticlesYouTube<>0
            ";
        $prepare = $connexion->prepare($requete);
        $prepare->execute();
        $prepare->setFetchMode(PDO::FETCH_OBJ);
        ajouterRetourModele('articlesVideo', MET_SQLLignesMultiples($prepare->fetchall()));
        $prepare->closeCursor();
    } catch (Exception $e) {
        ajouterMessage(600, $e->getMessage());
        ajouterRetourModele('articlesVideo', array());
    }
}