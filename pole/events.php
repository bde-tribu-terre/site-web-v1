<?php
$prefixe = '../';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlPoleEvents($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}