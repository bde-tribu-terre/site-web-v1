<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlJournaux();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
