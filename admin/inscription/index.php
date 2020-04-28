<?php
$salt = '';
for ($i = 0; $i <= 32; $i++) {
    $salt .= chr(rand(33, 126));
}
echo $salt;
echo '<br>';
echo strlen($salt);
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
try {
    if (isset($_POST['formInscription_inscription'])) {
        CtlSInscrire(
            $_POST['formInscription_cleInscription'],
            $_POST['formInscription_prenom'],
            $_POST['formInscription_nom'],
            $_POST['formInscription_login'],
            $_POST['formInscription_mdp']
        );
    } else {
        CtlInscription('');
    }
} catch (Exception $e) {
    CtlInscription($e->getMessage());
}