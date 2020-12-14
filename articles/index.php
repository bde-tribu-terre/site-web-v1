<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_GET['id'])) {
    CtlArticlePrecis($_GET['id']);
} else {
    CtlArticles();
}
