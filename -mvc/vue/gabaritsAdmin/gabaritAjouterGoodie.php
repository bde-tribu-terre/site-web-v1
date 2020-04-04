<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Ajouter un goodie.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>AJOUTER UN GOODIE</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formAjouterGoodie_fieldset">
            <h3>Ajouter un goodie</h3>
            <form id="formAjouterGoodie" method="post" enctype="multipart/form-data">
                <p> <!-- Titre du goodie -->
                    <label for="formAjouterGoodie_titreGoodie">Titre du goodie :</label>
                    <input id="formAjouterGoodie_titreGoodie" type="text" placeholder="Titre du goodie" name="formAjouterGoodie_titreGoodie">
                </p>
                <p> <!-- Catégorie -->
                    <label for="formAjouterGoodie_categorie">Catégorie :</label>
                    <select id="formAjouterGoodie_categorie" name="formAjouterGoodie_categorie">
                        <option value="0">Caché</option>
                        <option value="1">Disponible</option>
                        <option value="2">Bientôt disponible</option>
                        <option value="3">En rupture de stock</option>
                    </select>
                </p>
                <p> <!-- Prix adhérent -->
                    <label for="formAjouterGoodie_prixAdhérentEuro">Prix adhérent :</label>
                    <input id="formAjouterGoodie_prixAdhérentEuro" type="number" min="0" name="formAjouterGoodie_prixAdhérentEuro">€
                    <input id="formAjouterGoodie_prixAdhérentCentimes" type="number" value="0" min="0" max="99" name="formAjouterGoodie_prixAdhérentCentimes">centimes
                </p>
                <p> <!-- Prix non-adhérent -->
                    <label for="formAjouterGoodie_prixNonAdhérentEuro">Prix non-adhérent :</label>
                    <input id="formAjouterGoodie_prixNonAdhérentEuro" type="number" min="0" name="formAjouterGoodie_prixNonAdhérentEuro">€
                    <input id="formAjouterGoodie_prixNonAdhérentCentimes" type="number" value="0" min="0" max="99" name="formAjouterGoodie_prixNonAdhérentCentimes">centimes
                </p>
                <p> <!-- Description du goodie -->
                    <label for="formAjouterGoodie_descGoodie">Description du goodie :</label>
                    <textarea id="formAjouterGoodie_descGoodie" placeholder="Description du goodie" name="formAjouterGoodie_descGoodie"></textarea>
                </p>
                <p> <!-- Miniature -->
                    <label for="formAjouterGoodie_miniature">Sélectionner la miniature (⚠️  format 4:3 pour ne pas que ça soit deg) :</label>
                    <input type="file" name="formAjouterGoodie_miniature" accept="image/*">
                </p>
                <p>🙏 Please please please !!!!!! L'image doit faire 960px*720px !!!!</p>
                <p>⚠️ Pour ajouter les images qui seront affichées sur la page du goodie, il faut ajouter le goodie, puis retourner sur le menu admin, et aller dans "ajouter une image à un goodie". ⚠️</p>
                <p> <!-- Ajouter Goodie -->
                    <input type="submit" value="Ajouter le goodie" name="formAjouterGoodie_ajouterGoodie">
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