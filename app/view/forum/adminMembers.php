<?php $title = "Gestion des membres"; ?>

<?php  ob_start();?>



<div class="responsive-table-line">

    <h2 class="text-center"> Gestion des membres </h2>

    <table class="table table-hover">
        <?php
        if(isset($_SESSION['message'])){
            echo '<div class="alert alert-success text-center">'.$_SESSION['message'].'</div>';
        }
        ?>
        <thead class="thead_light">
        <tr>
            <th class="text-center">Pseudo</th>
            <th class="text-center">Email</th>
            <th class="text-center">Inscription</th>
            <th class="text-center">Ville</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>

        <tbody>

        <?php
        $limit= 2;
        if(isset($_GET['page']) && $_GET['page']>0){
            $current_page = $_GET['page'];
        } else {
            $current_page = 1;
        }

        $totalMembers = $count->rowCount();
        $totalPages = ceil($totalMembers/$limit);

        while ($member = $members->fetch()): ?>

            <tr class="text-center">

                <td data-title="Pseudo"><?= ucfirst($member['m_username']); ?> </td>
                <td data-title="Email"><?= $member['m_email']; ?></td>
                <td data-title="Inscription"><?= $member['created']; ?></td>
                <td data-title="Ville">
                    <?= $member['m_city']; ?>
                </td>
                <td data-title="Actions">

                    <a class="btn btn-primary" href="index.php?action=m_profile&amp;id=<?= $member['m_id'];  ?>">Afficher ce profil</a>
                    <a class="btn btn-success" href="index.php?action=setAdmin&amp;id=<?= $member['m_id'];  ?>">Changer de statut</a>
                    <a class="btn btn-danger" href="index.php?action=m_delete&amp;id=<?= $member['m_id'];  ?>">Supprimer ce profil</a>
                </td>

            </tr>


        </tbody>

        <?php endwhile;?>


    </table>
    <div class="pagination text-center">
        <p> page
        <?php
        for($i=1;$i<=$totalPages;$i++) {
            if($i == $current_page) {
                echo '<span id="page_active">'.$i.' </span>';
            } else {
                echo ' <a href="index.php?action=allMembers&amp;page='.$i.'" class="page_link">
                <span class="page_design">'.$i.'</span></a> ';
            }
        }
        ?>
        </p>
    </div>
    <div class="admin_tab">

        <a href="index.php" class="btn btn-info" role="button">Retour a laccueil</a>

    </div>
</div>



<?php $content= ob_get_clean();?>

<?php require('template.php') ?>


