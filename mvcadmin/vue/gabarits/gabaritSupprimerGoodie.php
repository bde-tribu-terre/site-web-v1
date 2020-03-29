<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Supprimer un goodie.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>SUPPRIMER UN GOODIE</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formSupprimerGoodie_fieldset">
            <h3>Supprimer un goodie</h3>
            <form id="formSupprimerGoodie" action="admin" method="post">
                <p> <!-- Goodie en question -->
                    <label for="formSupprimerGoodie_idGoodie">Goodie :</label>
                    <select id="formSupprimerGoodie_idGoodie" name="formSupprimerGoodie_idGoodie">
                        <option value="">--Choisir un goodie--</option>
                        <?php echo $goodies ?>
                    </select>
                </p>
                <p>⚠️ Cette action est irréversible ! ⚠️</p>
                <p> <!-- Supprimer goodie -->
                    <input type="submit" value="Supprimer le goodie" name="formSupprimerGoodie_supprimer">
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