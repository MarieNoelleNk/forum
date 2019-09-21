<?php


namespace App\Model;


class ForumManager extends Crud
{
    /*----------------------- CATEGORIES -------------------------------*/

    public function newCategory ($author, $name)
    {
        $data = array(
            'member_id' => $author,
            'cat_name' => $name
        );

        $result = $this->insert("categories", $data);
        if ($result) {
            header('Location:index.php?action=forum');
        } else {
            echo "Impossible de creer cette catégorie!";
        }
    }

    public function getCategoryInfos($catId)
    {

        $category = $this->selectOneElement("categories","cat_id");
        $category->execute(array($catId));
        $result = $category->fetch();
        return $result;
    }

    public function getAllCategories()
    {
        $request = $this->selectAll('categories');
        return $request;
    }

    public function editCategory($author, $name, $catId)
    {

        $fields = array(
            'member_id' => $author,
            'cat_name' => $name,
            'cat_id'=> $catId
        );

        $newMember =$this->update("categories",$fields,"cat_id", $catId);
    }

    public function removeCategory($catId){

        $delete = $this->delete("categories", "cat_id", $catId);

    }

    /*-------------------------- SUBCATEGORIES  --------------------------------------*/

    public function newSubcategory( $catId, $author, $name, $description)
    {
        $data = array (
            'subcat_catId'=> $catId,
            'member_id'=> $author,
            'subcat_name'=>$name,
            'subcat_description'=>$description

        );

        $newSubcat = $this->insert("subcategories",$data);
        if($newSubcat){
            return true;
        } else{
            return false;
        }

    }

    public function getSubcategoryInfos($subcatId) {

        $subcategory = $this->selectOneElement("subcategories","subcat_id");
        $subcategory->execute(array($subcatId));
        $result = $subcategory->fetch();
        return $result;
    }

    public function editSubcategory($catId, $author, $name, $description, $subcatId)
    {

        $fields = array(

            'subcat_catId'=> $catId,
            'member_id'=> $author,
            'subcat_name'=>$name,
            'subcat_description'=>$description,
            'subcat_id'=> $subcatId
        );

        $newMember =$this->update("subcategories",$fields,"subcat_id",$subcatId);
    }

    public function allSubcategoriesByCategories()
    {
        $query = $this->database->query("SELECT categories.cat_id,cat_name, 
        subcategories.subcat_id,subcat_name,subcat_description,
         m_username,m_id 
         FROM categories 
         LEFT JOIN subcategories ON categories.cat_id = subcategories.subcat_catId 
         LEFT JOIN members ON members.m_id = subcategories.member_id 
         ORDER BY categories.cat_id,subcat_id ");
        return $query;
    }


    public function removeSubcategory($subcatId)
    {
        $delete = $this->delete("subcategories", "subcat_id", $subcatId);

    }
}