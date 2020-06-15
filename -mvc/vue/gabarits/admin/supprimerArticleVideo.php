<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un article vidéo</h3>
                <hr>
                <form id="formSupprimerArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formSupprimerArticleVideo_id">Article vidéo</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formSupprimerArticleVideo_id" name="formSupprimerArticleVideo_id">
                            <option value="">--Choisir un article vidéo--</option>
                            <?php echo ARTICLES_VIDEO ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer article -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer l'article vidéo" name="formSupprimerArticleVideo_supprimer_submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Retour au menu</h3>
                <hr>
                <form id="formRetourMenu" method="post">
                    <p> <!-- Retour au menu -->
                        <input class="btn btn-danger btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu_submit">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>