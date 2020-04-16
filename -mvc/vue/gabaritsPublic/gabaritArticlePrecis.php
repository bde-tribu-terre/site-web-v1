<div class="container text-center">
    <h3><?php echo $titre ?></h3>
    <h4></h4>
    <hr>
    <?php echo $carouselArticle ?>
    <div class="row text-left retrait">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <?php echo $texteFormate ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="Cet article de Tribu-Terre est très intéressant : <?php echo $titre ?>" data-via="Tributerre45" data-show-count="false">
                Tweet
            </a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class="fb-share-button"
                 data-href="https://www.your-domain.com/your-page.html"
                 data-layout="button_count">
            </div>

        </div>
        <div class="col-sm-3"></div>
    </div><br>
</div>