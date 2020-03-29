<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Modifier un goodie.</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>MODIFIER UN GOODIE</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formModifierGoodie_fieldset">
            <h3>Modifier un goodie</h3>
            <form id="formModifierGoodie" action="admin" method="post">
                <p> <!-- ID du goodie -->
                    <label for="formModifierGoodie_idGoodie">ID du goodie :</label>
                    <input id="formModifierGoodie_idGoodie" type="text" value="<?php echo $idGoodie ?>" placeholder="Titre du goodie" name="formModifierGoodie_idGoodie" readonly>
                </p>
                <p> <!-- Titre du goodie -->
                    <label for="formModifierGoodie_titreGoodie">Titre du goodie :</label>
                    <input id="formModifierGoodie_titreGoodie" type="text" value="<?php echo $titreGoodie ?>" placeholder="Titre du goodie" name="formModifierGoodie_titreGoodie">
                </p>
                <p> <!-- Catégorie -->
                    <label for="formModifierGoodie_categorie">Catégorie :</label>
                    <select id="formModifierGoodie_categorie" name="formModifierGoodie_categorie">
                        <option value="0">Caché</option>
                        <option value="1">Disponible</option>
                        <option value="2">Bientôt disponible</option>
                        <option value="3">En rupture de stock</option>
                    </select>
                </p>
                <p> <!-- Prix adhérent -->
                    <label for="formModifierGoodie_prixAdhérentEuro">Prix adhérent :</label>
                    <input id="formModifierGoodie_prixAdhérentEuro" type="number" value="<?php echo $prixADEuroGoodie ?>" min="0" name="formModifierGoodie_prixAdhérentEuro">€
                    <input id="formModifierGoodie_prixAdhérentCentimes" type="number" value="<?php echo $prixADCentimesGoodie ?>" min="0" max="99" name="formModifierGoodie_prixAdhérentCentimes">centimes
                </p>
                <p> <!-- Prix non-adhérent -->
                    <label for="formModifierGoodie_prixNonAdhérentEuro">Prix non-adhérent :</label>
                    <input id="formModifierGoodie_prixNonAdhérentEuro" type="number" value="<?php echo $prixNADEuroGoodie ?>" min="0" name="formModifierGoodie_prixNonAdhérentEuro">€
                    <input id="formModifierGoodie_prixNonAdhérentCentimes" type="number" value="<?php echo $prixNADCentimesGoodie ?>" min="0" max="99" name="formModifierGoodie_prixNonAdhérentCentimes">centimes
                </p>
                <p> <!-- Description du goodie -->
                    <label for="formModifierGoodie_descGoodie">Description du goodie :</label>
                    <textarea id="formModifierGoodie_descGoodie" placeholder="Description du goodie" name="formModifierGoodie_descGoodie"><?php echo $descGoodie ?></textarea>
                </p>
                <p>⚠️ Pour modifier la miniature il faut recréer le goodie. Désolé ! ⚠️</p>
                <p> <!-- Modifier Goodie -->
                    <input type="submit" value="Ajouter le goodie" name="formModifierGoodie_modifierGoodie">
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