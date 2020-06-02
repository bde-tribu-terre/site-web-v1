<script type="text/javascript">
    function decoder(target) {
        let elementBase64 = document.getElementById(target + '_base64');
        let strBase64 = elementBase64.innerText;
        let strMail = atob(strBase64);
        let elementDiv = document.getElementById(target + '_div');
        elementDiv.removeChild(elementBase64);

        let elementMail = document.createElement('p');
        elementMail.setAttribute('id', target + '_mail');
        elementMail.innerText = strMail;
        elementDiv.appendChild(elementMail);

        let elementButton = document.getElementById(target + '_button');
        elementButton.setAttribute('disabled', '');
    }
</script>
<div class="container text-center">
    <h3>Pôles</h3>
    <hr>
    <div class="row">
        <!-- Auteur : Anaël BARODINE. -->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <p class="text-justify retrait">
                La plupart des membres du bureau de Tribu-Terre sont assignés à un pôle, ce qui sert à définir
                le rôle et les tâches de chacun. Actuellement, il existe huit pôles au sein de l'association
                Tribu-Terre, mais ces derniers peuvent changer à l'occasion d'une Assemblée Générale, ou bien au cours
                de l'année si un besoin ou une opportunité apparaît.
            </p>
            <p class="text-justify retrait">
                Ainsi, certains pôles se révèlent nécessaires par nature du fait du statut d'association étudiante,
                comme le Pôle Communication ou le Pôle Événementiel, alors que d'autres relèvent de l'envie d'étudiants
                membres du bureau de créer des projets en particuliers au nom de l'association, comme le Pôle Journal ou
                le Pôle Informatique !
            </p>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <!-- \/ Pôle Culture \/ -->
            <!-- Auteur : Xxxx XXXX. -->
            <div class="well">
                <h1>🔬</h1>
                <h3>Pôle Culture</h3>
                <hr>
                <p class="text-justify retrait">
                    Texte pôle culture.
                </p>
            </div>
            <!-- \/ Pôle Cuisine \/ -->
            <!-- Auteur : Lou GEORGES. -->
            <div class="well">
                <h1>🍳</h1>
                <h3>Pôle Cuisine</h3>
                <hr>
                <p class="text-justify retrait">
                    Vous aimez cuisiner ? Marre de manger des pâtes ? Tous à vos fourneaux ! Le pôle cuisine est fait
                    pour vous. Nous vous proposons des recettes simples à réaliser, saines et peu coûteuses.
                </p>
                <p class="text-justify retrait">
                    Ouvert à tous, le pôle cuisine est avant tout un moyen de partager. Chaque semaine sur le site
                    Internet de Tribu-Terre, les membres du pôle cuisine proposeront conseils et techniques pour
                    cuisiner vite et bien ! <a href="<?php echo RACINE . 'articles/' ?>">Consulter les articles.</a>
                </p>
                <p class="text-justify retrait">
                    Si vous désirez partager vos idées ou même participer aux tutos gourmands, alors contactez-nous en
                    privé sur Facebook, à nos noms : Louis <span class="pc">Joubert</span> et Lou
                    <span class="pc">Georges</span>.
                </p>
            </div>
            <!-- \/ Pôle Partenariat \/ -->
            <!-- Auteur : William ABESSOLO. -->
            <div class="well">
                <h1>🤝</h1>
                <h3>Pôle Partenariat</h3>
                <hr>
                <p class="text-justify retrait">
                    Le pôle partenariat s’occupe de rechercher des partenaires auprès de petites ou grosses entreprises,
                    de magasins, de sites internet, etc... qu’il soit financier, matériel ou encore pour des échanges de
                    visibilité.
                </p>
                <p class="text-justify retrait">
                    De plus, il s'occupe de développer les relations avec les partenaires existants ou
                    potentiels pour l’association tout en les "fidélisant".
                </p>
            </div>
            <!-- \/ Pôle Goodies \/ -->
            <!-- Auteur : Maxence PIAT. -->
            <div class="well">
                <h1>👕</h1>
                <h3>Pôle Goodies</h3>
                <hr>
                <p class="text-justify retrait">
                    Tribu-Terre propose plusieurs types de goodies au nom de l’association comme des pulls,
                    des pins, des stickers et même des goodies à destination des étudiants comme des trousses à
                    dissection ou des marteaux de géologue.
                </p>
                <p class="text-justify retrait">
                    Les membres de ce pôle ont comme rôle de démarcher des entreprises, comparer les devis et
                    choisir avec qui travailler, au meilleur prix et à la meilleure qualité. De plus ils sont en
                    recherche constante de nouveaux goodies à proposer aux étudiants.
                </p>
                <p class="text-justify retrait">
                    <a href="<?php echo RACINE . 'goodies/' ?>">La liste complète ainsi que les prix des goodies est
                    disponible sur le site internet.</a>
                </p>
            </div>
        </div>
        <div class="col-sm-6">
            <!-- \/ Pôle Événementiel \/ -->
            <!-- Auteur : Xxxx XXXX. -->
            <div class="well">
                <h1>🎫</h1>
                <h3>Pôle Événementiel</h3>
                <hr>
                <p class="text-justify retrait">
                    Texte pôle événementiel.
                </p>
            </div>
            <!-- \/ Pôle Communication \/ -->
            <!-- Auteur : Lia-May DECOBECQ. -->
            <div class="well">
                <h1>🎤</h1>
                <h3>Pôle Communication</h3>
                <hr>
                <p class="text-justify retrait">
                    Notre rôle, en tant que pôle communication, est de vous transmettre nos informations pour que
                    vous soyez toujours au courant des nouveautés de Tribu-Terre. Nous essayons au mieux de vous
                    divertir et d’être présents pour vous afin de relayer les actualités du CoST et de nos divers
                    évènements (soirées, conférences...), vous proposer des contenus variés et des partages qui
                    pourraient vous intéresser, ainsi que tout ce qui est bon à savoir sur Tribu-Terre.
                </p>
                <p class="text-justify retrait">
                    Nous sommes présents sur trois réseaux :
                    <a href="https://www.facebook.com/bdeTribuTerre/">Facebook</a>,
                    <a href="https://instagram.com/tribu.terre?igshid=1nskuzt0d9nhb">Instagram</a> et
                    <a href="https://twitter.com/Tributerre45?s=09">Twitter</a>.
                </p>
                <p class="text-justify retrait">
                    Ce pôle est essentiel à toute association, il est le lien entre vous, chers étudiants et les
                    membres de votre association dévouée. Il vous ouvre à un monde d’activités variées : affiches,
                    stories Instagram et Twitter et publications de tous types. De quoi prendre plaisir à faire de
                    beaux textes et visuels et échanger un peu de nos idées, nos inspirations, nos passions avec
                    vous.
                </p>
            </div>
            <!-- \/ Pôle Journal \/ -->
            <!-- Auteur : Jade BEAUMONT. -->
            <div class="well">
                <h1>🗞️</h1>
                <h3>Pôle Journal</h3>
                <hr>
                <p class="text-justify retrait">
                    L'association Tribu-Terre possède son propre journal, Omni-Sciences. Il s'agit d'un journal
                    écrit par des étudiants et pour des étudiants. Son but est d'être une plateforme de diffusion de
                    vulgarisation scientifique mais aussi de promotion de la vie étudiante. Le projet est né en
                    Janvier 2019 et depuis, nous sortons un numéro tous les mois.
                </p>
                <p class="text-justify retrait">
                    Ces journaux sont disponibles à la fois en version papier dans divers points de distributions
                    (BU, Bâtiment S, local de l'association, etc...) mais aussi en version numérique, publiée sur
                    les réseaux sociaux et <a href="<?php echo RACINE . 'journaux/' ?>">dans la rubrique
                    "Journaux" du site internet</a>.
                </p>
                <p class="text-justify retrait">
                    Si vous aussi vous souhaitez mettre la main à la pâte et apporter votre contribution au journal,
                    que ce soit pour une seule fois ou régulièrement, alors contactez notre équipe à l'adresse mail
                    suivante :
                </p>
                <div id="mailJournal_div" style="word-wrap: break-word;">
                    <p id="mailJournal_base64" class="text-justify retrait">
                        dHJpYnV0ZXJyZS5qb3VybmFsQGdtYWlsLmNvbQ==
                    </p>
                </div>
                <div class="text-center">
                    <button
                        id="mailJournal_button"
                        class="btn btn-danger text-center"
                        onclick="decoder('mailJournal');"
                    >
                        Cliquer pour décrypter
                    </button>
                </div>
                <p class="text-justify retrait">
                    Vous pouvez écrire sur n'importe quel sujet qui ait un rapport avec la vulgarisation
                    scientifique ou la vie étudiante. Et si jamais vous avez besoin d'aide pour trouver un sujet ou
                    même écrire votre article, l'équipe d'Omni-Sciences est là pour ça !
                </p>
            </div>
            <!-- \/ Pôle Informatique \/ -->
            <!-- Auteur : Romain MARTINS & Anaël BARODINE. -->
            <div class="well">
                <h1>💻</h1>
                <h3>Pôle Informatique</h3>
                <hr>
                <p class="text-justify retrait">
                    Le pôle informatique de votre association a pour but d’apporter un soutien par la mise en place
                    d’outils numériques aux différentes activités de l’association. C'est ce dernier qui œuvre
                    notamment à la gestion (création, mise en ligne et maintenance) du site internet que vous
                    consultez en ce moment même !
                </p>
                <p class="text-justify retrait">
                    Mais ce pôle est encore très jeune ! Il a été créé en 2019, portant des projets encore vagues,
                    mais qui ont su se concrétiser au cours des mois qui suivirent. Les objectifs du pôle
                    informatique sont voués à changer en dépendant des besoins du bureau de Tribu-Terre, ainsi que
                    des compétences de développement des membres le composant. Mais quels que soient les objectifs,
                    ils se ramèneront toujours à apporter plus à nos chers camarades étudiants !
                </p>
                <p class="text-justify retrait">
                    Enfin, il permet d'ouvrir un accès vers l’associatif aux étudiants en informatique. Tribu-Terre
                    étant l'Association des Étudiants en Science de l'Université d'Orléans, toutes les filières
                    peuvent y être représentées !
                </p>
            </div>
        </div>
    </div>
</div><br>