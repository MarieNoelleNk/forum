

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> <?= $title ?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="public/style.css">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
            <a class="navbar-brand" href="#">
                <img src="public/images/logo.png" width="40" height="40" alt="le logo handisport">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span> <img src="public/images/home.png" width="20" alt="icone"></span>
                            ACCUEIL
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=aboutUs">
                            <span> <img src="public/images/about.png" width="20" alt="icone"></span>
                            A PROPOS
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=forum">
                            <span> <img src="public/images/chat.png" width="25" alt="icone"></span>
                            LE FORUM
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=localisation">
                            <span> <img src="public/images/map.png" width="25" alt="icone"></span>
                            LOCALISATION
                        </a>
                    </li>
                    <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] == true): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=m_profile&id=<?= $_SESSION['id'];?>" >
                                <span> <img src="public/images/name.png" width="25" alt="icone"></span>
                                MON PROFIL
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=disconnect" >
                                <span> <img src="public/images/disconnected.png" width="25" alt="icone"></span>
                                DECONNEXION
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>
        </nav>


        <!-- section -->

        <?= $content ?>
        <script src="public/js/verification.js"></script>
        <script src="public/js/registration.js"></script>
        <!-- footer -->
        <footer class="container-fluid bg-dark text-white-20">

            <a href="https://icons8.com/icon/9777/swimming">icon by Icons8</a>
        </footer>

    </body>

</html>