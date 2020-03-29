<?php
function getConnect() {
    $connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

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

function ajouterJournal($titre, $mois, $annee, $fileImput) {
    # Enregistrement du fichier PDF.
    $journauxRep = '../ressources/journaux/';
    $newName = preg_replace('/[\W]/', '', $titre) . time() . '.pdf'; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $journauxRep . '/' .  $newName
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
}