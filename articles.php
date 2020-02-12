<?php
$prefixe = './';
require_once($prefixe . 'controleur/controleur.php');
try {
    CtlArticles($prefixe);
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}