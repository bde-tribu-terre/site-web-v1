<?php
require_once(RACINE . '-mvc/modele/connect.php');
require_once(RACINE . '-mvc/modele/modele.php');
require_once(RACINE . '-mvc/vue/vue.php');
########################################################################################################################
# Erreur (public, tous les C. Frontaux)                                                                                #
########################################################################################################################
function CtlErreur($messageErreur) {
    afficherErreur($messageErreur);
}

########################################################################################################################
# Admin                                                                                                                #
########################################################################################################################
# Connexion
function CtlConnexion($messageRetour) {
    afficherConnexion($messageRetour);
}

function CtlVerifConnexion($login, $mdp) {
    try {
        if (!empty($login) && !empty($mdp)) {
            $id = verifConnexion($login, $mdp);
            if ($id != false) {
                $_SESSION['id'] = $id;
                // ajouterLog(001, 'Connexion'); C'est bcp trop stressant d'être autant pisté omg !!!!
                CtlMenu('');
            } else {
                afficherConnexion("Erreur : Login ou mot de passe invalide.");
            }
        } else {
            afficherConnexion("Erreur : Veuillez remplir tous les champs.");
        }
    } catch (Exception $e) {
        afficherConnexion($e->getMessage());
    }
}

function CtlConnexionErreur($messageErreur) {
    afficherConnexion($messageErreur);
}

# Menu
function CtlCreerEventMenu($messageRetour) {
    afficherCreerEvent($messageRetour);
}

function CtlChoixEventMenu($messageRetour) {
    afficherChoixEvent($messageRetour);
}

function CtlSupprimerEventMenu($messageRetour) {
    afficherSupprimerEvent($messageRetour);
}

function CtlAjouterGoodieMenu($messageRetour) {
    afficherAjouterGoodie($messageRetour);
}

function CtlAjouterImageGoodieMenu($messageRetour) {
    afficherAjouterImageGoodie($messageRetour);
}

function CtlChoixGoodieMenu($messageRetour) {
    afficherChoixGoodie($messageRetour);
}

function CtlSupprimerGoodieMenu($messageRetour) {
    afficherSupprimerGoodie($messageRetour);
}

function CtlAjouterJournalMenu($messageRetour) {
    afficherAjouterJournal($messageRetour);
}

function CtlSupprimerJournalMenu($messageRetour) {
    afficherSupprimerJournal($messageRetour);
}

function CtlAjouterArticleMenu($messageRetour) {
    afficherAjouterArticle($messageRetour);
}

function CtlAjouterImageArticleMenu($messageRetour) {
    afficherAjouterImageArticle($messageRetour);
}

function CtlChoixArticleMenu($messageRetour) {
    afficherChoixArticle($messageRetour);
}

function CtlSupprimerArticleMenu($messageRetour) {
    afficherSupprimerArticle($messageRetour);
}

function CtlAjouterArticleVideoMenu($messageRetour) {
    afficherAjouterArticleVideo($messageRetour);
}

function CtlChoixArticleVideoMenu($messageRetour) {
    afficherChoixArticleVideo($messageRetour);
}

function CtlSupprimerArticleVideoMenu($messageRetour) {
    afficherSupprimerArticleVideo($messageRetour);
}

function CtlAjouterCategorieArticleMenu($messageRetour) {
    afficherAjouterCategorieArticle($messageRetour);
}

function CtlRenommerCategorieArticleMenu($messageRetour) {
    afficherRenommerCategorieArticle($messageRetour);
}

function CtlAfficherLog($messageRetour) {
    afficherAfficherLog($messageRetour);
}

function CtlMenu($messageRetour) {
    afficherMenu($messageRetour);
}

