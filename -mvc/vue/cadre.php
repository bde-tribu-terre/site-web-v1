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
        /* Background en marbre qui est fixe (parallax).
        body {
            background: url("<?php echo $prefixe . '-images/imgFondMarbre.png' ?>") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
        */

        /* Remove the navbar's default rounded borders and increase the bottom margin */
        .navbar {
            margin-bottom: 50px;
            border-radius: 0;
        }

        /* Remove the jumbotron's default bottom margin */
        .jumbotron {
            background-image: url("<?php echo $prefixe . '-images/imgFondMarbre.png' ?>");
            background-clip: border-box;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin-bottom: 0;
        }

        /* Pour que le fond s'affiche joliement sur mobile */
        @media handheld {
            .jumbotron {
                background-attachment: inherit;
            }
        }

        /* Lueur blanche autour du texte du jumbotron */
        .jumbotron p, .jumbotron h1, .jumbotron h2, .jumbotron h3, .jumbotron h4, .jumbotron h5 {
            text-shadow:
                5px 5px 5px #f3f3f3,
                -5px 5px 5px #f3f3f3,
                5px -5px 5px #f3f3f3,
                -5px -5px 5px #f3f3f3;
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
            border-radius: 10px;
            overflow: hidden;
        }

        /* Cache le 3e event de l'accueil si la largeur est petite (sinon moche). */
        @media (max-width: 990px) {
            .accueilTroisiemeEvent {
                display: none;
            }
        }

        /* Montre le 3e event de l'accueil si la largeur est TRES petite. */
        @media (max-width: 750px) {
            .accueilTroisiemeEvent {
                display: revert;
            }
        }

        /*
        /* Hide the carousel text when the screen is less than 600 pixels wide * /
        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
        }
        */

        .miniatureGoodies {
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
        }

        .imageUniqueGoodiePrecis, .imageUniqueArticlePrecis, .integrationArticleVideoPrecis {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        .imageMiniatureArticlesDiv {
            max-width: 480px;
            display: inline-block;
        }

        .imageMiniatureArticles {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            overflow: hidden;
        }

        .texteFooter {
            font-size: 10px;
            line-height: 10px;
        }

        .retrait {
            text-indent: 4em;
        }

        .imageAGbordure {
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #e3e3e3;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
        }

        .plan-du-site .list-group {
            margin-bottom: 0;
        }

        /* Petites capitales */
        .pc {
            font-variant: small-caps;
        }
    </style>
</head>
<body>
<div>
    <header>
        <?php require_once($header); ?>
    </header>
    <main>
        <?php require_once($gabarit); ?>
    </main>
    <footer>
        <?php require_once($footer); ?>
    </footer>
</div>
</body>
</html>