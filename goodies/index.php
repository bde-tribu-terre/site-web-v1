<?php
const RACINE = '../';
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_GET['id'])) {
    CtlGoodiePrecis($_GET['id']);
} else {
    $tri = '';
    $disponible = true;
    $bientot = true;
    $rupture = false;
    $rechercheEnCours = false;
    if (isset($_GET['tri'])) {
        $tri = $_GET['tri'];
        $rechercheEnCours = true;
    }
    if (isset($_GET['disponible']) && $_GET['disponible'] == 'off') {
        $disponible = false;
        $rechercheEnCours = true;
    }
    if (isset($_GET['bientot']) && $_GET['bientot'] == 'off') {
        $bientot = false;
        $rechercheEnCours = true;
    }
    if (isset($_GET['rupture']) && $_GET['rupture'] == 'on') {
        $rupture = true;
        $rechercheEnCours = true;
    }
    CtlGoodies($tri, $disponible, $bientot, $rupture, $rechercheEnCours);
}
