<?php
########################################################################################################################
# Évents                                                                                                               #
########################################################################################################################
function eventsFuturs($ajd) {
    $connexion = getConnect();
    $requete = "SELECT idEvents, titreEvents, dateEvents, heureEvents, lieuEvents FROM Events WHERE dateEvents>=:ajd ORDER BY dateEvents LIMIT 2";
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
function goodiesTous() {
    $connexion = getConnect();
    $requete = "SELECT idGoodies, titreGoodies, prixADGoodies, prixNADGoodies, descGoodies, categorieGoodies, miniatureGoodies FROM Goodies";
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