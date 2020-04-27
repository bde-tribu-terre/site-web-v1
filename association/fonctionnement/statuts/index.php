<?php
define('RACINE', '../../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlStatuts();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
