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
    $journauxRep = './ressources/journaux/';
    $newName = preg_replace('/[\W]/', '', $titre). '-' . time() . '.pdf'; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $journauxRep . $newName
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

function idTitreJournaux() {
    $connexion = getConnect();
    $requete = "SELECT idJournaux, titreJournaux FROM Journaux";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function supprimerJournal($id) {
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
    unlink('./ressources/journaux/' . $pdf);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM Journaux WHERE idJournaux=:idJournaux";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idJournaux', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
}

function ajouterGoodie($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    # Enregistrement de la miniature.
    $miniatureRep = './ressources/goodies/';
    $newName = 'm-' . preg_replace('/[\W]/', '', $titre). '-' . time() . '.png'; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $miniatureRep . $newName
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
}

function idTitreGoodies() {
    $connexion = getConnect();
    $requete = "SELECT idGoodies, titreGoodies FROM Goodies";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetchall();
    $prepare->closeCursor();
    return $ligne;
}

function titreGoodie($id) {
    $connexion = getConnect();
    $requete = "SELECT idGoodies, titreGoodies FROM Goodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
}

function ajouterImageGoodie($id, $titre, $fileImput) {
    # Enregistrement de l'image.
    $imageRep = './ressources/goodies/';
    $newName = 'i-' . preg_replace('/[\W]/', '', $titre). '-' . time() . '.png'; # time() => aucun doublon imaginable.
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $imageRep . $newName
    );

    # Enregistrement des données dans la BDD SQL.
    $connexion = getConnect();
    $requete = "INSERT INTO ImagesGoodies VALUES (0, :idGoodies, :lienImagesgoodies)"; // (0 pour le auto increment)
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
    $prepare->bindValue(':lienImagesgoodies', $newName, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
}