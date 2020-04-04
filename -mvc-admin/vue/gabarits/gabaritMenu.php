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
            <form id="formEvents" method="post">
                <p> <!-- Créer un évent -->
                    <input type="submit" value="Créer un évent" name="formEvents_creerEventMenu">
                </p>
                <p> <!-- Modifier un évent -->
                    <input type="submit" value="Modifier un évent" name="formEvents_modifierEventMenu">
                </p>
                <p> <!-- Supprimer un évent -->
                    <input type="submit" value="Supprimer un évent" name="formEvents_supprimerEventMenu">
                </p>
            </form>
        </fieldset>
        <fieldset id="formGoodies_fieldset">
            <h3>Goodies</h3>
            <form id="formGoodies" method="post">
                <p> <!-- Ajouter un goodie -->
                    <input type="submit" value="Ajouter un goodie" name="formGoodies_ajouterGoodieMenu">
                </p>
                <p> <!-- Ajouter une image à un goodie -->
                    <input type="submit" value="Ajouter une image à un goodie" name="formGoodies_ajouterImageGoodieMenu">
                </p>
                <p> <!-- Modifier un goodie -->
                    <input type="submit" value="Modifier un goodie" name="formGoodies_ModifierGoodieMenu">
                </p>
                <p> <!-- Supprimer un goodie -->
                    <input type="submit" value="Supprimer un goodie" name="formGoodies_SupprimerGoodieMenu">
                </p>
            </form>
        </fieldset>
        <fieldset id="formJournal_fieldset">
            <h3>Journal</h3>
            <form id="formJournal" method="post">
                <p> <!-- Ajouter un journal -->
                    <input type="submit" value="Ajouter un journal" name="formJournal_ajouterJournalMenu">
                </p>
                <p> <!-- Supprimer un journal -->
                    <input type="submit" value="Supprimer un journal" name="formJournal_supprimerJournalMenu">
                </p>
            </form>
        </fieldset>
        <fieldset id="formMonCompte_fieldset" style="display: none">
            <h3>Mon compte</h3>
            <form id="formMonCompte" method="post">
                <p> <!-- Paramètres de mon compte -->
                    <input type="submit" value="Paramètres de mon compte" name="formMonCompte_parametres" disabled>
                </p>
            </form>
        </fieldset>
        <fieldset id="formDeconnexion_fieldset">
            <h3>Se déconnecter</h3>
            <form id="formDeconnexion" method="post">
                <p> <!-- Se déconnecter -->
                    <input type="submit" value="Se déconnecter" name="formDeconnexion_deconnexion">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>