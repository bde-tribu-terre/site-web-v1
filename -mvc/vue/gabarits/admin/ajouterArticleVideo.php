<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un article vidéo</h3>
                <hr>
                <form id="formAjouterArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formAjouterArticleVideo_titre">Titre de l'article</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(this, 128);" class="form-control" id="formAjouterArticleVideo_titre" type="text" placeholder="Titre" name="formAjouterArticleVideo_titre">
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formAjouterArticleVideo_categorie">Catégorie</label>
                        <select onblur="verifNonMoins1(this);" class="form-control" id="formAjouterArticleVideo_categorie" name="formAjouterArticleVideo_categorie">
                            <option value="-1">--Choisir--</option>
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formAjouterArticleVideo_visibilite">Visibilité</label>
                        <select onblur="verifNonMoins1(this);" class="form-control" id="formAjouterArticleVideo_visibilite" name="formAjouterArticleVideo_visibilite">
                            <option value="-1">--Choisir--</option>
                            <option value="0">Invisible</option>
                            <option value="1">Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Lien de la vidéo -->
                        <label for="formAjouterArticleVideo_lien">Lien de la vidéo</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(this, 256);" class="form-control" id="formAjouterArticleVideo_lien" type="text" placeholder="Lien" name="formAjouterArticleVideo_lien">
                        <small class="form-text text-muted">Exemple : http://www.youtube.com/watch?v=B4CRkpBGQzU</small>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formAjouterArticleVideo_texte">Texte de l'article</label>
                        <textarea onblur="verifNonVide(this);" oninput="garderMoins(this, 7999);" class="form-control" id="formAjouterArticleVideo_texte" placeholder="Texte de l'article" name="formAjouterArticleVideo_texte" rows="20"></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter l'article -->
                        <input class="btn btn-danger btn-block" type="submit" value="Ajouter l'article" name="formAjouterArticleVideo_ajouter_submit">
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