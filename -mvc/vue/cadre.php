<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ?> | Tribu-Terre</title>

    <!-- Meta tags essentiels -->
    <meta property="og:title" content="<?php echo TITLE ?>">
    <meta property="og:image" content="<?php echo IMAGES .'imgLogoMini.png' ?>">
    <meta
            property="og:description"
            content="Tribu-Terre, Association des Étudiants en Sciences de l'Université d'Orléans."
    >
    <meta
            name="description"
            content="Tribu-Terre, Association des Étudiants en Sciences de l'Université d'Orléans."
    >
    <meta property="og:url" content="https://bde-tribu-terre.fr/">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Meta tags recommandés -->
    <meta property="og:site_name" content="BDE Tribu-Terre">
    <meta name="twitter:image:alt" content="Logo de Tribu-Terre">

    <!-- Meta tags recommandés -->
    <!-- <meta property="fb:app_id" content="your_app_id"> <- Il faut un token pour avoir l'ID de la page -->
    <meta name="twitter:site" content="@tributerre45">

    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Feuille de style définissant les variables -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_VERS_VARIABLES ?>">

    <!-- Feuille de style générale -->
    <link rel="stylesheet" type="text/css" href="<?php echo RACINE . '-mvc/vue/style.css' ?>">

    <!-- Feuille de style spécifique au gabarit -->
    <link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_VERS_STYLE ?>">

    <!-- Fonctions Javascript -->
    <script src="<?php echo RACINE . '-mvc/vue/script.js' ?>"></script>
</head>
<body>
<div class="page-complete">
    <header>
        <?php require_once CHEMIN_VERS_HEADER; ?>
    </header>
    <main>
        <?php require_once CHEMIN_VERS_GABARIT; ?>
    </main>
    <footer>
        <?php require_once CHEMIN_VERS_FOOTER; ?>
    </footer>
</div>
</body>
</html>
