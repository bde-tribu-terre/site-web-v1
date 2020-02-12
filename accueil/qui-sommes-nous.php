<?php
require_once('./controleur/controleur.php');
try {
    CtlQuiSommesNous();
} catch (Exception $e) {
    CtlErreur($e->getMessage());
}