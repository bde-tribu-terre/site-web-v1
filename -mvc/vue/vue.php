<?php
########################################################################################################################
########################################################################################################################
###                                                     -- A --                                                      ###
###                                                                                                                  ###
###                                                   INTRODUCTION                                                   ###
########################################################################################################################
########################################################################################################################

########################################################################################################################
# A.I - Constantes Générales                                                                                           #
########################################################################################################################
/**
 * Variable contenant la version actuelle du site indiquée dans le fichier ."../-mvc/vue/version.txt".
 */
define('VERSION_SITE', file_get_contents(racine() . '/version.txt'));

########################################################################################################################
# A.II - Fonction d'Initialisation des Constantes Spécifiques & Affichage du Cadre                                     #
########################################################################################################################
/**
 * Exécute l'affichage de la page.
 * @param string $title
 * Le title qui sera affiché sur l'onglet du navigateur.
 * @param string $gabarit
 * Le nom du fichier gabarit qui sera utilisé (extension de fichier comprise). Exemple : 'accueil.php'.
 * @param string $cadre
 * Le nom du répertoire dans lequel sera cherché le gabarit. Le header et le footer seront ainsi correctement choisis.
 * Les répertoires implémentés sont :
 * <ul>
 * <li>'admin' : Partie administration, réservée aux membres</li>
 * <li>'public' : Partie publique (par défaut)</li>
 * </ul>
 */
function afficherPage($title, $gabarit, $cadre) {
    if (file_exists(racine() . '-mvc/vue/gabarits/' . $cadre)) {
        define('CHEMIN_VERS_VARIABLES', '/-mvc/vue/gabarits/' . $cadre . '/essentiels/variables.min.css');
        define('CHEMIN_VERS_STYLE', '/-mvc/vue/gabarits/' . $cadre . '/essentiels/style.min.css');
        define('CHEMIN_VERS_HEADER', racine() . '-mvc/vue/gabarits/' . $cadre . '/essentiels/header.php');
        define('CHEMIN_VERS_MESSAGES', racine() . '-mvc/vue/gabarits/' . $cadre . '/essentiels/messages.php');
        define('CHEMIN_VERS_FOOTER', racine() . '-mvc/vue/gabarits/' . $cadre . '/essentiels/footer.php');
        define('CHEMIN_VERS_GABARIT', racine() . '-mvc/vue/gabarits/' . $cadre . '/' . $gabarit);
    } else {
        array_push($messages, ['500', 'Répertoire de gabarits ' . $cadre . ' non trouvé.']);
        define('CHEMIN_VERS_VARIABLES', '/-mvc/vue/gabarits/public/essentiels/variables.min.css');
        define('CHEMIN_VERS_STYLE', '/-mvc/vue/gabarits/public/essentiels/style.min.css');
        define('CHEMIN_VERS_HEADER', racine() . '-mvc/vue/gabarits/public/essentiels/header.php');
        define('CHEMIN_VERS_MESSAGES', racine() . '-mvc/vue/gabarits/public/essentiels/messages.php');
        define('CHEMIN_VERS_FOOTER', racine() . '-mvc/vue/gabarits/public/essentiels/footer.php');
        define('CHEMIN_VERS_GABARIT', racine() . '-mvc/vue/gabarits/public/accueil.php');
    }

    define('MESSAGES', serialize($GLOBALS['messages']));
    define('TITLE', $title);
    define('GABARIT', $gabarit);

    require_once(racine() . '-mvc/vue/cadre.php');
}

########################################################################################################################
# A.III - Fonctions d'affichage                                                                                        #
########################################################################################################################
/**
 * Génère une date dans un format convivial.
 * @param string $date
 * La date à convertir au format aaaa-mm-jj (info : format standard en SQL).
 * @param bool $numerique
 * Faut-il privilégier un format numérique ? Si le paramètre n'est pas renseigné alors la date sera au format développé
 * en français. Exemples :
 * <ul>
 * <li>Développé : 1<sup>er</sup> Janvier 2020</li>
 * <li>Numérique : 01/01/2020</li>
 * </ul>
 * @return string
 * <strong>HTML</strong> La date au format choisi, sous forme de chaîne de caractère.
 */
function genererDate($date, $numerique = false) {
    if ($numerique) {
        return
            substr($date, 8, 2) . '/' .
            substr($date, 5, 2) . '/' .
            substr($date, 0, 4);
    } else {
        $arrayMois = [
            '01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
            '04' => 'Avril', '05' => 'Mai', '06' => 'Juin',
            '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre',
            '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
        ];

        return
            (substr($date, 8, 2) == '01' ? '1<sup>er</sup>' : intval(substr($date, 8, 2))) .
            ' ' .
            $arrayMois[substr($date, 5, 2)] .
            ' ' .
            substr($date, 0, 4);
    }
}

