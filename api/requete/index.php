<?php
header("Content-Type: application/json");

function requete(&$retour) {
    try {
        if (isset($_GET['r'])) {
            if ($_GET['r'] == 'salles') {
                $JSON = json_decode(file_get_contents('../universite.json'));
                foreach ($JSON as $codeComposante => $composante) {
                    if (!isset($_GET['c']) || strtolower($_GET['c']) == strtolower($codeComposante)) {
                        foreach ($composante->batiments as $ibatiment => $batiment) {
                            if (!isset($_GET['b']) || $_GET['b'] == $ibatiment) {
                                foreach ($batiment->groupes as $igroupe => $groupe) {
                                    if (!isset($_GET['g']) || $_GET['g'] == $igroupe) {
                                        foreach ($groupe->salles as $isalle => $salle) {
                                            if (
                                                (
                                                    !isset($_GET['s']) || $_GET['s'] == $isalle
                                                )
                                                &&
                                                (
                                                    !isset($_GET['ns']) || preg_replace('/ |\.|\(.*\) /', '', strtolower($_GET['ns'])) ==  preg_replace('/ |\.|\(.*\) /', '', strtolower($salle))
                                                )
                                                &&
                                                (
                                                    !isset($_GET['nse']) || stristr($salle, $_GET['nse'])
                                                )
                                            ) {
                                                array_push(
                                                    $retour,
                                                    array(
                                                        'code_composante' => $codeComposante,
                                                        'titre_composante' => $composante->titre,
                                                        'id_batiment' => $ibatiment,
                                                        'nom_batiment' => $batiment->libelle_long,
                                                        'id_groupe' => $igroupe,
                                                        'nom_groupe' => $groupe->nom,
                                                        'id_salle' => $isalle,
                                                        'nom_salle' => $salle
                                                    )
                                                );
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                return array(
                    'succes' => true,
                    'message' => 'Liste des salles générée'
                );
            } else {
                return array(
                    'succes' => false,
                    'message' => 'Paramètre requête inconnu'
                );
            }
        } else {
            return array(
                'succes' => false,
                'message' => 'Paramètre requête non renseigné'
            );
        }
    } catch (Exception $e) {
        return array(
            'succes' => false,
            'message' => $e->getMessage()
        );
    }
}

$debut = microtime(true);
$retour = array();
$meta = requete($retour);
$meta['source'] = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$meta['debut_execution'] = $debut;
$meta['temps_execution'] = microtime(true) - $debut;
$meta['credits'] = 'Anaël BARODINE, étudiant en informatique à l\'Université d\'Orléans, au nom de l\'association étudiante Tribu-Terre.';
echo json_encode(
    array(
        'meta' => $meta,
        'retour' => $retour
    )
);