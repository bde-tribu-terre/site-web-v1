<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlPlanDuSite();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}