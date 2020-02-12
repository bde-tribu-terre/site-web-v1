<?php
$prefixe = '../';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlPoleCulture($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}