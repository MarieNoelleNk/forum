<?php $title = 'Registration';
ob_start();
;?>

<section>

    <h1>
        <span> <img src="public/images/registration.png" width="45" alt="icone"></span>
        Inscription
    </h1>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6 offset-sm-3 pt-5">

                <div class="card">
                    <div class="card-header text-center">
                        Veuillez remplir le formulaire ci dessous pour vous enregistrer.
                    </div>
                    <div class="card-body">

                        <form id="registration" method="post" >

                            <fieldset class="form-group">
                                <label for="surname">
                                    <span> <img src="public/images/name.png" width="25" alt="icone"></span>
                                    Prenom
                                </label>
                                <input type="text" name="m_surname" id="surname" class="form-control" required>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="name">
                                    <span><img src="public/images/name.png" width="25" alt="icone"></span>
                                    Nom
                                </label>
                                <input type="text" name="m_name" id="name" class="form-control" required>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="username">
                                    <span> <img src="public/images/user.png" width="25" alt="icone"></span>
                                    Pseudo
                                </label>
                                <input type="text" name="m_username" id="username" class="form-control" required
                                onchange="checkUsername()">
                                <div class="error-username"></div>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="email">
                                    <span> <img src="public/images/email.png" width="25" alt="icone"></span>
                                    Email
                                </label>
                                <input type="email" name="m_email" id="email" class="form-control" required
                                   onchange="checkEmail()">
                                <div id="error-email"></div>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="password">
                                    <span> <img src="public/images/password.png" width="25" alt="icone"></span>
                                    Mot de passe
                                </label>
                                <input type="password" name="m_password" id="password" class="form-control" required>
                                <div class="error-message"></div>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="password_confirm">
                                    <span> <img src="public/images/password.png" width="25" alt="icone"></span>
                                    Confirmez votre mot de passe
                                </label>
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
                                <div class="error-message"></div>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="postal_code">
                                    <span> <img src="public/images/post.png" width="25" alt="icone"></span>
                                    Code postal
                                </label>
                                <input type="number" name="m_cp" id="postal_code" class="form-control" required>
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="city">
                                    <span> <img src="public/images/city.png" width="25" alt="icone"></span>
                                    Ville
                                </label>
                                <input type="text" name="m_city" id="city" class="form-control" required>
                            </fieldset>

                            <input type="submit" name="register" class="btn btn-success" value="s'inscrire">

                            <div id="notification" class="text-center pt-4"> </div>
                            <div id="success" class="text-center"></div>

                            <p class="pt-3">
                                Déjà inscrit? <a href="index.php?action=connect">connectez vous</a>
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
