<?php
$prefixe = '../';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    CtlPlanDuSite($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}