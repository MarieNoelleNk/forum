<?php $title="Accueil" ?>

<?php  ob_start();?>



<!-- SLIDER -->
<section id="slider">
    <div class="bd-example">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main_slider" data-slide-to="0" class="active"></li>
                <li data-target="#main_slider" data-slide-to="1"></li>
                <li data-target="#main_slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="public/images/group1-unsplash1.jpg" class="d-block img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Orcandie pour tous</h5>
                        <p>Un groupe d'entraide et de solidarité.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="public/images/group2-unsplash.jpg" class="d-block img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Orcandie au quotidien</h5>
                        <p>Un groupe d'échange et de partage.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="public/images/group3-unsplash.jpg" class="d-block img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Orcandie et vous</h5>
                        <p> Un groupe de bénévoles dynamiques.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                <span>  <img src="public/images/back.png" alt="previous button"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                <span>  <img src="public/images/next.png" alt="next button"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>


<!-- A propos -->
<section id="about">
    <div class="jumbotron-fluid">
        <h1 class="pb-4">A propos</h1>
        <p class="text-center">L'association handisport existe depuis plus de 30ans. Initialement crée dans un but purement sportif, elle a aujourd'hui diversifié ses actions
            afin d'allier le bien-être du corps au bien-être de l'esprit.</p>
        <p class="text-center"><a class="btn btn-success btn-lg center-block" href="#" role="button">En savoir plus</a></p>
    </div>

</section>
<!--  Activites   -->
<section id="activities">
    <div class="container">
        <h1 class="pb-4">Nos activités</h1>
        <div class="row activities">

            <div class="col-md-4 text-center">
                <div class="icon">
                    <img src="public/images/swim.png" alt="image de nageur">
                </div>
                <h3>Natation</h3>
                <p> Les séances se tiennent tous les samedis dans un centre aquatique privatisé pour le groupe.
                </p>
            </div>

            <div class="col-md-4 text-center">
                <div class="icon">
                    <img src="public/images/party-50.png" alt="image de danseurs">
                </div>
                <h3>Soirées</h3>
                <p> Les soirées à thème sont organisées à fréquence régulière, le samedi soir.</p>
            </div>

            <div class="col-md-4 text-center">
                <div class="icon">
                    <img src="public/images/traveler-50.png" alt="image de voyageur">
                </div>
                <h3>Voyages</h3>
                <p> Une fois par an, l'association propose un week-end de détente hors de la ville et parfois même
                du pays.</p>

            </div>
        </div>
    </div>

</section>
<!-- L'équipe -->
<section id="team">
    <div class="container">
        <h1 class="pb-4">L'équipe </h1>
        <div class="row">
            <div class="col-md-3 profile-pic text-center">
                <div class="img-box">
                    <img src="public/images/woman2.jpg" class="img-responsive" alt="la presidente">
                </div>
                <h2>Myriam C.</h2>
                <h3>Presidente</h3>
                <p>Sa mission est de superviser toutes les actions de l'association.</p>
            </div>
            <div class="col-md-3 profile-pic text-center">
                <div class="img-box">
                    <img src="public/images/woman.jpg" class="img-responsive" alt="la presidente">

                </div>
                <h2>Annick C.</h2>
                <h3>Coordonnatrice</h3>
                <p>Sa mission est de gérer les encadrants de l'association</p>
            </div>
            <div class="col-md-3 profile-pic text-center">
                <div class="img-box">
                    <img src="public/images/unsplash.jpg" class="img-responsive" alt="la presidente">

                </div>
                <h2>Phillipe J.</h2>
                <h3>Responsable logistique</h3>
                <p>Sa mission est de gérer tout ce qui concerne le matériel utilisé.</p>
            </div>
            <div class="col-md-3 profile-pic text-center">
                <div class="img-box">
                    <img src="public/images/girl.jpg" class="img-responsive" alt="la presidente">

                </div>
                <h2>Emilie D.</h2>
                <h3>Trésorière</h3>
                <p>Sa mission est de gérer les comptes de l'association.</p>
            </div>
        </div>
    </div>
</section>

<!--- Abonnement  -->
<section id="price" class="zoomIn">
    <div class="container">
        <h1 class="pb-4">Abonnement</h1>
        <div class="row">
            <div class="col-md-6 col-sm-12 pt-5">

                <div class="card">
                    <div class="card-header text-center">
                        Maisonlaffitte
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Coût annuel: 90euros
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6 pt-5">
                <div class="card">
                    <div class="card-header text-center">
                        Autres villes
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Coût annuel: 100euros
                        </h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!--   FORUM   -->
<section id="forum">
    <div class="container">
        <h1 class="pb-4">Forum  </h1>
        <p class="text-center">(derniers sujets publiés)</p>
        <div class="row pt-5">

            <?php while ($topic = $forumTopics->fetch()):?>
                <div class="col-md-4 text-center">
                    <div class="profile">
                        <img src="public/images/forum.png" alt="materiel d'écriture" class="user">
                        <blockquote>
                            <?= $topic['subject_description']?>
                        </blockquote>
                        <h3> <?= $topic['subject_title']?>
                        </h3>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </div>

</section>

<!--  CONTACT  -->
<section id="contact">
    <div class="container">
        <h1 class="pb-4">Nous joindre</h1>
        <div class="row">
            <div class="col-md-6 offset-3 contact-info">
                <div class="form-control text-center">
                    <b>Adresse: 2 place des rossignols   </b>
                </div>
                <div class="form-control text-center">
                    <b>Email: orcandie@gmail.com   </b>
                </div>
                <div class="form-control text-center">
                    <b>Tel: 06 01 01 02 45   </b>
                </div>

            </div>
        </div>
    </div>
</section>

<?php $content= ob_get_clean();?>

<?php require('template.php') ?>
