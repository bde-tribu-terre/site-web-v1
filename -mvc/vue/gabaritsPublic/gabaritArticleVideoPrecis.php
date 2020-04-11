<div class="container text-center">
    <h3><?php echo $titre ?></h3>
    <hr>
    <?php echo $integrationVideo ?>
    <div class="row text-left retrait">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <?php echo $texteFormate ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <small>Publié le <?php echo $dateCreationStr ?> par <?php echo $auteurStr ?><!--<?php echo $dateModification ? ' (modifié le ' . $dateModificationStr . ')' : '' ?>-->.</small>
        </div>
        <div class="col-sm-3"></div>
    </div><br>
</div>