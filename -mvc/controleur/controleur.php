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
# Initialisation des tableaux globaux                                                                                  #
########################################################################################################################
# Messages
$GLOBALS['messages'] = array();

# Formulaire HTML
$GLOBALS['form'] = array();
foreach ($_POST as $keyInput => $valInput) {
    $GLOBALS['form'][explode('_', $keyInput)[1]] = $valInput;
}

# Retours d'appels de fonctions du modèle
$GLOBALS['retoursModele'] = array();

########################################################################################################################
# Fonctions d'ajout dans les tableaux globaux (pour la lisibilité)                                                     #
########################################################################################################################
function ajouterMessage($code, $texte) {
    array_push($GLOBALS['messages'], [$code, $texte]);
}

function ajouterRetourModele($cle, $resultats) {
    $GLOBALS['retoursModele'][$cle] = $resultats;
}

########################################################################################################################
# Admin                                                                                                                #
########################################################################################################################
# Connexion
function CtlConnexion() {
    afficherConnexion();
}

function CtlVerifConnexion() {
    try {
        if (!empty($GLOBALS['form']['login']) && !empty($GLOBALS['form']['mdp'])) {
            $membre = MdlVerifConnexion($GLOBALS['form']['login'], $GLOBALS['form']['mdp']);
            if ($membre != false) {
                $_SESSION['membre'] = $membre;
                // ajouterLog(001, 'Connexion'); C'est bcp trop stressant d'être autant pisté omg !!!!
                CtlMenu();
            } else {
                ajouterMessage(401, 'Login ou mot de passe invalide.');
                afficherConnexion();
            }
        } else {
            ajouterMessage(400, 'Veuillez remplir tous les champs.');
            afficherConnexion();
        }
    } catch (Exception $e) {
        ajouterMessage(500, $e->getMessage());
        afficherConnexion();
    }
}

# Menu
function CtlCreerEventMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherCreerEvent($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixEventMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherChoixEvent($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerEventMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerEvent($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterGoodieMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterGoodie($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterImageGoodieMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterImageGoodie($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixGoodieMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherChoixGoodie($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerGoodieMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerGoodie($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterJournalMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterJournal($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerJournalMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerJournal($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterImageArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterImageArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherChoixArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterArticleVideoMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterArticleVideo($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticleVideoMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherChoixArticleVideo($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticleVideoMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherSupprimerArticleVideo($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterCategorieArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherAjouterCategorieArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlRenommerCategorieArticleMenu($messageRetour) {
    if (isset($_SESSION['id'])) {
        afficherRenommerCategorieArticle($messageRetour);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAfficherLog() {
    MdlLogTous();
    afficherAfficherLog();
}

function CtlMenu() {
    afficherMenu();
}

function CtlDeconnexion() {
    $_SESSION = array();
    if (isset($COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    ajouterMessage(200, 'Session déconnectée avec succès.');
    CtlConnexion();
}

function CtlMenuErreur($messageErreur) {
    if (isset($_SESSION['id'])) {
        afficherMenu($messageErreur);
    } else {
        CtlConnexion('La session a expiré.');
    }
}

# Events
function CtlCreerEvent($titre, $date, $heure, $minute, $lieu, $desc) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixEvent($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherModifierEvent('', $id);
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un évent.');
            }
        } catch (Exception $e) {
            afficherChoixEvent($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlModifierEvent($id, $titre, $date, $heure, $minute, $lieu, $desc) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerEvent($id) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

# Goodies
function CtlAjouterGoodie($titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc, $fileImput) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterImageGoodie($id, $fileImput) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixGoodie($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherModifierGoodie('', $id);
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un goodie.');
            }
        } catch (Exception $e) {
            afficherChoixGoodie($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlModifierGoodie($id, $titre, $categorie, $prixADEuro, $prixADCentimes, $prixNADEuro, $prixNADCentimes, $desc) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAllerSupprimerImageGoodie($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherSupprimerImageGoodie('', $id);
            } else {
                throw new Exception('Erreur : Identifiant invalide.');
            }
        } catch (Exception $e) {
            afficherModifierGoodie($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerGoodie($id) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

# Journaux
function CtlAjouterJournal($titre, $mois, $annee, $fileImput) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerJournal($id) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

# Articles
function CtlAjouterArticle($titre, $categorie, $visibilite, $texte) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterImageArticle($id, $fileImput) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticle($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherModifierArticle('', $id);
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un article.');
            }
        } catch (Exception $e) {
            afficherChoixArticle($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlModifierArticle($id, $titre, $categorie, $visibilite, $texte) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAllerSupprimerImageArticle($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherSupprimerImageArticle('', $id);
            } else {
                throw new Exception('Erreur : Identifiant invalide.');
            }
        } catch (Exception $e) {
            afficherModifierArticle($e->getMessage(), $id);
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticle($id) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterArticleVideo($titre, $categorie, $visibilite, $lien, $texte) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlChoixArticleVideo($id) {
    if (isset($_SESSION['id'])) {
        try {
            if (!empty($id)) {
                afficherModifierArticleVideo('', $id);
            } else {
                throw new Exception('Erreur : Veuillez sélectionner un article.');
            }
        } catch (Exception $e) {
            afficherChoixArticleVideo($e->getMessage());
        }
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlModifierArticleVideo($id, $titre, $categorie, $visibilite, $lien, $texte) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlSupprimerArticleVideo($id) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlAjouterCategorieArticle($titre) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
    }
}

function CtlRenommerCategorieArticle($id, $titre) {
    if (isset($_SESSION['id'])) {
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
    } else {
        CtlConnexion('La session a expiré.');
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
        afficherInscription($e->getMessage());
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