function CtlDeconnexion($messageRetour) {
    $_SESSION = array();
    if (isset($COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    CtlConnexion($messageRetour);
}

function CtlMenuErreur($messageErreur) {
    afficherMenu($messageErreur);
}

# Events
function CtlCreerEvent($titre, $date, $heure, $minute, $lieu, $desc) {
    try {
        if (
            !empty($titre) &&
            !empty($date) &&
            (!empty($heure) || $heure == 0) &&
            (!empty($minute) || $minute == 0) &&
            !empty($desc)
        ) {
            creerEvent($titre, $date, $heure, $minute, $lieu, $desc);
            afficherCreerEvent('L\'évent "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherCreerEvent($e->getMessage());
    }
}

function CtlChoixEvent($id) {
    try {
        if (!empty($id)) {
            afficherModifierEvent('', $id);
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un évent.');
        }
    } catch (Exception $e) {
        afficherChoixEvent($e->getMessage());
    }
}

function CtlModifierEvent($id, $titre, $date, $heure, $minute, $lieu, $desc) {
    try {
        if (
            !empty($titre) &&
            !empty($date) &&
            (!empty($heure) || $heure == 0) &&
            (!empty($minute) || $minute == 0) &&
            !empty($desc)
        ) {
            modifierEvent($id, $titre, $desc, $date, $heure, $minute, $lieu);
            afficherModifierEvent('L\'évent "' . $titre . '" a été modifié avec succès !', $id);
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherModifierEvent($e->getMessage(), $id);
    }
}

function CtlSupprimerEvent($id) {
    try {
        if (!empty($id)) {
            supprimerEvent($id);
            afficherSupprimerEvent('L\'évent a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un évent.');
        }
    } catch (Exception $e) {
        afficherSupprimerEvent($e->getMessage());
    }
}

# Goodies
function CtlAjouterGoodie($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
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
            ajouterGoodie(RACINE . 'goodies/', $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput);
            afficherAjouterGoodie('Le goodie "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner une miniature.');
        }
    } catch (Exception $e) {
        afficherAjouterGoodie($e->getMessage());
    }
}

function CtlAjouterImageGoodie($id, $fileImput) {
    try {
        if (!empty($id) && !empty($_FILES[$fileImput]['name'])) {
            $titre = goodiePrecis($id)->titreGoodies;
            ajouterImageGoodie(RACINE . 'goodies/', $id, $titre, $fileImput);
            afficherAjouterImageGoodie('L\'image a été ajoutée au goodie ' . $titre . ' avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner une image.');
        }
    } catch (Exception $e) {
        afficherAjouterImageGoodie($e->getMessage());
    }
}

function CtlChoixGoodie($id) {
    try {
        if (!empty($id)) {
            afficherModifierGoodie('', $id);
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un goodie.');
        }
    } catch (Exception $e) {
        afficherChoixGoodie($e->getMessage());
    }
}

function CtlModifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
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
            afficherModifierGoodie('Le goodie "' . $titre . '" a été modifié avec succès !', $id);
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherModifierGoodie($e->getMessage(), $id);
    }
}

function CtlAllerSupprimerImageGoodie($id) {
    try {
        if (!empty($id)) {
            afficherSupprimerImageGoodie('', $id);
        } else {
            throw new Exception('Erreur : Identifiant invalide.');
        }
    } catch (Exception $e) {
        afficherModifierGoodie($e->getMessage(), $id);
    }
}

function CtlSupprimerGoodie($id) {
    try {
        if (!empty($id)) {
            supprimerGoodie(RACINE . 'goodies/', $id);
            afficherSupprimerGoodie('Le goodie a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un goodie.');
        }
    } catch (Exception $e) {
        afficherSupprimerGoodie($e->getMessage());
    }
}

# Journaux
function CtlAjouterJournal($titre, $mois, $annee, $fileImput) {
    try {
        if (!empty($titre) && !empty($mois) && !empty($annee) && !empty($_FILES[$fileImput]['name'])) {
            ajouterJournal(RACINE . 'journaux/', $titre, $mois, $annee, $fileImput);
            afficherAjouterJournal('Le journal "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner un PDF.');
        }
    } catch (Exception $e) {
        afficherAjouterJournal($e->getMessage());
    }
}

function CtlSupprimerJournal($id) {
    try {
        if (!empty($id)) {
            supprimerJournal(RACINE . 'journaux/', $id);
            afficherSupprimerJournal('Le journal a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un journal.');
        }
    } catch (Exception $e) {
        afficherSupprimerJournal($e->getMessage());
    }
}

# Articles
function CtlAjouterArticle($titre, $categorie, $visibilite, $texte) {
    try {
        if (
            !empty($titre) &&
            $categorie != '-1' &&
            $visibilite != '-1' &&
            !empty($texte)
        ) {
            ajouterArticle($titre, $categorie, $visibilite, $texte);
            afficherAjouterArticle('L\'article "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherAjouterArticle($e->getMessage());
    }
}

function CtlAjouterImageArticle($id, $fileImput) {
    try {
        if (!empty($id) && !empty($_FILES[$fileImput]['name'])) {
            $titre = articlePrecis($id)->titreArticles;
            ajouterImageArticle(RACINE . 'articles/', $id, $titre, $fileImput);
            afficherAjouterImageArticle('L\'image a été ajoutée à l\'article ' . $titre . ' avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs et sélectionner une image.');
        }
    } catch (Exception $e) {
        afficherAjouterImageArticle($e->getMessage());
    }
}

function CtlChoixArticle($id) {
    try {
        if (!empty($id)) {
            afficherModifierArticle('', $id);
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un article.');
        }
    } catch (Exception $e) {
        afficherChoixArticle($e->getMessage());
    }
}

function CtlModifierArticle($id, $titre, $categorie, $visibilite, $texte) {
    try {
        if (
            !empty($titre) &&
            (!empty($visibilite) || $visibilite == 0) &&
            (!empty($visibilite) || $visibilite == 0) &&
            !empty($texte)
        ) {
            modifierArticle($id, $titre, $categorie, $visibilite, $texte);
            afficherModifierArticle('L\'article "' . $titre . '" a été modifié avec succès !', $id);
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherModifierArticle($e->getMessage(), $id);
    }
}

function CtlAllerSupprimerImageArticle($id) {
    try {
        if (!empty($id)) {
            afficherSupprimerImageArticle('', $id);
        } else {
            throw new Exception('Erreur : Identifiant invalide.');
        }
    } catch (Exception $e) {
        afficherModifierArticle($e->getMessage(), $id);
    }
}

function CtlSupprimerArticle($id) {
    try {
        if (!empty($id)) {
            supprimerArticle(RACINE . 'articles/', $id);
            afficherSupprimerArticle('L\'article a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un article.');
        }
    } catch (Exception $e) {
        afficherSupprimerArticle($e->getMessage());
    }
}

function CtlAjouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte) {
    try {
        if (
            !empty($titre) &&
            $categorie != '-1' &&
            $visibilite != '-1' &&
            !empty($lien) &&
            !empty($texte)
        ) {
            ajouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte);
            afficherAjouterArticleVideo('L\'article vidéo "' . $titre . '" a été ajouté avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherAjouterArticleVideo($e->getMessage());
    }
}

function CtlChoixArticleVideo($id) {
    try {
        if (!empty($id)) {
            afficherModifierArticleVideo('', $id);
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un article.');
        }
    } catch (Exception $e) {
        afficherChoixArticleVideo($e->getMessage());
    }
}

function CtlModifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte) {
    try {
        if (
            !empty($titre) &&
            (!empty($visibilite) || $visibilite == 0) &&
            (!empty($visibilite) || $visibilite == 0) &&
            !empty($lien) &&
            !empty($texte)
        ) {
            modifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte);
            afficherModifierArticleVideo('L\'article "' . $titre . '" a été modifié avec succès !', $id);
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherModifierArticleVideo($e->getMessage(), $id);
    }
}

function CtlSupprimerArticleVideo($id) {
    try {
        if (!empty($id)) {
            supprimerArticleVideo($id);
            afficherSupprimerArticleVideo('L\'article vidéo a été supprimé avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez sélectionner un article.');
        }
    } catch (Exception $e) {
        afficherSupprimerArticleVideo($e->getMessage());
    }
}

function CtlAjouterCategorieArticle($titre) {
    try {
        if (!empty($titre)) {
            ajouterCategorieArticle($titre);
            afficherAjouterCategorieArticle('La catégorie "' . $titre . '" a été ajoutée avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherAjouterCategorieArticle($e->getMessage());
    }
}

function CtlRenommerCategorieArticle($id, $titre) {
    try {
        if (!empty($id) && !empty($titre)) {
            renommerCategorieArticle($id, $titre);
            afficherRenommerCategorieArticle('La catégorie a été renommée en "' . $titre . '" avec succès !');
        } else {
            throw new Exception('Erreur : Veuillez remplir tous les champs.');
        }
    } catch (Exception $e) {
        afficherRenommerCategorieArticle($e->getMessage());
    }
}

########################################################################################################################
# Admin - Inscription                                                                                                  #
########################################################################################################################
function CtlInscription($messageRetour) {
    afficherInscription($messageRetour);
}

function CtlSInscrire($cle, $prenom, $nom, $login, $mdp) {
    try {
        if (!empty($cle) && !empty($prenom) && !empty($nom) && !empty($login) && !empty($mdp)) {
            if (cleExiste($cle)) { // Si trouvée, alors elle est détruite.
                ajouterMembre($prenom, $nom, $login, $mdp);
                afficherInscription('L\'inscription a bien été enregistrée.');
            } else {
                afficherInscription("Erreur : La clé d'inscription saisie n'existe pas.");
            }
        } else {
            afficherInscription("Erreur : Veuillez remplir tous les champs.");
        }
    } catch (Exception $e) {
        afficherConnexion($e->getMessage());
    }
}

########################################################################################################################
# Accueil                                                                                                              #
########################################################################################################################
function CtlAccueil() {
    afficherAccueil();
}

########################################################################################################################
# Articles                                                                                                             #
########################################################################################################################
function CtlArticles() {
    afficherArticles();
}

function CtlArticlePrecis($id) {
    if ($id >= 0) {
        $article = articlePrecis($id);
        if ($article != false) {
            afficherArticlePrecis($article);
        } else {
            throw new Exception('L\'article recherché n\'existe pas.');
        }
    } else {
        $article = articleVideoPrecis(-$id);
        if ($article != false) {
            afficherArticleVideoPrecis($article);
        } else {
            throw new Exception('L\'article vidéo recherché n\'existe pas.');
        }
    }
}

########################################################################################################################
# Association (Présentation)                                                                                           #
########################################################################################################################
function CtlPresentation() {
    afficherPresentation();
}

########################################################################################################################
# Association - Contact                                                                                                #
########################################################################################################################
function CtlContact() {
    afficherContact();
}

########################################################################################################################
# Association - Fonctionnement                                                                                         #
########################################################################################################################
function CtlFonctionnement() {
    afficherFonctionnement();
}

########################################################################################################################
# Association - Fonctionnement - Statuts                                                                               #
########################################################################################################################
function CtlStatuts() {
    afficherStatuts();
}

########################################################################################################################
# Association - Historique                                                                                             #
########################################################################################################################
function CtlHistorique() {
    afficherHistorique();
}

########################################################################################################################
# Association - Où nous trouver ?                                                                                      #
########################################################################################################################
function CtlOuNousTrouver() {
    afficherOuNousTrouver();
}

########################################################################################################################
# Association - Partenaires                                                                                            #
########################################################################################################################
function CtlPartenaires() {
    afficherPartenaires();
}

########################################################################################################################
# Association - Pôles                                                                                                  #
########################################################################################################################
function CtlPoles() {
    afficherPoles();
}

########################################################################################################################
# Association - Pourquoi adhérer ?                                                                                     #
########################################################################################################################
function CtlPourquoiAdherer() {
    afficherPourquoiAdherer();
}

########################################################################################################################
# Association - Réseau associatif                                                                                      #
########################################################################################################################
function CtlReseauAssociatif() {
    afficherReseauAssociatif();
}

########################################################################################################################
# Association - Réseau associatif - ÔCampus                                                                            #
########################################################################################################################
function CtlOCampus() {
    afficherOCampus();
}

########################################################################################################################
# Association - Réseau associatif - FNEB                                                                               #
########################################################################################################################
function CtlFneb() {
    afficherFneb();
}

########################################################################################################################
# Association - Réseaus sociaux                                                                                        #
########################################################################################################################
function CtlReseauxSociaux() {
    afficherReseauxSociaux();
}

########################################################################################################################
# Association - Université                                                                                             #
########################################################################################################################
function CtlUniversite() {
    afficherUniversite();
}

########################################################################################################################
# Events                                                                                                               #
########################################################################################################################
function CtlEvents($tri, $aVenir, $passes, $rechercheEnCours) {
    afficherEvents($tri, $aVenir, $passes, $rechercheEnCours);
}

function CtlEventPrecis($id) {
    $event = eventPrecis($id);
    if ($event != false) {
        afficherEventPrecis($event);
    } else {
        throw new Exception('L\'évent recherché n\'existe pas.');
    }
}

########################################################################################################################
# Goodies                                                                                                              #
########################################################################################################################
function CtlGoodies($tri, $disponible, $bientot, $rupture,$rechercheEnCours) {
    afficherGoodies($tri, $disponible, $bientot, $rupture,$rechercheEnCours);
}

function CtlGoodiePrecis($id) {
    $goodie = goodiePrecis($id);
    if (!empty($goodie)) {
        afficherGoodiePrecis($goodie);
    } else {
        throw new Exception("Le goodie recherché n'existe pas.");
    }
}

########################################################################################################################
# Journaux                                                                                                             #
########################################################################################################################
function CtlJournaux() {
    afficherJournaux();
}

########################################################################################################################
# Mentions légales                                                                                                     #
########################################################################################################################
function CtlMentionsLegales() {
    afficherMentionsLegales();
}

########################################################################################################################
# Plan du site                                                                                                         #
########################################################################################################################
function CtlPlanDuSite() {
    afficherPlanDuSite();
}

########################################################################################################################
# Riad (temporaire)                                                                                                    #
########################################################################################################################
function CtlRiad() {
    afficherRiad();
}