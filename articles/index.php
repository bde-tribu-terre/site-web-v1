<?php
$prefixe = '../';
require_once($prefixe . '-mvc/controleur/controleur.php');
try {
    if (isset($_GET['id'])) {
        CtlArticlePrecis($prefixe, $_GET['id']);
    } else {
        CtlArticles($prefixe);
    }
} catch (Exception $e) {
    CtlErreur($prefixe, $e->getMessage());
}
