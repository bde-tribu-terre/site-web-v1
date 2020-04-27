<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlHistorique();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
