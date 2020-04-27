<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlFonctionnement();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
