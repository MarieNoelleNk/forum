<?php $title = 'Edition de profil';
ob_start();
;?>

<section>

    <h1>Modifier votre profil</h1>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6 offset-sm-3 pt-5">

                <div class="card">
                    <div class="card-header text-center">
                        Vous pouvez modifier le formulaire.
                    </div>
                    <div class="card-body">

                        <p class="text-center pt-2">
                            <?php
                            if(isset($error)){
                                echo '<div class="alert alert-danger text-center">'.$error.'</div>';
                            }
                            ?>
                        </p>

                        <form action="index.php?action=checkUpdate&amp;id=<?= $member['m_id'];?>" method="post" >

                            <fieldset class="form-group">
                                <label for="surname">Prenom</label>
                                <input type="text" name="m_surname" id="surname" class="form-control" value="<?= $member['m_surname'];?>">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" name="m_name" id="name" class="form-control" value="<?= $member['m_name'];?>">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="username">Pseudo</label>
                                <input type="text" name="m_username" id="username" class="form-control" value="<?= $member['m_username'];?>">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="m_email" id="email" class="form-control" value="<?= $member['m_email'];?>">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="m_password" id="password" class="form-control">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="password_confirm">Confirmez votre mot de passe</label>
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="email">Code postal</label>
                                <input type="number"  name="m_cp" id="email" class="form-control" value="<?= $member['m_cp'];?>">
                            </fieldset>

                            <fieldset class="form-group">
                                <label for="city">Ville</label>
                                <input type="text" name="m_city" id="city" class="form-control" value="<?= $member['m_city'];?>">
                            </fieldset>

                            <input type="hidden" name="m_inscriptionDate" value="<?= $member['created'];?>">


                            <input type="submit" name="register" class="btn btn-success" value="Sauvegarder">



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

