<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlMentionsLegales();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}