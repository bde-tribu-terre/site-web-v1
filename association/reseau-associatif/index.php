<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlReseauAssociatif();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
