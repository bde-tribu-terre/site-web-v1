<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Choisir un goodie à modifier.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>CHOISIR UN GOODIE À MODIFIER</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formChoisirGoodie_fieldset">
            <h3>Choisir un goodie à modifier</h3>
            <form id="formChoisirGoodie" action="admin.php" method="post">
                <p> <!-- Goodie en question -->
                    <label for="formChoisirGoodie_idGoodie">Goodie :</label>
                    <select id="formChoisirGoodie_idGoodie" name="formChoisirGoodie_idGoodie">
                        <option value="">--Choisir un goodie--</option>
                        <?php echo $goodies ?>
                    </select>
                </p>
                <p> <!-- Choisir Goodie -->
                    <input type="submit" value="Choisir le goodie" name="formChoisirGoodie_choisir">
                </p>
            </form>
        </fieldset>
        <fieldset id="formRetourMenu_fieldset">
            <h3>Retour au menu</h3>
            <form id="formRetourMenu" action="admin.php" method="post">
                <p> <!-- Retour au menu -->
                    <input type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>