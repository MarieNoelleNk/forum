<?php $title = "commentaires selon l'auteur"; ?>

<?php  ob_start();?>

<section class="pt-5 pl-4 pr-4">

    <table class="table table-striped">

        <thead class="thead_light">

        <tr>
            <th class="text-center">Commentaires</th>
            <th class="text-center">Sujet</th>
            <th class="text-center">Date de création</th>

        </tr>

        </thead>

        <tbody>

        <?php

            while($data = $comments->fetch()):

        ?>

            <tr class="text-center">

                <td data-title="Commentaire"> <?= $data['com_content']; ?> </td>

                <td data-title="Sujet">

                    <a href="index.php?action=singleTopic&amp;topicId=<?= ucfirst($data['com_subject_id']); ?>">
                        <?= $data['subject_title']; ?>
                    </a>
                </td>

                <td data-title="Date de creation">  Créé le <?= $data['com_date']; ?> </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</section>

<?php $content= ob_get_clean();?>

<?php require('template.php') ?><?php

