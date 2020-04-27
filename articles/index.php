<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    if (isset($_GET['id'])) {
        CtlArticlePrecis($_GET['id']);
    } else {
        CtlArticles();
    }
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}
