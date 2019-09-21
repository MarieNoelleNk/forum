<?php $title = "Liste des sujets"; ?>

<?php  ob_start();?>

<section class="forum_section">

    <?php
     if (isset($_GET['cat_id']) && isset($_GET['subcat_id'])):?>
         <!-- Ajouter un sujet -->
     <div class="text-center pb-5">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ajouter un nouveau sujet</button>
     </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Nouveau sujet  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="index.php?action=addTopic&amp;cat_id=<?= $_GET['cat_id']; ?>&amp;subcat_id=<?= $_GET['subcat_id']; ?>" method="post">

                        <fieldset class="form-group">
                            <label for="topicName">Nom</label>
                            <input type="text" name="topic_name" id="topicName" class="form-control">
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="topic_description">Description</label>
                            <textarea name="topic_description" id="topic_description" class="form-control"></textarea>
                        </fieldset>

                        <input type="hidden" name="member_id" value="<?= $_SESSION['id'];?>">
                        <button type="submit" class="btn btn-primary">Ajouter</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->

     <?php endif; ?>

    <table class="table table-striped">

        <thead class="thead_light">

            <tr>
                <th class="text-center">Sujets</th>
                <th class="text-center">Messages</th>
                <th class="text-center">Date de création</th>

            </tr>

        </thead>

        <tbody>

        <?php
        while($data = $topics->fetch()):

            //Compter le nombre de messages par sujet
            $comments->execute(array($data['subject_id']));
            $totalComments = $comments->rowCount();

            ?>

            <tr class="text-center">

                <td data-title="Sujets">
                    <p>
                        <a href="index.php?action=singleTopic&amp;topicId=<?= $data['subject_id']; ?>">
                            <?= ucfirst($data['subject_title']); ?>
                        </a> <br>
                        <?= $data['subject_description']; ?>

                    </p>

                </td>

                <td data-title="Messages"> <?= $totalComments; ?> </td>

                <td data-title="Date de creation">  Créé le <?= $data['topic_date']; ?> par <strong><?= ucfirst($data['m_username']); ?></strong>  </td>
            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>
</section>

<?php $content= ob_get_clean();?>

<?php require('template.php') ?>



