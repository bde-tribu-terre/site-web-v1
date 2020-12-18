<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plan interactif | Tribu-Terre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="universite.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src='https://unpkg.com/@turf/turf/turf.min.js'></script>
</head>
<body>
<div
    class="carte"
    id="carte"
></div>
<script type="text/javascript">
    // Si conditions
    <?php
    $universiteJSON = json_decode(file_get_contents('../universite.json'));
    if (!empty($_GET)) {
        foreach ($universiteJSON as $codeComposante => $composante) {
            if (isset($_GET['c']) && !(strtolower($_GET['c']) == strtolower($codeComposante))) {
                unset($universiteJSON->$codeComposante);
                continue;
            }
            if (isset($_GET['b'])) {
                foreach ($composante->batiments as $ibatiment => $batiment) {
                    if (!($_GET['b'] == $ibatiment)) {
                        unset($universiteJSON->$codeComposante->batiments[$ibatiment]);
                    }
                }
            }
        }
    }
    $universiteJSONCompact = preg_replace('/\'/', '\\\'', preg_replace('/(^|\n)\s*/', '', json_encode($universiteJSON)));
    ?>

    // Lecture du JSON
    let universiteJSON = JSON.parse('<?php echo $universiteJSONCompact ?>');
</script>
<script src="universite.min.js"></script>
</body>
</html>
