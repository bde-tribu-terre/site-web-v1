<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Supprimer un journal.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>SUPPRIMER UN JOURNAL</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formSupprimerJournal_fieldset">
            <h3>Supprimer un journal</h3>
            <form id="formSupprimerJournal" action="admin" method="post">
                <p> <!-- Journal en question -->
                    <label for="formSupprimerJournal_idJournal">Goodie :</label>
                    <select id="formSupprimerJournal_idJournal" name="formSupprimerJournal_idJournal">
                        <option value="">--Choisir un journal--</option>
                        <?php echo $journaux ?>
                    </select>
                </p>
                <p>⚠️ Cette action est irréversible ! ⚠️</p>
                <p> <!-- Supprimer journal -->
                    <input type="submit" value="Supprimer le journal" name="formSupprimerJournal_supprimer">
                </p>
            </form>
        </fieldset>
        <fieldset id="formRetourMenu_fieldset">
            <h3>Retour au menu</h3>
            <form id="formRetourMenu" action="admin" method="post">
                <p> <!-- Retour au menu -->
                    <input type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>