/**
 * Formate le texte en remplaçant les éléments simples en balises HTML. Réorganise également les retours à la ligne et
 * la mise en forme en général. Les éléments simples traîtés sont :
 * <ul>
 * <li>§T<i>texte</i>§!T => Titre</li>
 * <li>§G<i>texte</i>§!G => Gras</li>
 * <li>§I<i>texte</i>§!I => Italique</li>
 * <li>§S<i>texte</i>§!S => Souligné</li>
 * <li>§B<i>texte</i>§!B => Barré</li>
 * <li>§C<i>texte</i>§!C => Petites Capitales</li>
 * <li>§L<i>texte</i>§!L[<i>lien</i>] => Lien Hypertexte</li>
 * </ul>
 * @param string $texte
 * Le texte d'origine.
 * @return string
 * <strong>HTML</strong> Le texte formaté.
 */
function formaterTexte($texte) {
    $texteFormate = preg_replace('/&sect;T(.*?)&sect;!T/', "\n<h3>$1</h3>\n", $texte);
    $texteFormate = preg_replace('/\n(\n)*/', "\n", $texteFormate);
    $texteFormate = '<p>' . preg_replace('/\n/', '</p><p>', $texteFormate) . '</p>';
    $texteFormate = preg_replace('/&sect;G(.*?)&sect;!G/', '<strong>$1</strong>', $texteFormate);
    $texteFormate = preg_replace('/&sect;I(.*?)&sect;!I/', '<i>$1</i>', $texteFormate);
    $texteFormate = preg_replace('/&sect;S(.*?)&sect;!S/', '<u>$1</u>', $texteFormate);
    $texteFormate = preg_replace('/&sect;B(.*?)&sect;!B/', '<span style="text-decoration: line-through;">$1</span>', $texteFormate);
    $texteFormate = preg_replace('/&sect;C(.*?)&sect;!C/', '<span class="pc">$1</span>', $texteFormate);
    $texteFormate = preg_replace('/&sect;L(.*?)&sect;!L\[(.*?)]/', '<a href="$2">$1</a>', $texteFormate);
    return $texteFormate;
}

function genererNom($prenom, $nom) {
    return $prenom . ' <span class="pc">' . $nom . '</span>';
}

########################################################################################################################
########################################################################################################################
###                                                     -- B --                                                      ###
###                                                                                                                  ###
###                                              FONCTION D'AFFICHAGES                                               ###
###                                         CLASSÉES PAR CONTRÔLEUR FRONTAL                                          ###
########################################################################################################################
########################################################################################################################

########################################################################################################################
# B - Admin                                                                                                            #
########################################################################################################################
# Système
function afficherConnexion() {
    afficherPage('Accueil', 'connexion.php', 'admin');
}

function afficherMenu() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));

    afficherPage('Menu administrateur', 'menu.php', 'admin');
}

# Events
function afficherCreerEvent() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));

    afficherPage('Créer un événements', 'creerEvent.php', 'admin');
}

function afficherChoixEvent() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $events = '';
    foreach ($GLOBALS['retoursModele']['events'] as $event) {
        $events .=
            '
            <option value="' . $event['id'] . '">
                (' . genererDate($event['date'], true) . ') ' . $event['titre'] . '
            </option>
            ';
    }
    define('EVENTS', $events);

    afficherPage('Choisir un événements', 'choixEvent.php', 'admin');
}

function afficherModifierEvent() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    define('ID', $GLOBALS['retoursModele']['event']['id']);
    define('TITRE', $GLOBALS['retoursModele']['event']['titre']);
    define('DESC', $GLOBALS['retoursModele']['event']['description']);
    define('DATE', $GLOBALS['retoursModele']['event']['date']);
    define('HEURE', substr($GLOBALS['retoursModele']['event']['heure'], 0, 2));
    define('MINUTE', substr($GLOBALS['retoursModele']['event']['heure'], 3, 2));
    define('LIEU', $GLOBALS['retoursModele']['event']['lieu']);

    afficherPage('Modifier un événements', 'modifierEvent.php', 'admin');
}

function afficherSupprimerEvent() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $events = '';
    foreach ($GLOBALS['retoursModele']['events'] as $event) {
        $events .=
            '
            <option value="' . $event['id'] . '">
                (' . genererDate($event['date'], true) . ') ' . $event['titre'] . '
            </option>
            ';
    }
    define('EVENTS', $events);

    afficherPage('Supprimer un événements', 'supprimerEvent.php', 'admin');
}

# Goodies
function afficherAjouterGoodie() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));

    afficherPage('Ajouter un goodie', 'ajouterGoodie.php', 'admin');
}

function afficherAjouterImageGoodie() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $goodies = '';
    foreach ($GLOBALS['retoursModele']['goodies'] as $goodie) {
        $goodies .=
            '
            <option value="' . $goodie['id'] . '">
            ' . $goodie['titre'] . '
            </option>
            ';
    }
    define('GOODIES', $goodies);

    afficherPage('Ajouter une image à un goodie', 'ajouterImageGoodie.php', 'admin');
}

