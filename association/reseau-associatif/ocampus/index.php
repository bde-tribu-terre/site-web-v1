<?php
$prefixe = '../../../';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    CtlOCampus($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}
