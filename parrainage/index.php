<?php
const RACINE = '../';
require_once(RACINE . '-mvc/controleur/controleur.php');
if (
    $form['_name'] == 'formRechercherMail' &&
    $form['_submit'] == 'rechercher'
) {
    CtlParrainageReponse($form['mail']);
} else {
    CtlParrainage();
}
