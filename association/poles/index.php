<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlPoles();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
