<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Menu administrateur</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>MENU ADMINISTRATEUR</h1>
    <h2>Bienvenue <?php echo $nomMembre ?> ! 😊</h2>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formArticles_fieldset">
            <h3>Articles</h3>
            <form id="formArticles" action="admin.php" method="post">
                <p> <!-- Créer un article -->
                    <input type="submit" value="Créer un article" name="formArticles_creerArticle" disabled><!-- Disabled TODO: gabaritCreerArticle -->
                </p>
                <p> <!-- Modifier un article -->
                    <input type="submit" value="Modifier un article" name="formArticles_modifierArticle" disabled><!-- Disabled TODO: gabaritModifierArticle -->
                </p>
            </form>
        </fieldset>
        <fieldset id="formEvents_fieldset">
            <h3>Events</h3>
            <form id="formEvents" action="admin.php" method="post">
                <p> <!-- Créer un évent -->
                    <input type="submit" value="Créer un évent" name="formEvents_creerEvent" disabled><!-- Disabled TODO: gabaritCreerEvent -->
                </p>
                <p> <!-- Modifier un évent -->
                    <input type="submit" value="Modifier un évent" name="formEvents_modifierEvent" disabled><!-- Disabled TODO: gabaritModifierEvent -->
                </p>
            </form>
        </fieldset>
        <fieldset id="formMonCompte_fieldset">
            <h3>Mon compte</h3>
            <form id="formMonCompte" action="admin.php" method="post">
                <p> <!-- Paramètres de mon compte -->
                    <input type="submit" value="Paramètres de mon compte" name="formMonCompte_parametres">
                </p>
            </form>
        </fieldset>
        <fieldset id="formMonDeconnexion_fieldset">
            <h3>Se déconnecter</h3>
            <form id="formMonDeconnexion" action="admin.php" method="post">
                <p> <!-- Se déconnecter -->
                    <input type="submit" value="Se déconnecter" name="formMonDeconnexion_deconnexion">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>