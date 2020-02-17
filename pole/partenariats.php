<?php
$prefixe = '../';
require_once($prefixe . 'mvcpublic/controleur/controleur.php');
try {
    CtlPolePartenariats($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}