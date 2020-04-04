<?php
########################################################################################################################
# Évents                                                                                                               #
########################################################################################################################
function eventsFuturs($ajd) {
    $connexion = getConnect();
    $requete = "SELECT idEvents, titreEvents, dateEvents, heureEvents, lieuEvents FROM Events WHERE dateEvents>=:ajd ORDER BY dateEvents LIMIT 3";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':ajd', $ajd, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function eventsTous() {
    $connexion = getConnect();
    $requete = "SELECT idEvents, titreEvents, descEvents, dateEvents, heureEvents, lieuEvents FROM Events ORDER BY dateEvents DESC";
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
    $requete = "SELECT lienImagesGoodies FROM ImagesGoodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function journauxTous() {
    $connexion = getConnect();
    $requete = "SELECT idJournaux, titreJournaux, dateJournaux, pdfJournaux FROM Journaux ORDER BY dateJournaux DESC";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function derniersJournaux() {
    $connexion = getConnect();
    $requete = "SELECT idJournaux, titreJournaux, dateJournaux, pdfJournaux FROM Journaux ORDER BY dateJournaux DESC LIMIT 2";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}