<?php
$prefixe = './';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlAccueil($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}