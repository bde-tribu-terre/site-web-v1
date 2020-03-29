<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Modifier un évent.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>MODIFIER UN ÉVENT</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formModifierEvent_fieldset">
            <h3>Modifier un évent</h3>
            <form id="formModifierEvent" action="admin" method="post">
                <p> <!-- ID de l'évent -->
                    <label for="formModifierEvent_idEvent">ID du goodie :</label>
                    <input id="formModifierEvent_idEvent" type="text" value="<?php echo $idEvents ?>" placeholder="Titre du goodie" name="formModifierEvent_idEvent" readonly>
                </p>
                <p> <!-- Titre de l'évent -->
                    <label for="formModifierEvent_titre">Titre de l'évent :</label>
                    <input id="formModifierEvent_titre" type="text" value="<?php echo $titreEvents ?>" placeholder="Titre de l'évent" name="formModifierEvent_titre">
                </p>
                <p> <!-- Date -->
                    <label for="formModifierEvent_date">Catégorie :</label>
                    <input id="formModifierEvent_date" type="date" value="<?php echo $dateEvents ?>" name="formModifierEvent_date">
                </p>
                <p> <!-- Heure -->
                    <label for="formModifierEvent_heureHeure">Heure :</label>
                    <input id="formModifierEvent_heureHeure" type="number" value="<?php echo $heure ?>" min="0" max="23" name="formModifierEvent_heureHeure">h
                    <input id="formModifierEvent_heureMinute" type="number" value="<?php echo $minute ?>" min="0" max="59" name="formModifierEvent_heureMinute">
                </p>
                <p> <!-- Lieu -->
                    <label for="formModifierEvent_lieu">Lieu :</label>
                    <input id="formModifierEvent_lieu" type="text" value="<?php echo $lieuEvents ?>" name="formModifierEvent_lieu">
                </p>
                <p> <!-- Description de l'évent -->
                    <label for="formModifierEvent_desc">Description du goodie :</label>
                    <textarea id="formModifierEvent_desc" placeholder="Description de l'évent" name="formModifierEvent_desc"><?php echo $descEvents ?></textarea>
                </p>
                <p>⚠️ Pour modifier la miniature il faut recréer le goodie. Désolé ! ⚠️</p>
                <p> <!-- Modifier Évent -->
                    <input type="submit" value="Modifier l'évent" name="formModifierEvent_modifierEvent">
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