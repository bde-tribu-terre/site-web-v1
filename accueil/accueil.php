<?php
require_once('./controleur/controleur.php');
try {
    CtlAccueil();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}