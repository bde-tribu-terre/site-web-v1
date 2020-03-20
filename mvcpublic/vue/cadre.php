<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tribu-Terre | <?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default rounded borders and increase the bottom margin */
        .navbar {
            margin-bottom: 50px;
            border-radius: 0;
        }

        /* Remove the jumbotron's default bottom margin */
        .jumbotron {
            background-image: url("<?php echo $prefixe . 'global/images/imgFondMarbre' ?>");
            background-clip: border-box;
            background-repeat: no-repeat;
            background-size: cover;
            margin-bottom: 0;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }

        /* Arrondit les bords du carousel. */
        .carousel {
            border-radius: 10px;
            overflow: hidden;
        }

        /* Les liens du carousel restent en blanc. */
        .carousel a {
            color: white;
        }

        .carousel-inner img {
            width: 100%; /* Set width to 100% */
            min-height: 200px;
        }

        /* Hide the carousel text when the screen is less than 600 pixels wide */
        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
        }

        .miniatureGoodies {
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
        }

        .imageUniqueGoodiePrecis {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<?php require_once($prefixe . 'global/header.php'); ?>
<?php require_once($gabarit); ?>
<?php require_once($prefixe . 'global/footer.php'); ?>
</body>
</html>