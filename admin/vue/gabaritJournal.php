<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Paramètres de mon compte</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>GÉRER LES JOURNAUX</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formAjouterJournal_fieldset">
            <h3>Modifier mes infos</h3>
            <form id="formAjouterJournal" action="admin.php" method="post" enctype="multipart/form-data">
                <p> <!-- Titre du journal -->
                    <label for="formAjouterJournal_titreJournal">Titre du journal :</label>
                    <input id="formAjouterJournal_titreJournal" type="text" placeholder="Titre du journal" name="formAjouterJournal_titreJournal">
                </p>
                <p> <!-- Mois de sortie du journal -->
                    <label for="formAjouterJournal_moisJournal">Mois du sortie du journal :</label>
                    <input id="formAjouterJournal_moisJournal" type="number" value="1" min="1" max="12" name="formAjouterJournal_moisJournal">
                </p>
                <p> <!-- Année de sortie du journal -->
                    <label for="formAjouterJournal_anneeJournal">Année du sortie du journal :</label>
                    <input id="formAjouterJournal_anneeJournal" type="number" value="2000" min="2000" max="2050" name="formAjouterJournal_anneeJournal">
                </p>
                <p> <!-- Fichier PDF -->
                    <input type="file" value="Sélectionner le PDF" name="formAjouterJournal_fichierPDF" accept="application/pdf">
                </p>
                <p> <!-- Ajouter Journal -->
                    <input type="submit" value="Ajouter le journal" name="formAjouterJournal_ajouterJournal">
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