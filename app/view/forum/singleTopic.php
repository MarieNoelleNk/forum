<?php $title='Sujet';

 ob_start();
  ;?>

    <section class="forum_section bounceInDown">

        <h2 class="text-center">
            <?= ucfirst($subject['subject_title']);
            ?>
            <span>
                <?php if ( $_SESSION['id'] === $subject['subject_author'] || $_SESSION['status'] == 1):?>

                    <a href="index.php?action=deleteTopic&amp;topicId=<?= $subject['subject_id'];?>&amp;catId=<?= $subject['subject_cat_id']; ?>&amp;subcatId=<?= $subject['subject_subcat_id']; ?>" >

                         <button class="btn btn-danger">supprimer</button>
                    </a>

                <?php endif;?>

            </span>
        </h2>
        <p class="text-center">
            <?= $subject['subject_description']; ?>
        </p>

        <p class="text-center">
            Créé le <?= $subject['created']; ?>
        </p>


    <h3 class="text-center"> Reponses </h3>

<?php forEach ($comments as $comment) :?>


    <div class="container">

                <div class="jumbotron">

                    <div >

                        <h4><span class="username"> <?= ucfirst(htmlspecialchars($comment['m_username'])); ?></span></h4>

                        <p>Posté le <?= $comment['com_date']?></p>

                    </div>

                    <p> <?= nl2br(htmlspecialchars($comment['com_content'])); ?></p>

                    <?php if ( $_SESSION['id'] === $comment['com_author']):?>

                        <a href="index.php?action=showComment&amp;comId=<?= $comment['com_id']; ?>" class="text-center">
                            <button class="btn btn-success">
                                <img src="public/images/pencil.png" alt="bouton pour modifier le commentaire" width=30>
                            </button>
                        </a>
                    <?php endif;?>

                    <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1 || $_SESSION['id'] === $comment['com_author'] ):?>

                            <a href="index.php?action=deleteComment&amp;comId=<?= $comment['com_id']; ?>&amp;topicId=<?= $subject['subject_id']; ?>" class="text-center">

                                <button class="btn btn-success"><img src="public/images/cancel.png" alt="bouton pour supprimer le commentaire" width=30></button>

                            </a>
                    <?php endif;?>


                </div>

            </div>

        <?php endforeach;?>

        <!-- Modifier un commentaire -->

        <div class="modal fade" id="editComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="index.php?action=editComment"  method="post">


                            <fieldset class="form-group">
                                <label for="com_content">Votre commentaire</label>
                                <textarea name="com_content" id="com_content" class="form-control">
                                    <?= $selectedComment['com_content']?>
                                </textarea>
                            </fieldset>

                            <input type="hidden" name="com_subcatId" value="<?= $selectedComment['com_subcat_id']?>">

                            <input type="hidden" name="com_subjectId" value="<?= $selectedComment['com_subject_id']?>">

                            <input type="hidden" name="com_author" value="<?= $selectedComment['com_author']?>">

                            <button type="submit" class="btn btn-primary">Modifier</button>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->

        <!--Ajouter un commentaire -->
        <div class="text-center">
            <button type="button"  class="btn btn-success" data-toggle="modal" data-target="#newComment" data-whatever="@mdo">
                Ajouter votre commentaire
            </button>
        </div>


        <div class="modal fade" id="newComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="index.php?action=addComment" method="post">


                            <fieldset class="form-group">
                                <label for="com_content">Votre commentaire</label>
                                <textarea name="com_content" id="com_content" class="form-control"></textarea>
                            </fieldset>

                            <input type="hidden" name="com_subcatId" value="<?= $subject['subject_subcat_id']?>">

                            <input type="hidden" name="com_subjectId" value="<?= $subject['subject_id']?>">

                            <input type="hidden" name="com_author" value="<?= $_SESSION['id']?>">

                            <button type="submit" class="btn btn-primary">Ajouter</button>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php
$content = ob_get_clean();
require 'template.php';
?>