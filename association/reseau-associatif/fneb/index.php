<?php
define('RACINE', '../../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlFneb();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
