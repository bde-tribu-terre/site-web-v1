<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
if (isset($_POST['formInscription_inscription'])) {
    CtlInscription(true);
} else {
    CtlInscription(false);
}