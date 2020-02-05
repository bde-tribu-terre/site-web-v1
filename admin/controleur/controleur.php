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
    if ($login == 'login' && $mdp == 'mdp') {
        CtlMenu('');
    } else {
        CtlConnexionErreur('Erreur : Mot de passe invalide.');
    }
    /*
    if (!empty($login) && !empty($mdp)) {
        $categorie = checkUser($login, $mdp);
        if ($categorie != false) {
            switch ($categorie) {
                case 'Médecin':
                    CtlMedecin('');
                    break;
                case 'Agent':
                    CtlAgent('');
                    break;
                case 'Directeur':
                    CtlDirecteur('');
                    break;
            }
        } else {
            throw new Exception("<p>Connexion :<br><b>Login ou mot de passe invalide.</b></p>");
        }
    } else {
        throw new Exception("<p>Connexion :<br><b>Veuillez remplir tous les champs.</b></p>");
    }
    */
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