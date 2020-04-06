<?php
require_once($prefixe . '-mvc/modele/connect.php');
require_once($prefixe . '-mvc/modele/modele.php');
require_once($prefixe . '-mvc/vue/vue.php');
########################################################################################################################
# Erreur (public, tous les C. Frontaux)                                                                                #
########################################################################################################################
function CtlErreur($prefixe, $messageErreur) {
    afficherErreur($prefixe, $messageErreur);
}

########################################################################################################################
# Admin                                                                                                                #
########################################################################################################################
# Connexion
function CtlConnexion($prefixe, $messageRetour) {
    afficherConnexion($prefixe, $messageRetour);
}

function CtlVerifConnexion($prefixe, $login, $mdp) {
    try {
        if (!empty($login) && !empty($mdp)) {
            $id = verifConnexion($login, $mdp);
            if ($id != false) {
                $_SESSION['id'] = $id;
                CtlMenu($prefixe, '');
            } else {
                throw new Exception("Erreur : Login ou mot de passe invalide.");
            }
        } else {
            throw new Exception("Erreur : Veuillez remplir tous les champs.");
        }
    } catch (Exception $e) {
        afficherConnexion($prefixe, $e->getMessage());
    }
}

function CtlConnexionErreur($prefixe, $messageErreur) {
    afficherConnexion($prefixe, $messageErreur);
}

# Menu
function CtlCreerEventMenu($prefixe, $messageRetour) {
    afficherCreerEvent($prefixe, $messageRetour);
}

function CtlChoixEventMenu($prefixe, $messageRetour) {
    afficherChoixEvent($prefixe, $messageRetour);
}

function CtlSupprimerEventMenu($prefixe, $messageRetour) {
    afficherSupprimerEvent($prefixe, $messageRetour);
}

function CtlAjouterGoodieMenu($prefixe, $messageRetour) {
    afficherAjouterGoodie($prefixe, $messageRetour);
}

function CtlAjouterImageGoodieMenu($prefixe, $messageRetour) {
    afficherAjouterImageGoodie($prefixe, $messageRetour);
}

function CtlChoixGoodieMenu($prefixe, $messageRetour) {
    afficherChoixGoodie($prefixe, $messageRetour);
}

function CtlSupprimerGoodieMenu($prefixe, $messageRetour) {
    afficherSupprimerGoodie($prefixe, $messageRetour);
}

function CtlAjouterJournalMenu($prefixe, $messageRetour) {
    afficherAjouterJournal($prefixe, $messageRetour);
}

function CtlSupprimerJournalMenu($prefixe, $messageRetour) {
    afficherSupprimerJournal($prefixe, $messageRetour);
}

function CtlMenu($prefixe, $messageRetour) {
    afficherMenu($prefixe, $messageRetour);
}

