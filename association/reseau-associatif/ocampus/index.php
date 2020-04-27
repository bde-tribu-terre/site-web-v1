<?php
define('RACINE', '../../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlOCampus();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
