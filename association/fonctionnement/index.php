<?php
$prefixe = '../../';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    CtlFonctionnement($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}
