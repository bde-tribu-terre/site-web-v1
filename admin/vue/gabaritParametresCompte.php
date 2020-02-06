<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tribu-Terre | Paramètres de mon compte</title>
    <meta charset="UTF-8">
</head>
<body>
<fieldset>
    <h1>PARAMÈTRES DE MON COMPTE</h1>
    <?php
    if (!empty($messageRetour)) { // Si il y a un message de retour, c'est à dire un message après avoir bien ou mal envoyé un formulaire, il s'affiche ici.
        echo '<fieldset id="message_fieldset">' . '<legend>Message</legend>' . '<p>' . $messageRetour . '</p>' . '</fieldset>';
    }
    ?>
    <div id="divActions">
        <fieldset id="formMettreAJour_fieldset">
            <h3>Modifier mes infos</h3>
            <form id="formMettreAJour" action="admin.php" method="post">
                <p> <!-- Login, non modifiable arbitrairement. -->
                    Login = <?php echo $loginMembre ?>.
                </p>
                <p> <!-- Nom -->
                    <label for="formMettreAJour_nom">Nom :</label>
                    <input id="formMettreAJour_nom" type="text" name="formMettreAJour_nom" value="<?php echo $nomMembre ?>">
                </p>
                <p> <!-- Description -->
                    <label for="formMettreAJour_desc">Mot de passe :</label>
                    <textarea id="formMettreAJour_desc" name="formMettreAJour_desc" content="<?php echo $descMembre ?>">
                </p>
                <p> <!-- Modifier mes infos -->
                    <input type="submit" value="Modifier mes infos" name="formMettreAJour_modifierInfos">
                </p>
            </form>
        </fieldset>
        <fieldset id="formChangerMdp_fieldset">
            <h3>Changer mon mot de passe</h3>
            <form id="formChangerMdp" action="admin.php" method="post">
                <p>
                    <b>Attention : </b>Le mot de passe est visible par ceux ayant accès à la base de donnée, c'est à dire les membres du pôle info.<br>
                    De plus, le mot de passe y sera sauvegardé de manière durable, et ce jusqu'à la potentielle disparition du site. Les futurs bureaux y auront aussi accès.
                </p>
                <p> <!-- Mdp actuel -->
                    <label for="formChangerMdp_mdpActuel">Mot de passe actuel :</label>
                    <input id="formChangerMdp_mdpActuel" type="password" name="formChangerMdp_mdpActuel">
                </p>
                <p> <!-- Nouveau Mdp -->
                    <label for="formChangerMdp_nouveauMdp">Nouveau mot de passe :</label>
                    <input id="formChangerMdp_nouveauMdp" type="password" name="formChangerMdp_nouveauMdp">
                </p>
                <p> <!-- Répéter nouveau Mdp -->
                    <label for="formChangerMdp_nouveauMdpBis">Répéter le nouveau mot de passe :</label>
                    <input id="formChangerMdp_nouveauMdpBis" type="password" name="formChangerMdp_nouveauMdpBis">
                </p>
                <p> <!-- Changer de mot de passe -->
                    <input type="submit" value="Changer de mot de passe" name="formMettreAJour_modifierInfos">
                </p>
            </form>
        </fieldset>
    </div>
</fieldset>
</body>
</html>