function afficherChoixGoodie() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $arrayCategories = [
        0 => 'Caché',
        1 => 'Disponible',
        2 => 'Bientôt disponible',
        3 => 'Rupture de stock'
    ];
    $goodies = '';
    foreach ($GLOBALS['retoursModele']['goodies'] as $goodie) {
        $goodies .=
            '
            <option value="' . $goodie['id'] . '">
                (' . $arrayCategories[$goodie['categorie']] . ') ' . $goodie['titre'] . '
            </option>
            ';
    }
    define('GOODIES', $goodies);

    afficherPage('Choisir un goodie', 'choixGoodie.php', 'admin');
}

function afficherModifierGoodie() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    define('ID', $GLOBALS['retoursModele']['goodie']['id']);
    define('TITRE', $GLOBALS['retoursModele']['goodie']['titre']);
    define('PRIX_AD_EURO', intval($GLOBALS['retoursModele']['goodie']['prixAD']));
    define('PRIX_AD_CENTIMES', intval(($GLOBALS['retoursModele']['goodie']['prixAD'] - intval(PRIX_AD_EURO)) * 100));
    define('PRIX_NAD_EURO', intval($GLOBALS['retoursModele']['goodie']['prixNAD']));
    define('PRIX_NAD_CENTIMES', intval(($GLOBALS['retoursModele']['goodie']['prixNAD'] - intval(PRIX_NAD_EURO)) * 100));
    define('CATEGORIE', $GLOBALS['retoursModele']['goodie']['categorie']);
    define('DESC', $GLOBALS['retoursModele']['goodie']['description']);

    afficherPage('Modifier un goodie', 'modifierGoodie.php', 'admin');
}

function afficherSupprimerImageGoodie() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $images = '';
    foreach ($GLOBALS['retoursModele']['imagesGoodie'] as $image) {
        $images .=
            '
            <div class="form-group">
                <label for="formSupprimerImageGoodie_image' . $image['id'] . '">
                    <img src="/goodies/' . $image['lien'] . '" width="200" height="150" alt="img">
                </label>
                <input
                        id="formSupprimerImageGoodie_image' . $image['id'] . '"
                        name="formSupprimerImageGoodie_image' . $image['id'] . '"
                        type="checkbox"
                        class="form-control"
                >
            </div>
            <br>';
    }
    $images .= $images == '' ? '<p>Ce goodie n\'a aucune image. La miniature n\'est pas modifiable.</p>' : '';
    define('ID', $GLOBALS['retoursModele']['goodie']['id']);
    define('IMAGES_GOODIE', $images); // Car la constante IMAGES existe déjà...

    afficherPage('Supprimer une image d\'un goodie', 'supprimerImageGoodie.php', 'admin');
}

function afficherSupprimerGoodie() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $arrayCategories = [
        0 => 'Caché',
        1 => 'Disponible',
        2 => 'Bientôt disponible',
        3 => 'Rupture de stock'
    ];
    $goodies = '';
    foreach ($GLOBALS['retoursModele']['goodies'] as $goodie) {
        $goodies .=
            '
            <option value="' . $goodie['id'] . '">
                (' . $arrayCategories[$goodie['categorie']] . ') ' . $goodie['titre'] . '
            </option>
            ';
    }
    define('GOODIES', $goodies);

    afficherPage('Supprimer un goodie', 'supprimerGoodie.php', 'admin');
}

# Journaux
function afficherAjouterJournal() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));

    afficherPage('Ajouter un journal', 'ajouterJournal.php', 'admin');
}

function afficherSupprimerJournal() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $journaux = '';
    foreach ($GLOBALS['retoursModele']['journaux'] as $journal) {
        $journaux .=
            '
            <option value="' . $journal['id'] . '">
                ' . $journal['titre'] . '
            </option>
            ';
    }
    define('JOURNAUX', $journaux);

    afficherPage('Supprimer un journal', 'supprimerJournal.php', 'admin');
}

# Liens

function afficherAjouterLienPratique() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));

    afficherPage('Ajouter un lien', 'ajouterLienPratique.php', 'admin');
}

function afficherSupprimerLienPratique() {
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));
    $liens = '';
    foreach ($GLOBALS['retoursModele']['liensPratiques'] as $lien) {
        $liens .=
            '
            <option value="' . $lien['id'] . '">
                ' . $lien['titre'] . '
            </option>
            ';
    }
    define('LIENS_PRATIQUES', $liens);

    afficherPage('Supprimer un lien', 'supprimerLienPratique.php', 'admin');
}

# Log
function afficherLog() {
    $log = '';
    foreach ($GLOBALS['retoursModele']['log'] as $ligneLog) {
        $dateHeure = explode(' ', $ligneLog['date']);
        $date = $dateHeure[0];
        $heure = $dateHeure[1];
        $log .=
            '
            <tr>
            <th scope="row">' . genererDate($date) . ' '. $heure . '</th>
            <th>' . $ligneLog['description'] . '</th>
            </tr>
            ';
    }
    define('LOG', $log);
    define('NOM_MEMBRE', genererNom($_SESSION['membre']['prenom'], $_SESSION['membre']['nom']));

    afficherPage('Log', 'log.php', 'admin');
}

