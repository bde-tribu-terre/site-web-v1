<?php
require_once('./modele/connect.php');
require_once('./modele/modele.php');
require_once('./vue/vue.php');

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
function CtlMenu($messageRetour) {
    afficherMenu($messageRetour);
}

function CtlMenuErreur($messageErreur) {
    afficherMenu($messageErreur);
}

########################################################################################################################
# Gabarit Paramètres Compte                                                                                            #
########################################################################################################################
function CtlParametresCompte($messageRetour) {
    afficherParametresCompte($messageRetour);
}