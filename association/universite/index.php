<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlUniversite();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
