<?php

namespace App\Controller;
use App\Model\MemberManager;
use App\Model\TopicsManager;


class MemberController
{
   private $member;
   private $topic;


    public function __construct()
    {
        $this->member = new MemberManager();
        $this->topic = new TopicsManager();
    }


    public function checkUsername ($username){


        $checkUsername = $this->member->checkUsername($username);

        if ($checkUsername){
            echo " Ce pseudo est déjà utilisé!";

        } else {
            echo  "Pseudo validé!";
        }
    }

    public function checkEmail ($email){


        $checkEmail = $this->member->checkEmail($email);

        if ($checkEmail){
            echo "Cet email est déjà utilisé!";

        } else {
            echo "Email validé!";
        }
    }

    public function checkLogin($username){


        $checkUsername = $this->member->checkUsername($username);

        if ($checkUsername){
            echo "Pseudo correct!";

        } else {
            echo  "Pseudo erroné!";
        }
    }

    public function addMember($email,$password,$username,$name,$surname,$cp,$city)
    {
        $member = $this->member-> newMember($email, $password, $username, $name, $surname, $cp, $city);

         if ($member) {
             $_SESSION['connected'] = true;
             echo "Vous etes maintenant inscrit(e)!";
         } else {
             echo "Ce membre ne peut etre ajouté!";
         }

    }

    function connectAsMember($username,$password)
    {
        $member = $this->member->checkMember($username,$password);

        if ($member) {
            $_SESSION['connected'] = true;
            $_SESSION['id'] = $member['m_id'];
            $_SESSION['username'] = $member['m_username'];
            $_SESSION['status'] = $member['status'];
            header('Location: index.php?action=m_profile&id='.$_SESSION['id']);

        } else  {
            header('Location:index.php?action=connect');
            $error=  'Identifiants incorrects!';
        }

        include 'app/view/connection.php';
    }

    public function showMemberInfos($memberId)
    {
        $member = $this->member->getMemberInfos($memberId);
        $topics = $this->topic->getAllTopicsByAuthor();
        $comments = $this->topic->countCommentsByAuthor();

        include 'app/view/forum/profilePage.php';

    }

    public function showUpdatePage($memberId)
    {
        $member = $this->member->getMemberInfos($memberId);

        include 'app/view/forum/editMember.php';
    }

    public function updateMember($email, $password,$password_confirm, $username, $name, $surname, $cp, $city, $date, $id)
    {

        $member = $this->member->editMemberProfile($email, $password, $username, $name, $surname, $cp, $city,$date,$id);

        if ($member){
            header('Location: index.php?action=m_profile&id='.$id);
        } else{
            $error ='Impossible de modifier vos informations !';
        }
        include 'app/view/forum/editMember.php';
    }

    public function deleteAccount($memberId)
    {
        $deletedMember = $this->member->removeMember($memberId);

        if ($deletedMember == 0){
            header('Location: index.php?action=disconnect');
        }else{
            $error ='Impossible de supprimer ce membre !';
        }

        include 'app/view/forum/profilePage.php';

    }

    public function deleteMember($memberId)
    {
        $deletedMember = $this->member->removeMember($memberId);

        if ($deletedMember == 0){
            header('Location: index.php?action=allMembers');
        }else{
            $error ='Impossible de supprimer ce membre !';
        }

        include 'app/view/forum/profilePage.php';

    }

    public function showAllMembersInfos($current_page, $limit)
    {
        $members = $this->member->getAllMembers($current_page, $limit);
        $count = $this->member->countMembers();

        include 'app/view/forum/adminMembers.php';
    }

    public function setAsAdmin($memberId)
    {
        $status = $this->member->changeStatus($memberId);

        if($status){
            header('Location: index.php?action=allMembers');
            $_SESSION['message']='Vous avez un nouvel administrateur!';
        }else{
            $_SESSION['message']="Le statut n' a pas été modifié!";
        }

        include 'app/view/forum/adminMembers.php';
    }

    public function logOut()
    {
        session_destroy();
        header('Location:index.php');
    }
}





