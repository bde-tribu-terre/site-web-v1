<?php
require_once('./global/connect.php');
require_once('./mvcadmin/modele/modele.php');
require_once('./mvcadmin/vue/vue.php');

########################################################################################################################
# Gabarit Connexion                                                                                                    #
########################################################################################################################
function CtlConnexion($messageRetour) {
    afficherConnexion($messageRetour);
}

function CtlVerifConnexion($login, $mdp) {
    if (!empty($login) && !empty($mdp)) {
        $id = verifConnexion($login, $mdp);
        if ($id != false) {
            $_SESSION['id'] = $id;
            CtlMenu('');
        } else {
            throw new Exception("Erreur : Login ou mot de passe invalide.");
        }
    } else {
        throw new Exception("Erreur : Veuillez remplir tous les champs.");
    }
}

function CtlConnexionErreur($messageErreur) {
    afficherConnexion($messageErreur);
}

########################################################################################################################
# Gabarit Menu                                                                                                         #
########################################################################################################################
function CtlAjouterGoodieMenu($messageRetour) {
    afficherAjouterGoodie($messageRetour);
}

function CtlAjouterImageGoodieMenu($messageRetour) {
    afficherAjouterImageGoodie($messageRetour);
}

function CtlAjouterJournalMenu($messageRetour) {
    afficherAjouterJournal($messageRetour);
}

function CtlMenu($messageRetour) {
    afficherMenu($messageRetour);
}

function CtlParametresCompte($messageRetour) {
    afficherParametresCompte($messageRetour);
}

function CtlDeconnexion($messageRetour) {
    $_SESSION = array();
    if (isset($COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    CtlConnexion('');
}

function CtlMenuErreur($messageErreur) {
    afficherMenu($messageErreur);
}

########################################################################################################################
# Gabarit AjouterGoodie                                                                                                #
########################################################################################################################
function CtlAjouterGoodie($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    if (
        !empty($titre) &&
        !empty($categorie) &&
        (!empty($prixADEuro) || $prixADEuro == 0) &&
        (!empty($prixADCentimes) || $prixADCentimes == 0) &&
        (!empty($prixNADEuro) || $prixNADEuro == 0) &&
        (!empty($prixNADCentimes) || $prixNADCentimes == 0) &&
        !empty($desc)
    ) {
        try {
            ajouterGoodie($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput);
            afficherAjouterGoodie('Le goodie "' . $titre . '" a été ajouté avec succès !');
        } catch (Exception $e) {
            afficherAjouterGoodie($e);
        }
    } else {
        throw new Exception("Erreur : Veuillez remplir tous les champs.");
    }
}

########################################################################################################################
# Gabarit AjouterImageGoodie                                                                                           #
########################################################################################################################
function CtlAjouterImageGoodie($id, $fileImput) {
    if (!empty($id)) {
        try {
            $titre = titreGoodie($id)->titreGoodies;
            ajouterImageGoodie($id, $titre, $fileImput);
            afficherAjouterGoodie('L\'image a été ajoutée au goodie ' . $titre . ' avec succès !');
        } catch (Exception $e) {
            afficherAjouterGoodie($e);
        }
    } else {
        throw new Exception("Erreur : Veuillez remplir tous les champs.");
    }
}

########################################################################################################################
# Gabarit AjouterJournal                                                                                               #
########################################################################################################################
function CtlAjouterJournal($titre, $mois, $annee, $fileImput) {
    if (!empty($titre) && !empty($mois) && !empty($annee) && !empty($fileImput)) {
        try {
            ajouterJournal($titre, $mois, $annee, $fileImput);
            afficherAjouterJournal('Le journal "' . $titre . '" a été ajouté avec succès !');
        } catch (Exception $e) {
            afficherAjouterJournal($e);
        }
    } else {
        throw new Exception("Erreur : Veuillez remplir tous les champs.");
    }
}
