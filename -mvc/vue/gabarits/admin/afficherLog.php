<div class="container text-center">
    <?php require_once CHEMIN_VERS_MESSAGES ?>
    <div class="row">
        <div class="col-sm-12">
            <table class="well table table-striped table-hover" style="background-color: white">
                <thead>
                <tr>
                    <th scope="col">Date et heure</th>
                    <th scope="col">Code</th>
                    <th scope="col">Membre</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>
                <?php echo LOG ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Retour au menu</h3>
                <hr>
                <form id="formRetourMenu" method="post">
                    <p> <!-- Retour au menu -->
                        <input class="btn btn-danger btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>