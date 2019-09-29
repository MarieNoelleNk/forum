<?php $title = "Connexion";
ob_start();?>



<section>

    <h1>
        <span> <img src="public/images/internal.png" width="60" alt="image de connexion"></span>
        Connexion
    </h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 pt-5">

                <div class="card">
                    <div class="card-header text-center">
                        Veuillez remplir tous les champs.
                    </div>

                    <div class="card-body">

                        <?php
                        if(!empty($error)){
                            echo '<div class="alert alert-danger text-center">'.$error.'</div>';
                        }
                        ?>

                        <form action=index.php?action=checkLogin id="login_form" method="post">

                            <fieldset class="form-group">
                                <label for="username">
                                    <span> <img src="public/images/user.png" width="25" alt="icone"></span>
                                    Pseudo
                                </label>
                                <input type="text" name="m_username" id="username" class="form-control" required onchange="checkLogin()">
                                <div class="error-username"></div>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="member_password">
                                    <span> <img src="public/images/password.png" width="25" alt="icone"></span>
                                    Mot de passe
                                </label>
                                <input type="password" name="m_password" id="m_password" class="form-control" required>
                            </fieldset>


                            <input type="submit" id="connect" name="connect" class="btn btn-success" value="se connecter">
                            <p class="form_message pt-2">

                            </p>
                            <p class="pt-5">
                                Pas encore inscrit? <a href="index.php?action=register">inscrivez vous</a>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>

</section>

<?php

$content = ob_get_clean();

require 'template.php';
?>

