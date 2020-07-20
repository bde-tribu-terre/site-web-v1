<?php
header("Content-Type: application/json");

function requete(&$retour) {
    try {
        if (isset($_GET['r'])) {
            if ($_GET['r'] == 'salles') {
                $JSON = json_decode(file_get_contents('../universite.json'));
                foreach ($JSON as $codeComposante => $composante) {
                    if (!isset($_GET['c']) || strtolower($_GET['c']) == strtolower($codeComposante)) {
                        $ibatiment = 0;
                        foreach ($composante->batiments as $batiment) {
                            $igroupe = 0;
                            foreach ($batiment->groupes as $groupe) {
                                $isalle = 0;
                                foreach ($groupe->salles as $salle) {
                                    if (!isset($_GET['s']) || strtolower($_GET['s']) == strtolower($salle)) {
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
                                    $isalle++;
                                }
                                $igroupe++;
                            }
                            $ibatiment++;
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
$meta['source'] = 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
$meta['debut_execution'] = $debut;
$meta['temps_execution'] = microtime(true) - $debut;
$meta['credits'] = 'Anaël BARODINE, étudiant en informatique à l\'Université d\'Orléans, au nom de l\'association étudiante Tribu-Terre.';
echo json_encode(
    array(
        'meta' => $meta,
        'retour' => $retour
    )
);