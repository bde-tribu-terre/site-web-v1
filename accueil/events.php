<?php
$prefixe = './';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlEvents($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}