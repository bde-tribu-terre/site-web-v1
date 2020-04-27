<?php
define('RACINE', './');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlAccueil();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}