<?php
$prefixe = '../';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlPoleCommunication($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}