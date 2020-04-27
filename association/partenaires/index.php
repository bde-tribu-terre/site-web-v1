<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlPartenaires();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
