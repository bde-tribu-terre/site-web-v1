<?php
$prefixe = '../';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    if (isset($_GET['id'])) {
        CtlEventPrecis($prefixe, $_GET['id']);
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
        CtlEvents($prefixe, $tri, $aVenir, $passes, $rechercheEnCours);
    }
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}