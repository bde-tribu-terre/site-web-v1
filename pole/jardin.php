<?php
$prefixe = '../';
require_once($prefixe . 'mvcpublic/controleur/controleur.php');
try {
    CtlPoleJardin($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}