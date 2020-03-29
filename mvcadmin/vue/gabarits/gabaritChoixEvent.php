<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Choisir un évent à modifier.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>CHOISIR UN ÉVENT À MODIFIER</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formChoisirEvent_fieldset">
            <h3>Choisir un évent à modifier</h3>
            <form id="formChoisirEvent" action="admin" method="post">
                <p> <!-- Évent en question -->
                    <label for="formChoisirEvent_idEvent">Évent :</label>
                    <select id="formChoisirEvent_idEvent" name="formChoisirEvent_idEvent">
                        <option value="">--Choisir un évent--</option>
                        <?php echo $events ?>
                    </select>
                </p>
                <p> <!-- Choisir Évent -->
                    <input type="submit" value="Choisir le goodie" name="formChoisirEvent_choisir">
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