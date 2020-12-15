<div class="container text-center">
    <h3>Parrainage</h3>
    <hr>
    <div class="row">
        <?php if (NB_MEMBRES < 3) { echo '<div class="col-sm-2"></div>'; }?>
        <div class="col-sm-4">
            <div class="well">
                <h4 class="pc"><?php echo TYPE0 ?></h4>
                <p><?php echo NOM0 ?></p>
                <p><a href="mailto:<?php echo EMAIL0 ?>"><?php echo EMAIL0 ?></a></p>
                <p>Cliquez pour envoyer un mail.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h4 class="pc"><?php echo TYPE1 ?></h4>
                <p><?php echo NOM1 ?></p>
                <p><a href="mailto:<?php echo EMAIL1 ?>"><?php echo EMAIL1 ?></a></p>
                <p>Cliquez pour envoyer un mail.</p>
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
        <h4 class="pc">$type</h4>
        <p>$nom</p>
        <p><a href="mailto:$email">$email</a></p>
        <p>Cliquez pour envoyer un mail.</p>
    </div>
</div>
EOD;
        }
        ?>
        <?php if (NB_MEMBRES < 3) { echo '<div class="col-sm-2"></div>'; }?>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="well">
                <h4 class="pc">Groupe</h4>
                <p>Groupe <?php echo GROUPE ?></p>
                <p>Ce groupe peut être amené à changer. Nous vous tiendrons informés.</p>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="well">
                <h4 class="pc">Lien du GForm</h4>
                <p>À remplir pour que l'on puisse obtenir vos infos pour pouvoir vous assigner à votre groupe.</p>
                <p><a href="https://forms.gle/yiFgtcV4ynQe8uSV9">https://forms.gle/yiFgtcV4ynQe8uSV9</a></p>
                <h4 class="pc">Lien du serveur Discord de l'événement</h4>
                <p><a href="https://discord.gg/nk2ueTtVNc">https://discord.gg/nk2ueTtVNc</a></p>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
