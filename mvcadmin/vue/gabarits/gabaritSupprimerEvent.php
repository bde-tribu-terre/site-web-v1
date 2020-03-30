<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Supprimer un évent.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>SUPPRIMER UN ÉVENT</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formSupprimerEvent_fieldset">
            <h3>Supprimer un évent</h3>
            <form id="formSupprimerEvent" method="post">
                <p> <!-- Évent en question -->
                    <label for="formSupprimerEvent_idEvent">Évent :</label>
                    <select id="formSupprimerEvent_idEvent" name="formSupprimerEvent_idEvent">
                        <option value="">--Choisir un évent--</option>
                        <?php echo $events ?>
                    </select>
                </p>
                <p>⚠️ Cette action est irréversible ! ⚠️</p>
                <p> <!-- Supprimer évent -->
                    <input type="submit" value="Supprimer l'évent" name="formSupprimerEvent_supprimer">
                </p>
            </form>
        </fieldset>
        <fieldset id="formRetourMenu_fieldset">
            <h3>Retour au menu</h3>
            <form id="formRetourMenu" method="post">
                <p> <!-- Retour au menu -->
                    <input type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>