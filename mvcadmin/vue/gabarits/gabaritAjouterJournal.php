<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Ajouter un journal.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>AJOUTER UN JOURNAL</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formAjouterJournal_fieldset">
            <h3>Ajouter un journal</h3>
            <form id="formAjouterJournal" method="post" enctype="multipart/form-data">
                <p> <!-- Titre du journal -->
                    <label for="formAjouterJournal_titreJournal">Titre du journal :</label>
                    <input id="formAjouterJournal_titreJournal" type="text" placeholder="Titre du journal" value="Omni-Sciences n°" name="formAjouterJournal_titreJournal">
                </p>
                <p> <!-- Mois de sortie du journal -->
                    <label for="formAjouterJournal_moisJournal">Mois de sortie du journal :</label>
                    <select id="formAjouterJournal_moisJournal" name="formAjouterJournal_moisJournal">
                        <option value="01">Janvier</option>
                        <option value="02">Février</option>
                        <option value="03">Mars</option>
                        <option value="04">Avril</option>
                        <option value="05">Mai</option>
                        <option value="06">Juin</option>
                        <option value="07">Juillet</option>
                        <option value="08">Août</option>
                        <option value="09">Septembre</option>
                        <option value="10">Octobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Décembre</option>
                    </select>
                </p>
                <p> <!-- Année de sortie du journal -->
                    <label for="formAjouterJournal_anneeJournal">Année de sortie du journal :</label>
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