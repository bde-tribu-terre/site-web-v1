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
    $journauxRep = '../ressources/journaux/';
    $nextUpload = file($journauxRep . 'nextUpload.txt')[0];
    $newName = 'file_' . preg_replace('/[\W]/', '', $titre) . '.pdf';
    mkdir($journauxRep . $nextUpload);
    move_uploaded_file(
        $_FILES[$fileImput]['tmp_name'],
        $journauxRep . $nextUpload . '/' . $newName
    );
    $descFile = fopen($journauxRep . $nextUpload . '/desc.txt', 'w');
    fwrite($descFile, $newName . "\n");
    fwrite($descFile, $annee . '-' . $mois . "\n");
    fwrite($descFile, $titre);
    fclose($descFile);
    $nextUploadFile = fopen($journauxRep . 'nextUpload.txt', 'w');
    fwrite($nextUploadFile, strval(intval($nextUpload) + 1));
    fclose($nextUploadFile);
}