function CtlDeconnexion($prefixe, $messageRetour) {
    $_SESSION = array();
    if (isset($COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    CtlConnexion($prefixe, $messageRetour);
}

function CtlMenuErreur($prefixe, $messageErreur) {
    afficherMenu($prefixe, $messageErreur);
}

# Events
function CtlCreerEvent($prefixe, $titre, $date, $heure, $minute, $lieu, $desc) {
    try {
        if (
            !empty($titre) &&
            !empty($date) &&
            (!empty($heure) || $heure == 0) &&
            (!empty($minute) || $minute == 0) &&
            !empty($desc)
        ) {
            creerEvent($titre, $date, $heure, $minute, $lieu, $desc);
            afficherCreerEvent($prefixe, 'L\'évent "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherCreerEvent($prefixe, $e->getMessage());
    }
}

function CtlChoixEvent($prefixe, $id) {
    try {
        if (!empty($id)) {
            afficherModifierEvent($prefixe, '', $id);
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un évent.');
        }
    } catch (Exception $e) {
        afficherChoixEvent($prefixe, $e->getMessage());
    }
}

function CtlModifierEvent($prefixe, $id, $titre, $date, $heure, $minute, $lieu, $desc) {
    try {
        if (
            !empty($titre) &&
            !empty($date) &&
            (!empty($heure) || $heure == 0) &&
            (!empty($minute) || $minute == 0) &&
            !empty($desc)
        ) {
            modifierEvent($id, $titre, $desc, $date, $heure, $minute, $lieu);
            afficherModifierEvent($prefixe, 'L\'évent "' . $titre . '" a été modifié avec succès !', $id);
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherModifierEvent($prefixe, $e->getMessage(), $id);
    }
}

function CtlSupprimerEvent($prefixe, $id) {
    try {
        if (!empty($id)) {
            supprimerEvent($id);
            afficherSupprimerEvent($prefixe, 'L\'évent a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un évent.');
        }
    } catch (Exception $e) {
        afficherSupprimerEvent($prefixe, $e->getMessage());
    }
}

# Goodies
function CtlAjouterGoodie($prefixe, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    try {
        if (
            !empty($titre) &&
            (!empty($categorie) || $categorie == 0) && $categorie != '-1' &&
            (!empty($prixADEuro) || $prixADEuro == 0) &&
            (!empty($prixADCentimes) || $prixADCentimes == 0) &&
            (!empty($prixNADEuro) || $prixNADEuro == 0) &&
            (!empty($prixNADCentimes) || $prixNADCentimes == 0) &&
            !empty($desc) &&
            !empty($_FILES[$fileImput]['name'])
        ) {
            ajouterGoodie($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput);
            afficherAjouterGoodie($prefixe, 'Le goodie "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner une miniature.');
        }
    } catch (Exception $e) {
        afficherAjouterGoodie($prefixe, $e->getMessage());
    }
}

function CtlAjouterImageGoodie($prefixe, $id, $fileImput) {
    try {
        if (!empty($id) && !empty($_FILES[$fileImput]['name'])) {
            $titre = goodiePrecis($id)->titreGoodies;
            ajouterImageGoodie($id, $titre, $fileImput);
            afficherAjouterImageGoodie($prefixe, 'L\'image a été ajoutée au goodie ' . $titre . ' avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner une image.');
        }
    } catch (Exception $e) {
        afficherAjouterImageGoodie($prefixe, $e->getMessage());
    }
}

function CtlChoixGoodie($prefixe, $id) {
    try {
        if (!empty($id)) {
            afficherModifierGoodie($prefixe, '', $id);
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un goodie.');
        }
    } catch (Exception $e) {
        afficherChoixGoodie($prefixe, $e->getMessage());
    }
}

function CtlModifierGoodie($prefixe, $id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    try {
        if (
            !empty($titre) &&
            (!empty($categorie) || $categorie == 0) &&
            (!empty($prixADEuro) || $prixADEuro == 0) &&
            (!empty($prixADCentimes) || $prixADCentimes == 0) &&
            (!empty($prixNADEuro) || $prixNADEuro == 0) &&
            (!empty($prixNADCentimes) || $prixNADCentimes == 0) &&
            !empty($desc)
        ) {
            modifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc);
            afficherModifierGoodie($prefixe, 'Le goodie "' . $titre . '" a été modifié avec succès !', $id);
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherModifierGoodie($prefixe, $e->getMessage(), $id);
    }
}

function CtlAllerSupprimerImageGoodie($prefixe, $id) {
    try {
        if (!empty($id)) {
            afficherSupprimerImageGoodie($prefixe, '', $id);
        } else {
            throw new Exception('Erreur : Identifiant invalide.');
        }
    } catch (Exception $e) {
        afficherModifierGoodie($prefixe, $e->getMessage(), $id);
    }
}

function CtlSupprimerGoodie($prefixe, $id) {
    try {
        if (!empty($id)) {
            supprimerGoodie($id);
            afficherSupprimerGoodie($prefixe, 'Le goodie a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un goodie.');
        }
    } catch (Exception $e) {
        afficherSupprimerGoodie($prefixe, $e->getMessage());
    }
}

# Journaux
function CtlAjouterJournal($prefixe, $titre, $mois, $annee, $fileImput) {
    try {
        if (!empty($titre) && !empty($mois) && !empty($annee) && !empty($_FILES[$fileImput]['name'])) {
            ajouterJournal($titre, $mois, $annee, $fileImput);
            afficherAjouterJournal($prefixe, 'Le journal "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner un PDF.');
        }
    } catch (Exception $e) {
        afficherAjouterJournal($prefixe, $e->getMessage());
    }
}

function CtlSupprimerJournal($prefixe, $id) {
    try {
        if (!empty($id)) {
            supprimerJournal($id);
            afficherSupprimerJournal($prefixe, 'Le journal a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un journal.');
        }
    } catch (Exception $e) {
        afficherSupprimerJournal($prefixe, $e->getMessage());
    }
}

########################################################################################################################
# Association (Présentation)                                                                                           #
########################################################################################################################
function CtlPresentation($prefixe) {
    afficherPresentation($prefixe);
}

########################################################################################################################
# Association - Contact                                                                                                #
########################################################################################################################
function CtlContact($prefixe) {
    afficherContact($prefixe);
}

########################################################################################################################
# Association - Fonctionnement                                                                                         #
########################################################################################################################
function CtlFonctionnement($prefixe) {
    afficherFonctionnement($prefixe);
}

########################################################################################################################
# Association - Historique                                                                                             #
########################################################################################################################
function CtlHistorique($prefixe) {
    afficherHistorique($prefixe);
}

########################################################################################################################
# Association - Où nous trouver ?                                                                                      #
########################################################################################################################
function CtlOuNousTrouver($prefixe) {
    afficherOuNousTrouver($prefixe);
}

########################################################################################################################
# Association - Partenaires                                                                                            #
########################################################################################################################
function CtlPartenaires($prefixe) {
    afficherPartenaires($prefixe);
}

########################################################################################################################
# Association - Pôles                                                                                                  #
########################################################################################################################
function CtlPoles($prefixe) {
    afficherPoles($prefixe);
}

########################################################################################################################
# Association - Pourquoi adhérer ?                                                                                     #
########################################################################################################################
function CtlPourquoiAdherer($prefixe) {
    afficherPourquoiAdherer($prefixe);
}

########################################################################################################################
# Association - Réseau associatif                                                                                      #
########################################################################################################################
function CtlReseauAssociatif($prefixe) {
    afficherReseauAssociatif($prefixe);
}

########################################################################################################################
# Association - Réseau associatif - ÔCampus                                                                            #
########################################################################################################################
function CtlOCampus($prefixe) {
    afficherOCampus($prefixe);
}

########################################################################################################################
# Association - Réseau associatif - FNEB                                                                               #
########################################################################################################################
function CtlFneb($prefixe) {
    afficherFneb($prefixe);
}

########################################################################################################################
# Association - Réseaus sociaux                                                                                        #
########################################################################################################################
function CtlReseauxSociaux($prefixe) {
    afficherReseauxSociaux($prefixe);
}

########################################################################################################################
# Association - Université                                                                                             #
########################################################################################################################
function CtlUniversite($prefixe) {
    afficherUniversite($prefixe);
}

########################################################################################################################
# Accueil                                                                                                              #
########################################################################################################################
function CtlAccueil($prefixe) {
    afficherAccueil($prefixe);
}

########################################################################################################################
# Events                                                                                                               #
########################################################################################################################
function CtlEvents($prefixe, $tri, $aVenir, $passes, $rechercheEnCours) {
    afficherEvents($prefixe, $tri, $aVenir, $passes, $rechercheEnCours);
}

function CtlEventPrecis($prefixe, $id) {
    $event = eventPrecis($id);
    if ($event != false) {
        afficherEventPrecis($prefixe, $event);
    } else {
        throw new Exception('L\'évent recherché n\'existe pas.');
    }
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function CtlGoodies($prefixe, $tri, $disponible, $bientot, $rupture,$rechercheEnCours) {
    afficherGoodies($prefixe, $tri, $disponible, $bientot, $rupture,$rechercheEnCours);
}

function CtlGoodiePrecis($prefixe, $id) {
    $goodie = goodiePrecis($id);
    if (!empty($goodie)) {
        afficherGoodiePrecis($prefixe, $goodie);
    } else {
        throw new Exception("Le goodie recherché n'existe pas.");
    }
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function CtlJournaux($prefixe) {
    afficherJournaux($prefixe);
}

########################################################################################################################
# Journaux - Contribuer                                                                                                #
########################################################################################################################
function CtlContribuer($prefixe) {
    afficherContribuer($prefixe);
}

########################################################################################################################
# Mentions légales                                                                                                     #
########################################################################################################################
function CtlMentionsLegales($prefixe) {
    afficherMentionsLegales($prefixe);
}

########################################################################################################################
# Plan du site                                                                                                         #
########################################################################################################################
function CtlPlanDuSite($prefixe) {
    afficherPlanDuSite($prefixe);
}