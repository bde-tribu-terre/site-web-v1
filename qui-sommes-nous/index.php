<?php
$prefixe = '../';
require_once($prefixe . '-mvc-public/controleur/controleur.php');
try {
    CtlQuiSommesNous($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}