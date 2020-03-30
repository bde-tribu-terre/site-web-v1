<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Créer un évent.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>CRÉER UN ÉVENT</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formCreerEvent_fieldset">
            <h3>Ajouter un évent</h3>
            <form id="formCreerEvent" action="admin.php" method="post">
                <p> <!-- Titre de l'évent -->
                    <label for="formCreerEvent_titre">Titre de l'évent :</label>
                    <input id="formCreerEvent_titre" type="text" placeholder="Titre de l'évent" name="formCreerEvent_titre">
                </p>
                <p> <!-- Date -->
                    <label for="formCreerEvent_date">Date (format "jj/mm/aaaa") :</label>
                    <input id="formCreerEvent_date" type="date" name="formCreerEvent_date">
                </p>
                <p> <!-- Heure -->
                    <label for="formCreerEvent_heureHeure">Heure :</label>
                    <input id="formCreerEvent_heureHeure" type="number" min="0" max="23" name="formCreerEvent_heureHeure">h
                    <input id="formCreerEvent_heureMinute" type="number" value="0" min="0" max="59" name="formCreerEvent_heureMinute">
                </p>
                <p> <!-- Lieu -->
                    <label for="formCreerEvent_lieu">Lieu :</label>
                    <input id="formCreerEvent_lieu" type="text" name="formCreerEvent_lieu">
                </p>
                <p> <!-- Description de l'évent -->
                    <label for="formCreerEvent_desc">Description de l'évent :</label>
                    <textarea id="formCreerEvent_desc" placeholder="Description de l'évent" name="formCreerEvent_desc"></textarea>
                </p>
                <p> <!-- Ajouter Évent -->
                    <input type="submit" value="Ajouter l'évent" name="formCreerEvent_ajouter">
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