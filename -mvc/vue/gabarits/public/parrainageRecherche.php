<div class="container text-center">
    <h3>Parrainage</h3>
    <hr>
    <div class="row">
        <?php if (NB_MEMBRES < 3) { echo '<div class="col-sm-2"></div>'; }?>
        <div class="col-sm-4">
            <div class="well">
                <p>[<?php echo TYPE0 ?>]</p>
                <p><?php echo NOM0 ?></p>
                <p><?php echo EMAIL0 ?></p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <p>[<?php echo TYPE1 ?>]</p>
                <p><?php echo NOM1 ?></p>
                <p><?php echo EMAIL1 ?></p>
            </div>
        </div>
        <?php
        if (NB_MEMBRES >= 3) {
            $type = TYPE2;
            $nom = NOM2;
            $email = EMAIL2;
            echo <<<EOD
<div class="col-sm-4">
    <div class="well">
        <p>$type</p>
        <p>$nom</p>
        <p>$email</p>
    </div>
</div>
EOD;
        }
        ?>
        <?php if (NB_MEMBRES < 3) { echo '<div class="col-sm-2"></div>'; }?>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <form id="formRechercherMail" method="post" onsubmit="return verifForm(this);">
                <div class="form-group"> <!-- Email recherché -->
                    <label for="formRechercherMail_mail">
                        Saisissez votre e-mail.
                    </label>
                    <input
                            id="formRechercherMail_mail"
                            name="formRechercherMail_mail"
                            type="text"
                            class="form-control"
                            placeholder="E-mail"
                            onblur="verifNonVide(this);"
                            oninput="garderMoins(this, 128);"
                    >
                </div>
                <hr>
                <div class="form-group"> <!-- Rechercher -->
                    <input
                            id="formRechercherMail_rechercher_submit"
                            name="formRechercherMail_rechercher_submit"
                            type="submit"
                            class="btn btn-var btn-block"
                            value="Rechercher"
                    >
                </div>
            </form>
        </div>
    </div>
</div><br>