<?php
function getConnect() {
    $connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

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
    $requete = "SELECT idEvents, titreEvents, descEvents, dateEvents, heureEvents, lieuEvents FROM Events WHERE idEvents<=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}