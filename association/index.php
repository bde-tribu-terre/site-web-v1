<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlPresentation();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
