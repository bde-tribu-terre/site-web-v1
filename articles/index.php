<?php
define('RACINE', '../');
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_GET['id'])) {
    CtlArticles($_GET['id']);
} else {
    CtlArticles();
}