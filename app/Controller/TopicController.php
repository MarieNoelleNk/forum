<?php


namespace App\Controller;
use App\Model\TopicsManager;

class TopicController
{
    private $topic;

    public function __construct()
    {
        $this->topic = new TopicsManager();
    }

    /*----------------------------------   SUJETS  ----------------------------------------------------------------*/

    public function createSubject( $catId, $subcatId, $memberId, $name,$description)
    {
        $newSubject = $this->topic->newSubject( $catId,$subcatId, $memberId, $name,$description);

        if($newSubject){
            header("Location:index.php?action=topics&cat_id=".$catId."&subcat_id=".$subcatId);
        } else{
            $error = "Impossible d'ajouter ce sujet";
        }

        include 'app/view/forum/topicsPage.php';
    }

    public function showSingleTopic($topicId)
    {

        $subject= $this->topic->getSingleTopic($topicId);
        $comments = $this->topic->getCommentsAndAuthors($topicId);

        include 'app/view/forum/singleTopic.php';

    }

    public function showSubjectsByAuthor($author)
    {

        $topics =$this->topic->getAllTopicsByAuthor();
        $topics->execute(array($author));
        $comments =$this->topic->countTopicComments();
        include 'app/view/forum/topicsByAuthor.php';

    }


    public function showSubjectsByCategories($catId)
    {

        $topics =$this->topic->getTopicsByCategories($catId);
        $comments =$this->topic->countTopicComments();
        include 'app/view/forum/topicsPage.php';

    }

    public function showSubjectsByCategoriesAndSubcategories($catId,$subcatId)
    {

        $topics =$this->topic->getTopicsByCategoriesAndSubcategories($catId,$subcatId);
        $comments =$this->topic->countTopicComments();

        include 'app/view/forum/topicsPage.php';

    }


    public function deleteSubject($topicId,$catId,$subcatId)
    {
        $deletedSubject = $this->topic->removeSubject($topicId);

        if($deletedSubject == 0){
             header("Location:index.php?action=topics&cat_id=".$catId."&subcat_id=".$subcatId);
        } else{
            $error = "Impossible de supprimer ce sujet";
        }
    }

    /*----------------------------------   COMMENTS  ----------------------------------------------------------------*/

    public function addComment( $subcatId,$topicId, $author,$content){

        $newComment = $this->topic->newComment($subcatId,$topicId, $author,$content);

        if($newComment){
            header("Location:index.php?action=singleTopic&topicId=".$topicId);
        } else{
            $error = "Impossible d'ajouter ce commentaire";
        }
    }

    public function showComment($comId){

        $selectedComment = $this->topic->getSingleComment($comId);

        include 'app/view/forum/editComment.php';
    }

    public function showCommentsByAuthor($author)
    {

        $comments =$this->topic->getAllAuthorComments();
        $comments->execute(array($author));
        include 'app/view/forum/commentsByAuthor.php';

    }

    public function updateComment($comId,$subcatId,$topicId, $author,$content){

        $comment = $this->topic->editComment($subcatId,$topicId, $author,$content,$comId);

        if ($comment){
            header('Location: index.php?action=singleTopic&topicId='.$topicId);
        } else{
            $error ='Impossible de modifier votre commentaire !';
        }

        include 'app/view/forum/singleTopic.php';
    }

    public function deleteComment($commentId,$topicId)
    {
        $deletedCom = $this->topic->removeComment($commentId);

        if($deletedCom == 0){
            header("Location:index.php?action=singleTopic&topicId=".$topicId);
        } else{
            $error = "Impossible d'effacer ce commentaire";
        }
    }
}