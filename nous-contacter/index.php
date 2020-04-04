<?php
$prefixe = '../';
require_once($prefixe . '-mvc-public/controleur/controleur.php');
try {
    CtlNousContacter($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}