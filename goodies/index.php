<?php
$prefixe = '../';
require_once($prefixe . 'mvcpublic/controleur/controleur.php');
try {
    if (isset($_GET['id'])) {
        CtlGoodiePrecis($prefixe, $_GET['id']);
    } else {
        CtlGoodies($prefixe);
    }
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}