########################################################################################################################
# B - Admin - Inscription                                                                                              #
########################################################################################################################
function afficherInscription() {
    afficherPage('Inscription', 'inscription.php', 'admin');
}

########################################################################################################################
# B - Accueil                                                                                                          #
########################################################################################################################
function afficherAccueil() {
    # Goodies
    $goodiesIndicators = '';
    $goodies ='';
    $nb = 0;
    $premier = true;
    shuffle($GLOBALS['retoursModele']['goodies']);
    foreach ($GLOBALS['retoursModele']['goodies'] as $goodie) {
        // 0 : Caché, 1 : Disponible, 2 : Bientôt disponible, 3 : En rupture de stock
        if ($goodie['categorie'] != 1) {
            continue;
        }
        $goodiesIndicators .=
            '
            <li data-target="#carouselGoodies" data-slide-to="' . $nb++ . '" ' . ($premier ? 'class="active"' : '') . '>
            </li>
            ';
        $goodies .=
            '
            <div class="item' . ($premier ? ' active' : '') . '">
            <a href="/goodies/?id=' . $goodie['id'] . '"><img class="arrondi" src="/goodies/' . $goodie['miniature'] . '" alt="Image"></a>
            <div class="carousel-caption">
            <a href="/goodies/?id=' . $goodie['id'] . '"><h3>' . $goodie['titre'] . '</h3></a>
            <p>' . $goodie['prixAD'] . '€ Adhérent | ' . $goodie['prixNAD'] . '€ Non-adhérent</p>
            </div>
            </div>
            ';
        if ($premier) {
            $premier = false;
        }
    }
    $carouselGoodies =
        '<div id="carouselGoodies" class="carousel carousel-images slide arrondi ombre" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                ' . $goodiesIndicators . '
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- Ici on liste les goodies -->
                ' . $goodies . '
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carouselGoodies" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselGoodies" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>';
    define('CAROUSEL_GOODIES', $carouselGoodies);

    # Events
    $events = '';
    $count = 0;
    foreach ($GLOBALS['retoursModele']['events'] as $event) {
        $count++;
        $nbJours = round((strtotime($event['date']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
        switch ($nbJours) {
            case 0:
                $nbJoursStr = '<strong><span style="color: red"> (Aujourd\'hui)</span></strong>';
                break;
            case 1:
                $nbJoursStr = '<strong><span style="color: red"> (Demain)</span></strong>';
                break;
            default:
                $nbJoursStr = ' (dans ' . $nbJours . ' jours)';
        }
        $events .=
            '
            ' . ($count == 3 ? '<div class="alterneur-grand-moyen">' : '') . '
            ' . ($count != 1 ? '<hr>' : '') . '
            <h3 class="text-center">' . $event['titre'] . '</h3>
            <h5>📅&emsp;' . preg_replace('/ [^ ]*$/', '', genererDate($event['date'])) . $nbJoursStr . '</h5>
            <h5>⌚️&emsp;' . substr($event['heure'], 0, 2) . 'h' . substr($event['heure'], 3, 2) . '</h5>
            <h5>📍&emsp;' . $event['lieu'] . '</h5>
            <a class="btn btn-var btn-block" href="/events/?id=' . $event['id'] . '">
                <h4>Détails</h4>
            </a>
            ' . ($count == 3 ? '</div>' : '') . '
            ';
    }
    $events =
        '
        <div class="well">
            ' . ($events == '' ? '<p>Oups ! On dirait qu\'il n\'y a aucun événement de prévu dans le futur 🙈</p>' : $events) . '
        </div>
        ';
    define('EVENTS', $events);

    # Journal
    $journaux ='';
    foreach ($GLOBALS['retoursModele']['journaux'] as $journal) {
        $journaux .=
            '
            <div class="col-sm-6">
                <div class="well">
                    <h3>' . $journal['titre'] . '</h3>
                    <h5>' . preg_replace('/^[^ ]* /', '', genererDate($journal['date'])) . '</h5>
                    <a href="/journaux/' . $journal['pdf'] . '" class="btn btn-var btn-block">
                        <h4 class="alterneur-grand-tres-petit"><img src="/-images/imgPdf.svg" height="28" alt="(PDF)">&emsp;Lire en ligne</h4>
                        <h4 class="alterneur-petit">Lire</h4>
                    </a>
                </div>
            </div>
            ';
    }
    define('JOURNAUX', $journaux);

    afficherPage('Accueil', 'accueil.php', 'accueil');
}

########################################################################################################################
# B - Association (Présentation)                                                                                       #
########################################################################################################################
function afficherPresentation() {
    afficherPage('Présentation', 'presentation.php', 'public');
}

########################################################################################################################
# B - Association - Contact                                                                                            #
########################################################################################################################
function afficherContact() {
    afficherPage('Contact', 'contact.php', 'public');
}

########################################################################################################################
# B - Association - Fonctionnement                                                                                     #
########################################################################################################################
function afficherFonctionnement() {
    afficherPage('Fonctionnement de l\'association', 'fonctionnement.php', 'public');
}

########################################################################################################################
# B - Association - Fonctionnement - Statuts                                                                           #
########################################################################################################################
function afficherStatuts() {
    afficherPage('Statuts', 'statuts.php', 'public');
}

########################################################################################################################
# B - Association - Historique                                                                                         #
########################################################################################################################
function afficherHistorique() {
    afficherPage('Historique de l\'association', 'historique.php', 'public');
}

########################################################################################################################
# B - Association - Où nous trouver ?                                                                                  #
########################################################################################################################
function afficherOuNousTrouver() {
    afficherPage('Où nous trouver ?', 'ouNousTrouver.php', 'public');
}

########################################################################################################################
# B - Association - Partenaires                                                                                        #
########################################################################################################################
function afficherPartenaires() {
    afficherPage('Partenaires', 'partenaires.php', 'public');
}

########################################################################################################################
# B - Association - Pourquoi adhérer ?                                                                                 #
########################################################################################################################
function afficherPourquoiAdherer() {
    afficherPage('Pourquoi adhérer ?', 'pourquoiAdherer.php', 'public');
}

########################################################################################################################
# B - Association - Réseau associatif                                                                                  #
########################################################################################################################
function afficherReseauAssociatif() {
    afficherPage('Réseau associatif', 'reseauAssociatif.php', 'public');
}

########################################################################################################################
# B - Association - Réseau associatif - ÔCampus                                                                        #
########################################################################################################################
function afficherOCampus() {
    afficherPage('ÔCampus', 'OCampus.php', 'public');
}

########################################################################################################################
# B - Association - Réseau associatif - FNEB                                                                           #
########################################################################################################################
function afficherFneb() {
    afficherPage('FNEB', 'fneb.php', 'public');
}

########################################################################################################################
# B - Association - Réseaus sociaux                                                                                    #
########################################################################################################################
function afficherReseauxSociaux() {
    afficherPage('Réseaux sociaux', 'reseauxSociaux.php', 'public');
}

########################################################################################################################
# B - Association - Université                                                                                         #
########################################################################################################################
function afficherUniversite() {
    afficherPage('Université d\'Orléans', 'universite.php', 'public');
}

########################################################################################################################
# B - Association - Trombinoscope                                                                                      #
########################################################################################################################
function afficherTrombinoscope() {
    afficherPage('Trombinoscope', 'trombinoscope.php', 'public');
}

########################################################################################################################
# B - Events                                                                                                           #
########################################################################################################################
function afficherEvents($tri, $aVenir, $passes, $rechercheEnCours) {
    define('TRI', $tri);
    define('RECHERCHE_EN_COURS', $rechercheEnCours ? 'true' : 'false');
    define('CHECKED_A_VENIR', $aVenir ? ' checked' : '');
    define('CHECKED_PASSES', $passes ? ' checked' : '');
    $tableEvents = '';
    $pair = true; // On commence à 0 en informatique.
    foreach ($GLOBALS['retoursModele']['events'] as $event) {
        $nbJours = round((strtotime($event['date']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
        $nbJoursStr = '';
        switch ($nbJours) {
            case 0:
                $nbJoursStr .=
                    '
                <strong>
                    <span style="color: red"> (Aujourd\'hui)</span>
                </strong>
                ';
                break;
            case 1:
                $nbJoursStr .=
                    '
                <strong>
                    <span style="color: red"> (Demain)</span>
                </strong>
                ';
                break;
            default:
                $nbJoursStr .= $nbJours > 1 ? (' (dans ' . $nbJours . ' jours)') : '';
        }
        $tableEvents .=
            '
            <div class="col-sm-6">
                <div class="well" ' . ($nbJours < 0 ? ' style="background-color: #d1d2ce"' : '') . '>
                    <h3>' . $event['titre'] . '</h3>
                    <h4>📅 ' . genererDate($event['date']) . $nbJoursStr . '</h4>
                    <h4>⌚️ ' . substr($event['heure'], 0, 2) . 'h' . substr($event['heure'], 3, 2) . '</h4>
                    <h4>📍️ ' . $event['lieu'] . '</h4>
                    <a class="btn btn-var btn-block" href="/events/?id=' . $event['id'] . '">
                        <h4>Détails</h4>
                    </a>
                </div>
            </div>
            ';
        $tableEvents .= $pair ? '<div class="row">' : '</div>';
        $pair = $pair ? false : true;
    }
    $tableEvents .= $pair ? '' : '</div>'; // Si c'est pair il fait fermer la balise.
    $tableEvents =
        $tableEvents == '' ?
            '<h3>Hmmm... On dirait qu\'il n\'y a aucun événement qui correspond à vos critères de recherches 🤔</h3>' :
            $tableEvents;
    define('EVENTS', $tableEvents);

    afficherPage('Événements', 'events.php', 'public');
}

function afficherEventPrecis() {
    $nbJours = round((strtotime($GLOBALS['retoursModele']['event']['date']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
    if ($nbJours == 0) {
        $nbJoursStr = '<strong><span style="color: red">(Aujourd\'hui)</span></strong>';
    } elseif ($nbJours == 1) {
        $nbJoursStr = '<strong><span style="color: red">(Demain)</span></strong>';
    } elseif ($nbJours > 0) {
        $nbJoursStr = '(dans ' . $nbJours . ' jours)';
    } else {
        $nbJoursStr = '<i><span style="color: darkgray">(Il y a ' . abs($nbJours) . ' jours)</span></i>';
    }
    define('ID', $GLOBALS['retoursModele']['event']['id']);
    define('TITRE', $GLOBALS['retoursModele']['event']['titre']);
    define('DATE', genererDate($GLOBALS['retoursModele']['event']['date']));
    define('NB_JOURS', $nbJoursStr);
    define('HEURE', substr($GLOBALS['retoursModele']['event']['heure'], 0, 2) . 'h' . substr($GLOBALS['retoursModele']['event']['heure'], 3, 2));
    define('LIEU', $GLOBALS['retoursModele']['event']['lieu']);
    define('DESC', nl2br($GLOBALS['retoursModele']['event']['description']));

    afficherPage($GLOBALS['retoursModele']['event']['titre'], 'eventPrecis.php', 'public');
}

########################################################################################################################
# B - Goodies                                                                                                          #
########################################################################################################################
function afficherGoodies($tri, $disponible, $bientot, $rupture, $rechercheEnCours) {
    define('TRI', $tri);
    define('RECHERCHE_EN_COURS', $rechercheEnCours ? 'true' : 'false');
    define('CHECKED_DISPONIBLE', $disponible ? ' checked' : '');
    define('CHECKED_BIENTOT', $bientot ? ' checked' : '');
    define('CHECKED_RUPTURE', $rupture ? ' checked' : '');
    $tableGoodies = '';
    foreach ($GLOBALS['retoursModele']['goodies'] as $goodie) {
        switch ($goodie['categorie']) {
            case 1:
                $categorieStr = '<span style="color: darkgreen">Disponible</span>';
                break;
            case 2:
                $categorieStr = '<span style="color: darkblue">Bientôt disponible</span>';
                break;
            case 3:
                $categorieStr = '<span style="color: darkred">En rupture de stock</span>';
                break;
            default:
                $categorieStr = '<span style="color: red">Une erreur s\'est produite.</span>';
                break;
        }
        $tableGoodies .=
            '
            <div class="col-sm-6">
                <div class="well">
                    <a href="/goodies/?id=' . $goodie['id'] . '">
                        <img src="/goodies/' . $goodie['miniature'] . '" class="img-arrondi-mini" alt="Miniature">
                    </a>
                    <h3>' . $goodie['titre'] . '</h3>
                    <hr>
                    <h4><strong>' . $categorieStr . '</strong></h4>
                    <h4>Prix pour les adhérents : ' . $goodie['prixAD'] . '€</h4>
                    <h4>Prix pour les non-adhérents : ' . $goodie['prixNAD'] . '€</h4>
                    <a class="btn btn-var btn-block" href="/goodies/?id=' . $goodie['id'] . '">
                        <h4>Détails</h4>
                    </a>
                </div>
            </div>
            ';
    }
    if (empty($lignesGoodies)) {
        $tableGoodies .=
            $tableGoodies == '' ?
                '<h3>Hmmm... On dirait qu\'il n\'y a aucun goodie qui correspond à vos critères de recherches 🤔</h3>' :
                '';
    }
    define('GOODIES', $tableGoodies);

    afficherPage('Goodies', 'goodies.php', 'public');
}

function afficherGoodiePrecis() {
    define('TITRE', $GLOBALS['retoursModele']['goodie']['titre']);
    define('PRIX_AD', $GLOBALS['retoursModele']['goodie']['prixAD']);
    define('PRIX_NAD', $GLOBALS['retoursModele']['goodie']['prixNAD']);
    define('DESC', nl2br($GLOBALS['retoursModele']['goodie']['description']));
    define('ID', $GLOBALS['retoursModele']['goodie']['id']);
    if (empty($GLOBALS['retoursModele']['imagesGoodie'])) {
        $carouselGoodie =
            '
            <img
                    src="/goodies/' . $GLOBALS['retoursModele']['goodie']['miniature'] . '"
                    class="img-arrondi ombre"
                    alt="Image"
            >
            ';
    } else {
        $nb = 0;
        # Image miniature
        $carouselGoodieIndicator =
            '
            <li data-target="#carouselGoodie" data-slide-to="' . $nb++ . '" class="active">
            </li>
            ';
        $carouselGoodieImages =
            '
            <div class="item active">
                <img
                        class="arrondi"
                        src="/goodies/' . $GLOBALS['retoursModele']['goodie']['miniature'] . '"
                        alt="Image"
                >
            </div>
            ';

        # Le reste des -images
        foreach ($GLOBALS['retoursModele']['imagesGoodie'] as $image) {
            $carouselGoodieIndicator .=
                '
                <li data-target="#carouselGoodie" data-slide-to="' . $nb++ . '">
                </li>
                ';
            $carouselGoodieImages .=
                '
                <div class="item">
                    <img
                            class="arrondi"
                            src="/goodies/' . $image['lien'] . '"
                            alt="Image"
                    >
                </div>
                ';
        }
        $carouselGoodieIndicator = '<ol class="carousel-indicators">' . $carouselGoodieIndicator . '</ol>';
        $carouselGoodieImages = '<div class="carousel-inner" role="listbox">' . $carouselGoodieImages . '</div>';

        $carouselGoodie =
            '
            <div id="carouselGoodie" class="carousel carousel-images slide arrondi ombre" data-ride="carousel">
                ' .$carouselGoodieIndicator . '
                ' . $carouselGoodieImages . '
                <a class="left carousel-control" href="#carouselGoodie" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carouselGoodie" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            ';
    }
    define('CAROUSEL_GOODIES', $carouselGoodie);

    afficherPage($GLOBALS['retoursModele']['goodie']['titre'], 'goodiePrecis.php', 'public');
}

########################################################################################################################
# B - Journaux                                                                                                         #
########################################################################################################################
function afficherJournaux() {
    $tableJournaux = '';
    $count = 0;
    foreach ($GLOBALS['retoursModele']['journaux'] as $journal) {
        $tableJournaux .=
            '
            ' . ($count != 0 && $count % 4 == 0 ? '<div class="row">' : '') . '
            <div class="col-sm-3">
                <div class="well">
                    <h3>' . $journal['titre'] . '</h3>
                    <h5>' . preg_replace('/^[^ ]* /', '', genererDate($journal['date'])) . '</h5>
                    <a href="' . $journal['pdf'] . '" class="btn btn-var btn-block">
                        <h4 class="alterneur-grand-tres-petit"><img src="/-images/imgPdf.svg" height="28" alt="(PDF)">&emsp;Lire en ligne</h4>
                        <h4 class="alterneur-petit">Lire</h4>
                    </a>
                </div>
            </div>
            ' . ($count != count($GLOBALS['retoursModele']['journaux']) - 1 && ($count + 1) % 4 == 0 ? '</div>' : '') . '
            ';
        $count++;
    }
    $tableJournaux = '<div class="row">' . $tableJournaux . '</div>';
    define('JOURNAUX', $tableJournaux);

    afficherPage('Journaux', 'journaux.php', 'public');
}

########################################################################################################################
# B - Liens                                                                                                            #
########################################################################################################################
function afficherLiens() {
    $liens = '';
    foreach ($GLOBALS['retoursModele']['liensPratiques'] as $lien) {
        $liens .=
            '
            <a
                        class="btn btn-var btn-block btn-wrap-text"
                        href="' . $lien['url'] . '"
                >
                    ' . $lien['titre'] . '
                </a>
            ';
    }
    define('LIENS', $liens);

    afficherPage('Liens', 'liens.php', 'liens');
}

########################################################################################################################
# B - Mentions légales                                                                                                 #
########################################################################################################################
function afficherMentionsLegales() {
    afficherPage('Mentions légales', 'mentionsLegales.php', 'public');
}

########################################################################################################################
# B - Parrainage                                                                                                       #
########################################################################################################################
function afficherParrainage() {
    afficherPage('Parrainage', 'parrainage.php', 'public');
}

function afficherParrainageRecherche() {
    define('NB_MEMBRES', 2 + ($GLOBALS['retoursModele']['parrainage']['p2nom'] == 'nil' ? 0 : 1));
    for ($i = 0; $i < 3; $i++) {
        define('NOM' . $i, $GLOBALS['retoursModele']['parrainage']['p' . $i . 'nom']);
        define('EMAIL' . $i, $GLOBALS['retoursModele']['parrainage']['p' . $i . 'email']);
        define('TYPE' . $i, $GLOBALS['retoursModele']['parrainage']['p' . $i . 'parrain'] == 1 ? 'Parrain/Marraine' : 'Fillot/Fillote');
    }
    define('GROUPE', $GLOBALS['retoursModele']['parrainage']['groupe']);
    afficherPage("Parrainage", 'parrainageRecherche.php', 'public');
}

########################################################################################################################
# B - Plan du site                                                                                                     #
########################################################################################################################
function afficherPlanDuSite() {
    function allerChercherString($a) {
        if (gettype($a) == 'string') {
            return $a;
        }
        return allerChercherString($a[0]);
    }
    function trierEnfants($e1, $e2) {
        return strcmp(
            preg_replace(
                '/index.php\//',
                '',
                allerChercherString($e1)
            ),
            preg_replace(
                '/index.php\//',
                '',
                allerChercherString($e2)
            )
        );
    }
    function chercherTousLesEnfants($cheminParent) {
        if (!@is_dir($cheminParent)) { // Attention !!!!!!!! On cache les warning (@) :
            // On va chercher le type de tous les fichiers, mais le serveur http indique qu'on a pas le droit de les
            // toucher. Mais c'est good car on a juste besoin de leur type (fichier ou répertoire).
            return $cheminParent;
        }
        $enfants = array_diff(scandir($cheminParent), ['.', '..']);
        if ($enfants == NULL) {
            return $cheminParent;
        } else {
            $arrayEnfants = [];
            foreach ($enfants as $enfant) {
                $arrayEnfants[] = chercherTousLesEnfants($cheminParent . $enfant . '/');
            }
            usort($arrayEnfants, "trierEnfants");
            return $arrayEnfants;
        }
    }
    function construireListe($array) {
        if (gettype($array) == 'string') {
            $chemin = explode('/', $array);
            $cheminInverse = array_reverse($chemin);
            while (count($chemin) != 0 && $chemin[0] != 'www') {
                array_shift($chemin);
            }
            array_shift($chemin); // www.
            $lien = implode('/', array_diff($chemin, ['index.php', '']));
            if ($cheminInverse[1] == 'index.php') {
                if ($cheminInverse[2] == 'www') {
                    return '<a href="/' . $lien . '" class="list-group-item list-group-item-danger">' . 'accueil' . '</a>';
                }
                return '<a href="/' . $lien . '" class="list-group-item list-group-item-danger">' . $cheminInverse[2] . '</a>';
            }
            return '';
        } else {
            $str = '<div class="list-group-item"><div class="list-group">';
            foreach ($array as $value) {
                $str .= construireListe($value);
            }
            $str .= '</div></div>';
            return $str;
        }
    }
    function optimiserListe($liste) {
        $oldListe = '';
        while ($oldListe != $liste) {
            $oldListe = $liste;
            $liste = preg_replace('/<div class="list-group-item"><\/div>/', '', $liste);
            $liste = preg_replace('/<div class="list-group"><\/div>/', '', $liste);
        }
        return $liste;
    }
    function retirerDivEnglobant($liste) {
        $liste = preg_replace('/^<div class="list-group-item">/', '', $liste);
        $liste = preg_replace('/<\/div>$/', '', $liste);
        return $liste;
    }
    $plan = retirerDivEnglobant(optimiserListe(construireListe(chercherTousLesEnfants(racine()))));
    define('PLAN', $plan);

    afficherPage('Plan du site', 'planDuSite.php', 'public');
}

########################################################################################################################
# B - Trouver une salle                                                                                                #
########################################################################################################################
function afficherTrouverUneSalle() {
    afficherPage('Trouver une salle', 'trouverUneSalle.php', 'public');
}

function afficherTrouverUneSalleRecherche() {
    define('NOMBRE', count($GLOBALS['retoursModele']['salles']));
    if (NOMBRE > 1) {
        $listeSalles = '';
        foreach ($GLOBALS['retoursModele']['salles'] as $salle) {
            $listeSalles .=
                '
                <div class="well">
                    <h4>' . $salle['nom'] . '</h4>
                    <p>Composante : ' . $salle['titreComposante'] . '</p>
                    <p>Bâtiment : ' . $salle['nomBatiment'] . '</p>
                    <p>Emplacement : ' . $salle['nomGroupe'] . '</p>
                    <p>
                        <a
                            href="/trouver-une-salle/?nom=' . preg_replace('/ /', '+', $salle['nom']) . '"
                        >
                            Voir le bâtiment sur le plan
                        </a>
                    </p>
                </div>
                ';
        }
    } else {
        $listeSalles =
            '
            <div class="well">
                <h4>' . $GLOBALS['retoursModele']['salles'][0]['nom'] . '</h4>
                <p>Composante : ' . $GLOBALS['retoursModele']['salles'][0]['titreComposante'] . '</p>
                <p>Bâtiment : ' . $GLOBALS['retoursModele']['salles'][0]['nomBatiment'] . '</p>
                <p>Emplacement : ' . $GLOBALS['retoursModele']['salles'][0]['nomGroupe'] . '</p>
            </div>
            ';
    }
    define('SALLES', $listeSalles);
    define('CODE_COMPOSANTE', $GLOBALS['retoursModele']['salles'][0]['codeComposante']);
    define('ID_BATIMENT', $GLOBALS['retoursModele']['salles'][0]['idBatiment']);

    afficherPage('Trouver une salle', 'trouverUneSalleRecherche.php', 'public');
}
