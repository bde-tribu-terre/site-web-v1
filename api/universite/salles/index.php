<?php
const RACINE = '../../../';
require_once(RACINE . '-mvc/controleur/controleur.php');
CtlApiUniversiteSalles($_GET['id'] ?? '');
