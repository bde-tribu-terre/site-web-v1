<?php
$prefixe = '../';
require_once($prefixe . 'mvcpublic/controleur/controleur.php');
try {
    if (isset($_GET['id'])) {
        CtlEventPrecis($prefixe, $_GET['id']);
    } else {
        CtlEvents($prefixe);
    }
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}