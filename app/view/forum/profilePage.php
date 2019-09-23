<?php $title='Profil';
ob_start();
;?>

<section>

    <h4 class="text-center pt-5">
        Bienvenue sur votre espace membre <strong> <?= ucfirst($member['m_username']);  ?> </strong>
    </h4>

    <div class="table-responsive pt-5">
        <table class="table table-hover text-center">
            <thead class="thead_light">
            <tr>
                <th>Caracteristiques</th>
                <th>Informations</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Votre nom</td>
                    <td> <?= $member['m_name'];  ?></td>
                </tr>
                <tr>
                    <td>Votre prenom</td>
                    <td><?= $member['m_surname'];  ?></td>
                </tr>
                <tr>
                    <td>Votre email</td>
                    <td><?= $member['m_email'];  ?></td>
                </tr>
                <tr>
                    <td>Votre ville</td>
                    <td><?= $member['m_city'];  ?></td>
                </tr>
                <tr>
                    <td>Votre date d'inscription</td>
                    <td><?= $member['created'];  ?></td>
                </tr>
                <tr>
                    <td>Sujets publiés</td>
                    <td>
                        <?php
                        //Compter le nombre de sujets créés
                        $topics->execute(array($member['m_id']));
                        $created_topics = $topics->rowCount();

                        if ($created_topics > 0):?>

                            <a href='index.php?action=topicAuthor&amp;author=<?= $member['m_id']?>'>
                                <?=$created_topics?>
                            </a>

                         <?php else: ?>
                            Pas de sujet publié.

                         <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Commentaires ajoutés</td>
                    <td>
                        <?php
                        //Compter le nombre de commentaires

                        $comments->execute(array($member['m_id']));
                        $created_comments = $comments->rowCount();

                        if ($created_comments > 0):?>

                            <a href='index.php?action=commentsAuthor&amp;author=<?= $member['m_id']?>'>
                                <?=$created_comments?>
                            </a>

                        <?php else: ?>

                            Pas de commentaire ajouté.

                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>




    <div class="text-center pt-3">
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 2 || $_SESSION['id'] === $member['m_id']):?>

            <a class="btn btn-primary" href="index.php?action=m_edit&amp;id=<?= $member['m_id'];  ?>">Modifier mes informations</a>
            <a class="btn btn-success" href="index.php?action=forum">Acceder au forum</a>
        <?php endif;?>

            <a class="btn btn-danger" href="index.php?action=accountDelete&amp;id=<?= $member['m_id'];  ?>">
                Supprimer
                <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1 && $_SESSION['id'] != $member['m_id']):?>
                    ce profil
                <?php else :?>
                    mon profil
                <?php endif;?>
            </a>


        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1):?>

              <a class="btn btn-warning" href="index.php?action=allMembers">Afficher tous les membres</a>

        <?php endif;?>
    </div>



</section>

<?php
$content = ob_get_clean();
require 'template.php';
?>