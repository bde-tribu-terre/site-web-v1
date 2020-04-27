<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlReseauxSociaux();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
