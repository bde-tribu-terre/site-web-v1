<?php
$prefixe = './';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlNousContacter($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}