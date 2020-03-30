<?php
define("SERVEUR", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("BDD", "tribu-terre");

function getConnect() {
    $connexion = new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8MB4'); // UTF8mb4 : Pour pouvoir encoder des émojis
    return $connexion;
}
