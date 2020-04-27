<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    if (isset($_GET['id'])) {
        CtlEventPrecis($_GET['id']);
    } else {
        $tri = 'FP';
        $aVenir = true;
        $passes = false;
        $rechercheEnCours = false;
        if (isset($_GET['tri'])) {
            $tri = $_GET['tri'];
            $rechercheEnCours = true;
        }
        if (isset($_GET['aVenir']) && $_GET['aVenir'] == 'off') {
            $aVenir = false;
            $rechercheEnCours = true;
        }
        if (isset($_GET['passes']) && $_GET['passes'] == 'on') {
            $passes = true;
            $rechercheEnCours = true;
        }
        CtlEvents($tri, $aVenir, $passes, $rechercheEnCours);
    }
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}