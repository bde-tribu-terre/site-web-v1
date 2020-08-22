<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3>Oulah... Une erreur s'est produite 😰</h3>
            <div class="well">
                <h3>Rapport de l'erreur :</h3>
                <h4>
                    <strong>
                        <?php
                        foreach (MESSAGES as $arrMessage) {
                            switch (substr($arrMessage[0], 0, 1)) {
                                case '1':
                                    $color = '';
                                    break;
                                case '2':
                                    $color = ' style="color: green;"';
                                    break;
                                case '4':
                                    $color = ' style="color: orange"';
                                    break;
                                case '5':
                                    $color = ' style="color: red"';
                                    break;
                                case '6':
                                    $color = ' style="color: purple"';
                                    break;
                                default:
                                    $color = ' style="color: blue"';
                            }
                            echo '<li' . $color . '>' . $arrMessage[0] . ' : ' . $arrMessage[1] . '</li>';
                        }
                        ?>
                    </strong>
                </h4>
                <p><i>Pour te consoler voici une girafe.</i></p>
            </div>
        </div>
        <div class="col-sm-4">
            <img class="img-arrondi ombre" src="<?php echo IMAGES . 'imgGirafeErreur.jpg' ?>" alt="Girafe">
        </div>
    </div>
</div><br>