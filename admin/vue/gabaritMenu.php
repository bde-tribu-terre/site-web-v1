<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Admin</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>MENU ADMINISTRATEUR</h1>
    <h2>Bienvenue <?php echo $nomMembre ?> 😊</h2>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formArticles_fieldset">
            <h3>Articles</h3>
            <form id="formArticles" action="admin.php" method="post">
                <input type="submit" value="Créer un article" name="formArticles_creerArticle">
                <input type="submit" value="Modifier un article" name="formArticles_modifierArticle">
            </form>
        </fieldset>
        <fieldset id="formEvents_fieldset">
            <h3>Events</h3>
            <form id="formEvents" action="admin.php" method="post">
                <input type="submit" value="Créer un évent" name="formEvents_creerEvent">
                <input type="submit" value="Modifier un évent" name="formEvents_modifierEvent">
            </form>
        </fieldset>
        <fieldset id="formMonCompte_fieldset">
            <h3>Mon compte</h3>
            <form id="formMonCompte" action="admin.php" method="post">
                <input type="submit" value="Paramètres de mon compte" name="formMonCompte_parametres">
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>