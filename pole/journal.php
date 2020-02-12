<?php
$prefixe = '../';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlPoleJournal($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}