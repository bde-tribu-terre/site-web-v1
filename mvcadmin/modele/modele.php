<?php
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

function creerEvent($titre, $date, $heure, $minute, $lieu, $desc) {
    $connexion = getConnect();
    $requete = "INSERT INTO Events VALUES (0, :titreEvents, :descEvents, :dateEvents, :heureEvents, :lieuEvents)"; // (0 pour le auto increment)
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':titreEvents', $titre, PDO::PARAM_STR);
    $prepare->bindValue(':descEvents', $desc, PDO::PARAM_STR);
    $prepare->bindValue(':dateEvents', $date, PDO::PARAM_STR);
    $prepare->bindValue(':heureEvents', $heure . ':' . $minute . ':00', PDO::PARAM_STR);
    $prepare->bindValue(':lieuEvents', $lieu, PDO::PARAM_STR);
    $prepare->execute();
    $prepare->closeCursor();
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

function infoEvent($id) {
    $connexion = getConnect();
    $requete = "SELECT idEvents, titreEvents, descEvents, dateEvents, heureEvents, lieuEvents FROM Events WHERE idEvents=:idEvents";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
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
}

function supprimerEvent($id) {
    $connexion = getConnect();
    $requete = "DELETE FROM Events WHERE idEvents=:idEvents";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idEvents', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
}

function ajouterJournal($titre, $mois, $annee, $fileImput) {
    # Enregistrement du fichier PDF.
    $journauxRep = '../ressources/journaux/';
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
    unlink('../ressources/journaux/' . $pdf);

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
    $miniatureRep = '../ressources/goodies/';
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

function infoGoodie($id) {
    $connexion = getConnect();
    $requete = "SELECT idGoodies, titreGoodies, prixADGoodies, prixNADGoodies, descGoodies FROM Goodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $prepare->fetch();
    $prepare->closeCursor();
    return $ligne;
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
}

function ajouterImageGoodie($id, $titre, $fileImput) {
    # Enregistrement de l'image.
    $imageRep = '../ressources/goodies/';
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

function supprimerImageGoodie($id) {
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
    unlink('../ressources/goodies/' . $image);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM ImagesGoodies WHERE idImagesGoodies=:idImagesGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idImagesGoodies', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
}

function supprimerGoodie($id) {
    # Suppression des images
    $connexion = getConnect();
    $requete = "SELECT idImagesGoodies, lienImagesGoodies FROM ImagesGoodies WHERE idGoodies=:id";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
    $lignes = $prepare->fetchall();
    $prepare->closeCursor();
    foreach ($lignes as $ligne) {
        supprimerImageGoodie($ligne->idImagesGoodies);
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
    unlink('../ressources/goodies/' . $miniature);

    # Suppression des données
    $connexion = getConnect();
    $requete = "DELETE FROM Goodies WHERE idGoodies=:idGoodies";
    $prepare = $connexion->prepare($requete);
    $prepare->bindValue(':idGoodies', $id, PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
}