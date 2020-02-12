<?php
$prefixe = './';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlQuiSommesNous($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}