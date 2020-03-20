<?php
require_once($prefixe . 'global/connect.php');
require_once($prefixe . 'mvcpublic/modele/modele.php');
require_once($prefixe . 'mvcpublic/vue/vue.php');

########################################################################################################################
# Gabarit Accueil                                                                                                      #
########################################################################################################################
function CtlAccueil($prefixe) {
    afficherAccueil($prefixe);
}

########################################################################################################################
# Gabarit Erreur                                                                                                       #
########################################################################################################################
function CtlErreur($prefixe, $messageErreur) {
    afficherErreur($prefixe, $messageErreur);
}

########################################################################################################################
# Gabarit Events                                                                                                       #
########################################################################################################################
function CtlEvents($prefixe) {
    afficherEvents($prefixe);
}

function CtlEventPrecis($prefixe, $id) {
    if (eventPrecis($id) != false) {
        afficherEventPrecis($prefixe, $event);
    } else {
        throw new Exception("L'évent recherché n'existe pas.");
    }
}

########################################################################################################################
# Gabarit Goodies                                                                                                      #
########################################################################################################################
function CtlGoodies($prefixe) {
    afficherGoodies($prefixe);
}

function CtlGoodiePrecis($prefixe, $id) {
    if (file_exists($prefixe . 'ressources/goodies/' . $id)) {
        afficherGoodiePrecis($prefixe, $id);
    } else {
        throw new Exception("Le goodie recherché n'existe pas.");
    }
}

########################################################################################################################
# Gabarit Journaux                                                                                                     #
########################################################################################################################
function CtlJournaux($prefixe) {
    afficherJournaux($prefixe);
}

########################################################################################################################
# Gabarit Nous Contacter                                                                                               #
########################################################################################################################
function CtlNousContacter($prefixe) {
    afficherNousContacter($prefixe);
}

########################################################################################################################
# Gabarit Qui sommes-nous ?                                                                                            #
########################################################################################################################
function CtlQuiSommesNous($prefixe) {
    afficherQuiSommesNous($prefixe);
}

########################################################################################################################
# Gabarit Statuts                                                                                                      #
########################################################################################################################
function CtlStatuts($prefixe) {
    afficherStatuts($prefixe);
}