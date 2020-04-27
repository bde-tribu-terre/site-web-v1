<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlContact();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
