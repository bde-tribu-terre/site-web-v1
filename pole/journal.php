<?php
$prefixe = '../';
require_once($prefixe . 'mvcpublic/controleur/controleur.php');
try {
    CtlPoleJournal($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}