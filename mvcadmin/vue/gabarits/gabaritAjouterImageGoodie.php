<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Ajouter une image à un goodie.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>AJOUTER UNE IMAGE À UN GOODIE</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formAjouterImageGoodie_fieldset">
            <h3>Ajouter une image à un goodie</h3>
            <form id="formAjouterImageGoodie" method="post" enctype="multipart/form-data">
                <p> <!-- Goodie en question -->
                    <label for="formAjouterImageGoodie_idGoodie">Goodie :</label>
                    <select id="formAjouterImageGoodie_idGoodie" name="formAjouterImageGoodie_idGoodie">
                        <option value="">--Choisir un goodie--</option>
                        <?php echo $goodies ?>
                    </select>
                </p>
                <p> <!-- Image -->
                    <label for="formAjouterImageGoodie_image">Sélectionner l'image (⚠️  format 4:3 pour ne pas que ça soit deg) :</label>
                    <input type="file" name="formAjouterImageGoodie_image" accept="image/*">
                </p>
                <p>⚠️ La miniature compte déjà comme une image. Attention aux doublons ! ⚠️</p>
                <p> <!-- Ajouter Goodie -->
                    <input type="submit" value="Ajouter l'image" name="formAjouterImageGoodie_ajouter">
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