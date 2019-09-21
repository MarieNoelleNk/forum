<?php $title = 'Edition de commentaire';
ob_start();
;?>

    <section>


        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6 offset-sm-3 pt-5">

                    <div class="card">
                        <div class="card-header text-center">
                            Vous pouvez modifier votre commentaire.
                        </div>
                        <div class="card-body">

                            <p class="text-center pt-2">
                                <?php
                                if(isset($error)){
                                    echo '<div class="alert alert-danger text-center">'.$error.'</div>';
                                }
                                ?>
                            </p>

                            <form action="index.php?action=editComment&amp;comId=<?= $selectedComment['com_id']?>" method="post">


                                <fieldset class="form-group">
                                    <label for="com_content">Votre commentaire</label>
                                    <textarea name="com_content" id="com_content" class="form-control"><?= $selectedComment['com_content']?>
                                </textarea>
                                </fieldset>

                                <input type="hidden" name="com_subcatId" value="<?= $selectedComment['com_subcat_id']?>">

                                <input type="hidden" name="com_subjectId" value="<?= $selectedComment['com_subject_id']?>">

                                <input type="hidden" name="com_author" value="<?= $selectedComment['com_author']?>">

                                <button type="submit" class="btn btn-primary">Modifier</button>

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

<?php
