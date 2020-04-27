<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    CtlOuNousTrouver();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
