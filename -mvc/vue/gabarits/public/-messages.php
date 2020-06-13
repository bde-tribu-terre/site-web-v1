<div class="container">
    <div<?php echo empty(MESSAGES) || GABARIT == 'erreur.php' ? ' style="display: none"' : '' ?>>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="well">
                    <h3>Message(s)</h3>
                    <hr>
                    <ul class="text-left">
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
                    </ul>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</div>