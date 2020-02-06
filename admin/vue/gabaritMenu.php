<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Admin</title>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
    echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
}
?>
<fieldset>
    <h1>MENU ADMINISTRATEUR</h1>
    <h2>Bienvenue <?php echo $nomMembre ?> 😊</h2>
</fieldset>
</body>
</html>