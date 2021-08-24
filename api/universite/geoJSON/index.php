<?php
const RACINE = '../../../';
require_once(RACINE . '-mvc/controleur/controleur.php');
CtlApiUniversiteGeoJson($_GET['id'] ?? '');
