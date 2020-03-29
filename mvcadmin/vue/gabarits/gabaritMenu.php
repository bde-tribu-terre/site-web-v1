<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Menu administrateur</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>MENU ADMINISTRATEUR</h1>
    <h2>Bienvenue <?php echo $nomMembre ?> ! 😊</h2>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formEvents_fieldset">
            <h3>Events</h3>
            <form id="formEvents" action="admin" method="post">
                <p> <!-- Créer un évent -->
                    <input type="submit" value="Créer un évent" name="formEvents_creerEvent" disabled>
                </p>
                <p> <!-- Modifier un évent -->
                    <input type="submit" value="Modifier un évent" name="formEvents_modifierEvent" disabled>
                </p>
            </form>
        </fieldset>
        <fieldset id="formJournal_fieldset">
            <h3>Journal</h3>
            <form id="formJournal" action="admin" method="post">
                <p> <!-- Ajouter un journal -->
                    <input type="submit" value="Ajouter un journal" name="formJournal_ajouterJournal">
                </p>
                <p> <!-- Supprimer un journal -->
                    <input type="submit" value="Supprimer un journal" name="formJournal_supprimerJournal" disabled>
                </p>
            </form>
        </fieldset>
        <fieldset id="formMonCompte_fieldset">
            <h3>Mon compte</h3>
            <form id="formMonCompte" action="admin" method="post">
                <p> <!-- Paramètres de mon compte -->
                    <input type="submit" value="Paramètres de mon compte" name="formMonCompte_parametres">
                </p>
            </form>
        </fieldset>
        <fieldset id="formDeconnexion_fieldset">
            <h3>Se déconnecter</h3>
            <form id="formDeconnexion" action="admin" method="post">
                <p> <!-- Se déconnecter -->
                    <input type="submit" value="Se déconnecter" name="formDeconnexion_deconnexion">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>