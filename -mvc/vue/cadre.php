<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo TITLE ?> | Tribu-Terre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo RACINE . '-mvc/vue/style.css' ?>">
    <script src="<?php echo RACINE . '-mvc/vue/script.js' ?>"></script>
</head>
<body>
<div class="page-complete">
    <header>
        <?php require_once(PATH_TO_HEADER); ?>
    </header>
    <main>
        <?php require_once PATH_TO_GABARIT; ?>
    </main>
    <footer>
        <?php require_once PATH_TO_FOOTER; ?>
    </footer>
</div>
</body>
</html>