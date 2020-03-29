<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Supprimer des images d'un goodie.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>SUPPRIMER DES IMAGES D'UN GOODIE</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formSupprimerImageGoodie_fieldset">
            <h3>Supprimer des images d'un goodie</h3>
            <form id="formSupprimerImageGoodie" action="admin" method="post">formSupprimerImageGoodie_idGoodie
                <p> <!-- ID du goodie -->
                    <label for="formSupprimerImageGoodie_idGoodie">ID du goodie :</label>
                    <input id="formSupprimerImageGoodie_idGoodie" type="text" value="<?php echo $idGoodie ?>" placeholder="Titre du goodie" name="formSupprimerImageGoodie_idGoodie" readonly>
                </p>
                <?php echo $images ?>
                <p> <!-- Supprimer les images -->
                    <input type="submit" value="Supprimer les images" name="formSupprimerImageGoodie_supprimer">
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