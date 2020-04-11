<?php
########################################################################################################################
# Système                                                                                                              #
########################################################################################################################
function verifConnexion($login, $mdp) {
    $connexion = getConnect();
    $requete = "SELECT idMembre, loginMembre, mdpMembre FROM Membre WHERE loginMembre=:login";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':login', $login, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $return = false;
    if ($ligne) {
        if ($ligne->mdpMembre == $mdp) {
            $return = $ligne->idMembre;
        }
    }
    $prepare->closeCursor();
    return $return;
}

function infosMembre($id) {
    $connexion = getConnect();
    $requete = "SELECT idMembre, loginMembre, nomMembre, descMembre FROM Membre WHERE idMembre=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}

function logTous() {
    $connexion = getConnect();
    $requete = "SELECT idMembre, nomMembre, codeLogActions, dateLogActions, descLogActions FROM LogActions NATURAL JOIN Membre ORDER BY dateLogActions DESC";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function ajouterLog($code, $message) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);

    $connexion = getConnect();
    $requete = "INSERT INTO LogActions VALUES (0, :idMembre, :codeLogActions, :dateLogActions, :descLogActions)";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idMembre', $_SESSION['id'], PDO::PARAM_STR);
    $prepare->bindValue(':codeLogActions', $code, PDO::PARAM_INT);
    $prepare->bindValue(':dateLogActions', $dt->format('Y-m-d H-i-s'), PDO::PARAM_STR);
    $prepare->bindValue(':descLogActions', $message, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
}

########################################################################################################################
# Évents                                                                                                               #
########################################################################################################################
function eventsTous($tri, $aVenir, $passes, $maxi) {
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
        case -1:
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
    $requete = "SELECT idEvents, titreEvents, descEvents, dateEvents, heureEvents, lieuEvents FROM Events" . $where . $triSQL . $maxiSQL;
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function eventPrecis($id) {
    $connexion = getConnect();
    $requete = "SELECT idEvents, titreEvents, descEvents, dateEvents, heureEvents, lieuEvents FROM Events WHERE idEvents=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}

function creerEvent($titre, $date, $heure, $minute, $lieu, $desc) {
    $connexion = getConnect();
    $requete = "INSERT INTO Events VALUES (0, :titreEvents, :descEvents, :dateEvents, :heureEvents, :lieuEvents)";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':titreEvents', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':descEvents', $desc, PDO::PARAM_STR);
    $prepare->bindValue(':dateEvents', $date, PDO::PARAM_STR);
    $prepare->bindValue(':heureEvents', $heure . ':' . $minute . ':00', PDO::PARAM_STR);
    $prepare->bindValue(':lieuEvents', $lieu, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(101, 'Ajout de l\'évent "' . $titre . '".');
}

function idTitreEvents() {
    $connexion = getConnect();
    $requete = "SELECT idEvents, titreEvents, dateEvents FROM Events ORDER BY dateEvents DESC";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function modifierEvent($id, $titre, $desc, $date, $heure, $minute, $lieu) {
    $connexion = getConnect();
    $requete = "UPDATE Events SET titreEvents=:titreEvents, descEvents=:descEvents, dateEvents=:dateEvents, heureEvents=:heureEvents, lieuEvents=:lieuEvents WHERE idEvents=:idEvents";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
    $prepare->bindValue(':titreEvents', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':descEvents', $desc, PDO::PARAM_STR);
    $prepare->bindValue(':dateEvents', $date, PDO::PARAM_STR);
    $prepare->bindValue(':heureEvents', $heure . ':' . $minute . ':00', PDO::PARAM_STR);
    $prepare->bindValue(':lieuEvents', $lieu, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(102, 'Modification de l\'évent "' . $titre . '".');
}

function supprimerEvent($id) {
    $connexion = getConnect();
    $requete = "DELETE FROM Events WHERE idEvents=:idEvents";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(103, 'Suppression d\'un évent (ID : ' . $id . ').');
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function goodiesTous($tri, $disponible, $bientot, $rupture) {
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
    $requete = "SELECT idGoodies, titreGoodies, prixADGoodies, prixNADGoodies, descGoodies, categorieGoodies, miniatureGoodies FROM Goodies" . $where . $triSQL;
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function goodiePrecis($id) {
    $connexion = getConnect();
    $requete = "SELECT idGoodies, titreGoodies, prixADGoodies, prixNADGoodies, descGoodies, categorieGoodies, miniatureGoodies FROM Goodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}

function imagesGoodie($id) {
    $connexion = getConnect();
    $requete = "SELECT idImagesGoodies, lienImagesGoodies FROM ImagesGoodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function ajouterGoodie($rep, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    # Enregistrement de la miniature.
    $infosFichier = pathinfo($_FILES[$fileImput]['name']);
    $extension = $infosFichier['extension'];
    $newName = 'img-m-' . preg_replace('/[\W|.]/', '', $titre). '-' . time() . '.' . $extension; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $rep . $newName
    );

    # Enregistrement des données dans la BDD SQL.
    $connexion = getConnect();
    $requete = "INSERT INTO Goodies VALUES (0, :titreGoodies, :prixADGoodies, :prixNADGoodies, :descGoodies, :categorieGoodies, :miniatureGoodies)"; // (0 pour le auto increment)
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':titreGoodies', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':prixADGoodies', $prixADEuro + ($prixADCentimes / 100), PDO::PARAM_STR);
    $prepare->bindValue(':prixNADGoodies', $prixNADEuro + ($prixNADCentimes / 100), PDO::PARAM_STR);
    $prepare->bindValue(':descGoodies', $desc, PDO::PARAM_STR);
    $prepare->bindValue(':categorieGoodies', $categorie, PDO::PARAM_INT);
    $prepare->bindValue(':miniatureGoodies', $newName, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(201, 'Ajout du goodie "' . $titre . '".');
}

function idTitreGoodies() {
    $connexion = getConnect();
    $requete = "SELECT idGoodies, titreGoodies, categorieGoodies FROM Goodies";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function ajouterImageGoodie($rep, $id, $titre, $fileImput) {
    # Enregistrement de la miniature.
    $infosFichier = pathinfo($_FILES[$fileImput]['name']);
    $extension = $infosFichier['extension'];
    $newName = 'img-i-' . preg_replace('/[\W|.]/', '', $titre). '-' . time() . '.' . $extension; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $rep . $newName
    );

    # Enregistrement des données dans la BDD SQL.
    $connexion = getConnect();
    $requete = "INSERT INTO ImagesGoodies VALUES (0, :idGoodies, :lienImagesgoodies)"; // (0 pour le auto increment)
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
    $prepare->bindValue(':lienImagesgoodies', $newName, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(204, 'Ajout d\'une image d\'un goodie (ID : ' . $id . ').');
}

function modifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    $connexion = getConnect();
    $requete = "UPDATE Goodies SET titreGoodies=:titreGoodies, prixADGoodies=:prixADGoodies, prixNADGoodies=:prixNADGoodies, descGoodies=:descGoodies, categorieGoodies=:categorieGoodies WHERE idGoodies=:idGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
    $prepare->bindValue(':titreGoodies', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':prixADGoodies', $prixADEuro + ($prixADCentimes / 100), PDO::PARAM_STR);
    $prepare->bindValue(':prixNADGoodies', $prixNADEuro + ($prixNADCentimes / 100), PDO::PARAM_STR);
    $prepare->bindValue(':descGoodies', $desc, PDO::PARAM_STR);
    $prepare->bindValue(':categorieGoodies', $categorie, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(202, 'Modification du goodie "' . $titre . '".');
}

function supprimerImageGoodie($rep, $id, $logguer) {
    # Suppression de l'image
    $connexion = getConnect();
    $requete = "SELECT lienImagesGoodies FROM ImagesGoodies WHERE idImagesGoodies=:idImagesGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idImagesGoodies', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    $image = $ligne->lienImagesGoodies;
    unlink($rep . $image);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM ImagesGoodies WHERE idImagesGoodies=:idImagesGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idImagesGoodies', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();

    if ($logguer) {
        ajouterLog(205, 'Suppression d\'une image d\'un goodie (ID : ' . $id . ').');
    }
}

function supprimerGoodie($rep, $id) {
    # Suppression des -images
    $connexion = getConnect();
    $requete = "SELECT idImagesGoodies, lienImagesGoodies FROM ImagesGoodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $lignes = $prepare->fetchall();
    $prepare->closeCursor();
    foreach ($lignes as $ligne) {
        supprimerImageGoodie($rep, $ligne->idImagesGoodies, false);
    }

    # Suppression du goodie
    $connexion = getConnect();
    $requete = "SELECT miniatureGoodies FROM Goodies WHERE idGoodies=:idGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    $miniature = $ligne->miniatureGoodies;
    unlink($rep . $miniature);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM Goodies WHERE idGoodies=:idGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(203, 'Suppression d\'un goodie (ID : ' . $id . ').');
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function journauxTous($maxi) {
    switch ($maxi) {
        case -1:
            $maxiSQL = '';
            break;
        default:
            $maxiSQL = ' LIMIT ' . $maxi;
            break;
    }
    $connexion = getConnect();
    $requete = "SELECT idJournaux, titreJournaux, dateJournaux, pdfJournaux FROM Journaux ORDER BY dateJournaux DESC" . $maxiSQL;
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function ajouterJournal($rep, $titre, $mois, $annee, $fileImput) {
    # Enregistrement du fichier PDF.
    $newName = preg_replace('/[\W]/', '', $titre). '-' . time() . '.pdf'; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $rep . $newName
    );

    # Enregistrement des données dans la BDD SQL.
    $connexion = getConnect();
    $requete = "INSERT INTO Journaux VALUES (0, :titreJournaux, :dateJournaux, :pdfJournaux)"; // (0 pour le auto increment)
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':titreJournaux', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':dateJournaux', $annee . '-' . $mois . '-' . '01', PDO::PARAM_STR);
    $prepare->bindValue(':pdfJournaux', $newName, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(301, 'Ajout du journal "' . $titre . '".');
}

function idTitreJournaux() {
    $connexion = getConnect();
    $requete = "SELECT idJournaux, titreJournaux FROM Journaux ORDER BY dateJournaux";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function supprimerJournal($rep, $id) {
    # Suppression du journal
    $connexion = getConnect();
    $requete = "SELECT pdfJournaux FROM Journaux WHERE idJournaux=:idJournaux";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idJournaux', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    $pdf = $ligne->pdfJournaux;
    unlink($rep . $pdf);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM Journaux WHERE idJournaux=:idJournaux";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idJournaux', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(302, 'Suppression d\'un journal (ID : ' . $id . ').');
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function idTitreCategoriesArticles() {
    $connexion = getConnect();
    $requete = "SELECT idCategoriesArticles, titreCategoriesArticles FROM CategoriesArticles ORDER BY titreCategoriesArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function ajouterArticle($titre, $categorie, $visibilite, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);

    $connexion = getConnect();
    $requete = "INSERT INTO Articles VALUES (0, :idMembre, :idCategorieArticles, :titreArticles, :texteArticles, :visibiliteArticles, :dateCreationArticles, :dateModificationArticles)";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idMembre', $_SESSION['id'], PDO::PARAM_INT);
    $prepare->bindValue(':idCategorieArticles', $categorie, PDO::PARAM_INT);
    $prepare->bindValue(':titreArticles', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':texteArticles', $texte, PDO::PARAM_STR);
    $prepare->bindValue(':visibiliteArticles', $visibilite, PDO::PARAM_INT);
    $prepare->bindValue(':dateCreationArticles', $dt->format('Y-m-d'), PDO::PARAM_STR);
    $prepare->bindValue(':dateModificationArticles', NULL, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(401, 'Ajout de l\'article "' . $titre . '".');
}

function ajouterCategorieArticle($titre) {
    $connexion = getConnect();
    $requete = "INSERT INTO CategoriesArticles VALUES (0, :titreCategoriesArticles)";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':titreCategoriesArticles', $titre, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(406, 'Ajout de la catégorie d\'articles "' . $titre . '".');
}

function renommerCategorieArticle($id, $titre) {
    $connexion = getConnect();
    $requete = "UPDATE CategoriesArticles SET titreCategoriesArticles=:titreCategoriesArticles WHERE idCategoriesArticles=:idCategoriesArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idCategoriesArticles', $id, PDO::PARAM_INT);
    $prepare->bindValue(':titreCategoriesArticles', $titre, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(407, 'Renommage de la catégorie d\'article en "' . $titre . '" (ID : ' . $id .  ').');
}

function idTitreArticles() {
    $connexion = getConnect();
    $requete = "SELECT idArticles, titreArticles, dateCreationArticles, titreCategoriesArticles FROM Articles NATURAL JOIN CategoriesArticles ORDER BY dateCreationArticles DESC";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function articlePrecis($id) {
    $connexion = getConnect();
    $requete = "SELECT idArticles, titreArticles, idCategoriesArticles, titreCategoriesArticles, visibiliteArticles, texteArticles, nomMembre, dateCreationArticles, dateModificationArticles FROM Articles NATURAL JOIN Membre NATURAL JOIN CategoriesArticles WHERE idArticles=:idArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idArticles', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}

function modifierArticle($id, $titre, $categorie, $visibilite, $texte) {
    $timestamp = time();
    $dt = (new DateTime('now', new DateTimeZone('Europe/Paris')));
    $dt->setTimestamp($timestamp);

    $connexion = getConnect();
    $requete = "UPDATE Articles SET idCategoriesArticles=:idCategoriesArticles, titreArticles=:titreArticles, visibiliteArticles=:visibiliteArticles, texteArticles=:texteArticles, dateModificationArticles=:dateModificationArticles WHERE idArticles=:idArticles";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idCategoriesArticles', $categorie, PDO::PARAM_INT);
    $prepare->bindValue(':titreArticles', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':visibiliteArticles', $visibilite, PDO::PARAM_INT);
    $prepare->bindValue(':texteArticles', $texte, PDO::PARAM_STR);
    $prepare->bindValue(':idArticles', $id, PDO::PARAM_INT);
    $prepare->bindValue(':dateModificationArticles', $dt->format('Y-m-d'), PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
    ajouterLog(402, 'Modification de l\'article "' . $titre . '".');
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
    ajouterLog(404, 'Ajout d\'une image d\'un article (ID : ' . $id . ').');
}

function imagesArticle($id) {
    $connexion = getConnect();
    $requete = "SELECT idImagesArticles, lienImagesArticles FROM ImagesArticles WHERE idArticles=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
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
        ajouterLog(405, 'Suppression d\'une image d\'un article (ID : ' . $id . ').');
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
    ajouterLog(403, 'Suppression d\'un article (ID : ' . $id . ').');
}

function articlesTous() {
    $connexion = getConnect();
    $requete = "SELECT idArticles, titreArticles, titreCategoriesArticles, visibiliteArticles, texteArticles, nomMembre, dateCreationArticles, dateModificationArticles FROM Articles NATURAL JOIN Membre NATURAL JOIN CategoriesArticles ORDER BY dateCreationArticles DESC";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}