<?php
$prefixe = './';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    CtlAccueil($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}