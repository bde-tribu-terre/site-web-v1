<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlPourquoiAdherer();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
