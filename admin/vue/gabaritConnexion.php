<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Connexion</title>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
    echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
}
?>
<fieldset id="formConnexion_fieldset">
    <!-- Connexion -->
    <legend>Connexion</legend>
    <form id="formConnexion" action="admin.php" method="post">
        <p> <!-- Identifiant -->
            <label for="formConnexion_login">Login :</label>
            <input id="formConnexion_login" type="text" name="formConnexion_login">
        </p>
        <p> <!-- Mot de passe -->
            <label for="formConnexion_mdp">Mot de passe :</label>
            <input id="formConnexion_mdp" type="password" name="formConnexion_mdp">
        </p>
        <p> <!-- Se connecter -->
            <input type="submit" value="Se connecter" name="formConnexion_seConnecter">
        </p>
    </form>
</fieldset>
</body>
</html>