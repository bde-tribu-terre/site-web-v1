<?php
define('RACINE', '../../');
require_once(RACINE . '-mvc/controleur/controleur.php');
if (
    $form['_name'] == 'formInscription' &&
    $form['_submit'] == 'inscription'
) {
    CtlInscriptionExecuter(
        $form['cleInscription'],
        $form['prenom'],
        $form['nom'],
        $form['login'],
        $form['mdp']
    );
} else {
    CtlInscription();
}
