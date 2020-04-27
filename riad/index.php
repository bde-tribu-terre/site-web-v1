<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlRiad();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}