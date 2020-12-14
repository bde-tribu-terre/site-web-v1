<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_GET['nom'])) {
    CtlTrouverUneSalleRecherche($_GET['nom']);
} else {
    CtlTrouverUneSalle();
}
