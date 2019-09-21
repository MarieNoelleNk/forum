<?php

namespace App\Controller;
use App\Model\ForumManager;
use App\Model\TopicsManager;

class ForumController
{
    private $forum;
    private $topics;

    public function __construct()
    {
        $this->forum= new ForumManager();
        $this->topics = new TopicsManager();
    }

    // Accueil du forum

    public function showForumPage()
    {
        $categories_list = $this->forum->getAllCategories();
        $categories = $this->forum->allSubcategoriesByCategories();
        $lastComment = $this->topics->getLastComment();
        $countTopics = $this->topics->countSubjectsInSubcategories();

        include 'app/view/forum/forumPage.php';

    }

 /*-------------------------------  CATEGORY ---------------------------------------*/
    public function addCategory( $author, $name)
    {

        $result = $this->forum->newCategory($author, $name);

        if ($result){
            header('Location:index.php?action=forum');
        } else {
            echo "Cette catégorie ne peut être ajoutée!";
        }

    }

    public function updateCategory($catId,$author, $name)
    {
        $selectedCat = $this->forum->getCategoryInfos($catId);
        $updatedCat = $this->forum->editCategory($author, $name,$catId);

        include 'app/view/forum/forumPage.php';
    }

    public function deleteCategory($catId)
    {
        $deletedCat = $this->forum->removeCategory($catId);

        if($deletedCat == 0){
             header("Location:index.php?action=forum");
        } else{
            $error = "Impossible de supprimer cette catégorie";
        }
    }

    /*-------------------------------  SUBCATEGORY ---------------------------------------*/

    public function addSubcategory( $catId, $author, $name, $description)
    {

        $result = $this->forum->newSubcategory( $catId, $author, $name, $description);

        if ($result){
            header('Location:index.php?action=forum');
        } else {
            echo " Cette sous-catégorie ne peut etre créée";
        }

    }

    public function updateSubcategory($catId, $author, $name, $description, $subcatId)
    {
        $selectedCat = $this->forum->getSubcategoryInfos($subcatId);
        $updatedCat = $this->forum->editSubcategory($catId, $author, $name, $description, $subcatId);

        include 'app/view/forum/forumPage.php';
    }

    public function deleteSubcategory($subcatId)
    {
        $deletedCat = $this->forum->removeSubcategory($subcatId);

        if($deletedCat == 0){
            header("Location:index.php?action=forum");
        } else{
            $error = "Impossible de supprimer cette catégorie";
        }
    }


}