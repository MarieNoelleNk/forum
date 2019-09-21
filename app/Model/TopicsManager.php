<?php


namespace App\Model;

class TopicsManager extends Crud
{
    /*--------------------------    TOPICS  -----------------------------------------*/

    public function newSubject( $catId, $subcatId, $memberId, $title,$description){

        $data = array (
            'subject_cat_id'=> $catId,
            'subject_subcat_id'=> $subcatId,
            'subject_author'=>$memberId,
            'subject_title'=>$title,
            'subject_description'=>$description
        );

        $new_topic= $this->insert("subjects",$data);
        if($new_topic){
            return true;
        } else{
            return false;
        }
    }

    public function getSingleTopic($topicId)
    {
        $request = $this->selectOneElement('subjects', 'subject_id');
        $request->execute(array($topicId));
        $result = $request->fetch();
        return $result;

    }

    public function getAllTopicsByAuthor()
    {
        $request = $this->selectOneElement('subjects', 'subject_author');

        return $request;

    }

    public function countSubjectsInSubcategories()
    {
        $request = $this->database->prepare('SELECT * FROM subjects WHERE subject_subcat_id = ?');

        return $request;
    }

    public function getTopicsByCategories($catId)
    {
        $request = $this->database->prepare("SELECT subject_id, subject_cat_id, subject_subcat_id,
        subject_author, subject_title, subject_description, subjects.created AS topic_date, m_username FROM subjects
        LEFT JOIN subcategories ON subjects.subject_subcat_id = subcategories.subcat_id 
        LEFT JOIN categories ON categories.cat_id = subcategories.subcat_catId 
        LEFT JOIN members ON members.m_id = subjects.subject_author 
        WHERE categories.cat_id = ? ");
        $request->execute(array($catId));
        return $request;

    }

    public function getTopicsByCategoriesAndSubcategories($catId,$subcatId)
    {
        $request = $this->database->prepare("SELECT subject_id, subject_cat_id, subject_subcat_id,
        subject_author, subject_title, subject_description, subjects.created AS topic_date, m_username FROM subjects
        LEFT JOIN subcategories ON subjects.subject_subcat_id = subcategories.subcat_id 
        LEFT JOIN categories ON categories.cat_id = subcategories.subcat_catId 
        LEFT JOIN members ON members.m_id = subjects.subject_author 
        WHERE categories.cat_id = ? AND subcategories.subcat_id=? ORDER BY subject_title");
        $request->execute(array($catId,$subcatId));
        return $request;

    }


    public function getLastSubjects()
    {
        $request = $this->database->query('SELECT subject_title, subject_description FROM subjects ORDER BY subject_id DESC LIMIT 0,3');
        return $request;

    }

    public function removeSubject($topicId){

        $delete = $this->delete("subjects", "subject_id", $topicId);

    }

    /*--------------------------   COMMENTS ----------------------------------------*/

    public function newComment( $subcatd,$topicId, $author,$content){

        $data = array (
            'com_subcat_id'=>$subcatd,
            'com_subject_id'=>$topicId,
            'com_author'=> $author,
            'com_content'=>$content
        );

        $new_topic= $this->insert("comments",$data);
        return $new_topic;
    }

    public function getSingleComment($comId)
    {
        $request = $this->selectOneElement('comments', 'com_id');
        $request->execute(array($comId));
        $result = $request->fetch();
        return $result;

    }

    public function countTopicComments()
    {
        $request = $this->selectOneElement('comments',"com_subject_id");
        return $request;
    }

    public function countCommentsByAuthor()
    {
        $request = $this->selectOneElement('comments', 'com_author');
        return $request;

    }

    public function getAllAuthorComments(){

        $request = $this->database->prepare("SELECT com_id, com_subject_id, com_author,comments.created AS com_date,com_content,subject_title FROM comments
        LEFT JOIN subjects ON com_subject_id = subject_id
        WHERE com_author = ? ORDER BY com_id DESC LIMIT 0,5");
        return $request;

    }

    public function getLastComment(){

        $request = $this->database->prepare("SELECT com_id, com_author,comments.created,com_content,m_username FROM comments
        LEFT JOIN members ON com_author = m_id
        WHERE com_subcat_id =? ORDER BY com_id DESC LIMIT 0,1 ");
        return $request;

    }

    public function getCommentsAndAuthors ($topicId) {

        $comments= $this->database->prepare('SELECT com_id, com_subject_id, com_author, comments.created AS com_date,com_content, m_username FROM comments 
        LEFT JOIN subcategories ON comments.com_subcat_id = subcategories.subcat_id
        LEFT JOIN subjects ON comments.com_subject_id = subjects.subject_id 
        LEFT JOIN members ON comments.com_author = members.m_id 
        WHERE com_subject_id =? ORDER BY comments.created DESC');
        $comments->execute(array($topicId));

        return $comments;
    }

    public function editComment( $subcatd,$topicId, $author,$content,$id){

        $fields = array (
            'com_subcat_id'=>$subcatd,
            'com_subject_id'=>$topicId,
            'com_author'=> $author,
            'com_content'=>$content,
            'com_id'=>$id
        );

        $comment =$this->update("comments",$fields, "com_id",$id);

        if ($comment){
            return true;
        }else{
            return false;
        }
    }

    public function removeComment($commentId)
    {
        $delete = $this->delete("comments", "com_id", $commentId);

    }
}