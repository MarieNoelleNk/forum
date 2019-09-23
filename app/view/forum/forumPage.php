<?php $title = "Accueil du forum";

$cat = 0;
  ob_start();?>

<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1):?>
    <div class="text-center pt-4 pb-5">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ajouter une catégorie</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subCategory" data-whatever="@mdo">Ajouter une sous-catégorie</button>
    </div>
<?php endif;?>


<!-- Ajouter une catégorie -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Nouvelle catégorie  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="index.php?action=addCat" method="post">

                    <fieldset class="form-group">
                        <label for="catName">Nom de la catégorie</label>
                        <input type="text" name="cat_name" id="catName" class="form-control">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="cat_description">Description</label>
                        <textarea name="cat_description" id="cat_description" class="form-control"></textarea>
                    </fieldset>

                    <input type="hidden" name="member_id" value="<?= $_SESSION['id']?>">
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


<!-- Ajouter une sous-categorie -->

<div class="modal fade" id="subCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Nouvelle sous-catégorie  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form action="index.php?action=addSubcat" method="post">

                    <fieldset class="form-group">
                        <label for="subcatName">Nom de la sous-catégorie</label>
                        <input type="text" name="subcat_name" id="subcatName" class="form-control">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="catId">Categorie</label> <br>
                        <select name="category" id="catId">
                            <?php while($list = $categories_list->fetch()) { ?>
                                <option value="<?= $list['cat_id'] ?>"><?= $list['cat_name'] ?></option>
                            <?php } ?>
                        </select>
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="subcat_description">Description</label>
                        <textarea name="subcat_description" id="subcat_description" class="form-control"></textarea>
                    </fieldset>

                    <input type="hidden" name="member_id" value="<?= $_SESSION['id']?>">
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


    <table class="table table-hover table-striped pt-5">

        <?php

        if(isset($error)){
            echo '<div class="alert alert-success text-center">'.$error.'</div>';
        } elseif (isset ($_SESSION['message'])){
            echo '<div class="alert alert-success text-center">'.$_SESSION['message'].'</div>';

        }

        while ($data = $categories->fetch()):

            //Compter le nombre de sujets par sous-categorie
            $countTopics->execute(array($data['subcat_id']));
            $topics = $countTopics->rowCount();

            //Recuperer le dernier message posté par sous-categorie
            $lastComment->execute(array($data['subcat_id']));
            $message = $lastComment->fetch();

            if($cat != $data['cat_id']):

                $cat = $data['cat_id'];

        ?>

            <thead class="thead_light">

                 <tr>

                     <th class="text-center">

                         <h4>

                         <a href="index.php?action=topics&amp;cat_id=<?= $data['cat_id'] ?>" class="forum_link">
                             <?= $data['cat_name'];?>
                         </a>

                             <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1):?>
                                 <a href="index.php?action=deleteCat&amp;catId=<?= $data['cat_id'] ?>"><img src="public/images/cancel.png" alt="bouton supprimer" width=20></a>
                             <?php endif;?>
                         </h4>

                     </th>

                     <th class="text-center"> Sujets </th>

                     <th class="text-center">Dernier message</th>

                </tr>

            </thead>

            <?php endif; ?>

            <tbody>

                <tr class="text-center">

                    <td data-title="Categories">

                        <strong>
                            <a href="index.php?action=topics&amp;cat_id=<?= $data['cat_id'];?>&amp;subcat_id=<?= $data['subcat_id'];?>" > <?= $data['subcat_name']; ?> </a>

                            <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 1 && !empty($data['subcat_name'])):?>

                                <a href="index.php?action=deleteSubcat&amp;subcatId=<?= $data['subcat_id'] ?>"><img src="public/images/cancel.png" alt="bouton supprimer" width=15></a>

                            <?php endif;?>
                        </strong>

                        <br> <?= $data['subcat_description']; ?>

                    </td>

                    <td data-title="Messages"> <?= $topics; ?> </td>

                    <td data-title="Dernier message">

                        <?php if(!empty($message)) {

                            echo $message['created'].'<br> par <strong class="username">'.ucfirst($message['m_username']).'</strong> ';

                        } else {
                            echo 'Pas de message.';
                        }
                        ?>

                    </td>

                </tr>

            </tbody>

            <?php endwhile; ?>

    </table>



<?php $content= ob_get_clean();?>

<?php require('template.php') ?>



