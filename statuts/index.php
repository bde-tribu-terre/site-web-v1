<?php
$prefixe = '../';
require_once($prefixe . '-mvc-public/controleur/controleur.php');
try {
    CtlStatuts($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}
