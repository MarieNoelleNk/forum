<?php

namespace App;
use App\Controller\HomeController;
use App\Controller\ForumController;
use App\Controller\MemberController;
use App\Controller\TopicController;


class Router
{
    private $homeCtrl;
    private $forumCtrl;
    private $memberCtrl;
    private $topicCtrl;

    public function __construct()
    {
        $this->homeCtrl= new HomeController();
        $this->forumCtrl= new ForumController();
        $this->memberCtrl = new MemberController();
        $this->topicCtrl = new TopicController();
    }

    public function routerRequest ()
    {
        try{

            if (isset($_GET['action'])){

                switch ($_GET['action']) {

        /*------------------------------   GENERALITES  --------------------------------------------------------------*/

                    //afficher la page 'à propos'

                    case 'aboutUs':

                        $this->homeCtrl->showAboutUsPage();

                     break;

                    //afficher la page 'à propos'

                    case 'localisation':

                        $this->homeCtrl->showLocalisationPage();

                     break;

                    //formulaire d'inscription

                    case 'register':

                        $this->homeCtrl->showRegistrationPage();

                     break;

                    //verifier si le pseudo choisi existe déjà

                    case 'username':
                        if (!empty($_GET['username'])){

                        $this->memberCtrl->checkUsername($_GET['username']);}

                    break;

                    //verifier si l'email choisi existe déjà

                    case 'email':

                        if (!empty($_GET['email'])){

                            $this->memberCtrl->checkEmail($_GET['email']);}

                    break;

                     //s'inscrire

                    case 'checkInscription':

                        if (!empty($_POST['m_email']) && !empty($_POST['m_password']) && !empty($_POST['password_confirm']) && !empty($_POST['m_username']) && !empty($_POST['m_name']) && !empty($_POST['m_surname']) && !empty($_POST['m_cp']) && !empty($_POST['m_city'])) {

                            if ( $_POST['m_password'] == $_POST['password_confirm']) {

                                $this->memberCtrl->addMember($_POST['m_email'],$_POST['m_password'],$_POST['m_username'],$_POST['m_name'],$_POST['m_surname'],$_POST['m_cp'],$_POST['m_city']);

                            } else{
                                throw new \Exception('les mots de passe sont différents!');
                            }
                        } else {
                            throw new \Exception('Veuillez remplir tous les champs!');

                        }

                    break;

                     //formulaire de connexion

                    case 'connect':

                        $this->homeCtrl->showLoginPage();

                    break;

                    //verifier si le login existe

                    case 'login':

                        if (!empty($_GET['login'])){

                            $this->memberCtrl->checkLogin($_GET['login']);
                        }

                    break;

                     //se connecter

                    case 'checkLogin':

                        if (!empty($_POST['m_username']) && !empty($_POST['m_password'])){

                            $this->memberCtrl->connectAsMember($_POST['m_username'], $_POST['m_password']);

                        } else {

                            throw new \Exception("Certains champs doivent etre complétés!");
                        }

                     break;

        /*------------------------------- ESPACE MEMBRE -------------------------------------------------------------*/

                    //afficher son profil
                    case 'm_profile':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['id']) && $_GET['id'] > 0) {

                                $this->memberCtrl->showMemberInfos($_GET['id']);

                            } else {

                                throw new \Exception( "Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                         }

                     break;

                        //formulaire d'édition de profil
                    case 'm_edit':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['id']) && $_GET['id'] > 0) {

                                $this->memberCtrl->showUpdatePage($_GET['id']);

                            } else {

                                $error = "Identifiant non attribué!";
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                     break;

                        //Modifier son profil

                    case 'checkUpdate':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['id']) && $_GET['id'] > 0) {

                                if (!empty($_POST['m_email']) && !empty($_POST['m_password']) && !empty($_POST['password_confirm']) && !empty($_POST['m_username']) && !empty($_POST['m_name']) && !empty($_POST['m_surname']) && !empty($_POST['m_cp']) && !empty($_POST['m_city']) && !empty($_POST['m_inscriptionDate'])) {

                                    $this->memberCtrl->updateMember($_POST['m_email'], $_POST['m_password'], $_POST['password_confirm'], $_POST['m_username'], $_POST['m_name'], $_POST['m_surname'], $_POST['m_cp'], $_POST['m_city'],$_POST['m_inscriptionDate'],$_GET['id']);
                                } else {

                                    throw new \Exception("Certains champs doivent etre complétés!");
                                }
                            } else {

                                throw new \Exception("Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;

                        //Supprimer son profil

                    case 'accountDelete':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['id']) && $_GET['id'] > 0) {

                               $this->memberCtrl->deleteAccount($_GET['id']);

                            } else {

                                throw new \Exception("Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;


                    //Se deconnecter

                    case 'disconnect':

                        $this->memberCtrl->logOut();

                     break;

                        /*------------------------------ ACTIONS DE L'ADMINISTRATEUR --------------------------*/

                    //administrateur affiche tous les membres

                    case 'allMembers':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_SESSION['status']) && $_SESSION['status'] == 1){

                                if(isset($_GET['page']) && $_GET['page']>0){
                                    $current_page = $_GET['page'];
                                } else {
                                    $current_page = 1;
                                }

                                $limit = 2;

                                $this->memberCtrl->showAllMembersInfos($current_page,$limit);

                            } else {
                                throw new \Exception( "Seul l'administrateur peut y acceder!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Definir un nouvel administrateur

                    case 'setAdmin':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['id']) && $_GET['id'] > 0) {

                                $this->memberCtrl->setAsAdmin($_GET['id']);

                            } else {

                                throw new \Exception("Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Supprimer un membre

                    case 'm_delete':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['id']) && $_GET['id'] > 0) {

                                $this->memberCtrl->deleteMember($_GET['id']);

                            } else {

                                throw new \Exception("Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //administrateur cree une nouvelle categorie

                    case 'addCat':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (!empty($_POST['member_id']) && !empty($_POST['cat_name']) ) {

                                $this->forumCtrl->addCategory($_POST['member_id'],$_POST['cat_name']);
                            } else {

                                throw new \Exception("Certains champs doivent etre complétés!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Modifier une sous-categorie

                    case 'editCat':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['catId']) &&  $_GET['catId'] > 0 && !empty($_POST['member_id']) && !empty($_POST['cat_name']) ){

                                $this->forumCtrl->updateCategory($_GET['catId'], $_POST['member_id'],$_POST['cat_name']);

                            } else {

                                throw new \Exception( "Cette sous-catégorie est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Supprimer une categorie

                    case 'deleteCat':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if ( isset($_GET['catId']) &&  $_GET['catId'] > 0 ){

                                $this->forumCtrl->deleteCategory($_GET['catId']);

                            } else {

                                throw new \Exception( "Cette catégorie est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;

                    //administrateur cree une nouvelle sous-categorie

                    case 'addSubcat':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (!empty($_POST['category']) &&!empty($_POST['member_id']) && !empty($_POST['subcat_name']) &&  !empty($_POST['subcat_description']) ) {

                                $this->forumCtrl->addSubcategory($_POST['category'],$_POST['member_id'], $_POST['subcat_name'], $_POST['subcat_description'] );
                            } else {

                                throw new \Exception( "Certains champs doivent etre complétés!");
                            }

                            break;

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;

                    //Modifier une sous-categorie

                    case 'editSubcat':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (!empty($_POST['cat_id']) &&!empty($_POST['member_id']) && !empty($_POST['subcat_name']) &&  !empty($_POST['subcat_description']) && isset($_GET['subcatId']) &&  $_GET['subcatId'] > 0 ){

                                $this->forumCtrl->updateSubcategory($_POST['cat_id'], $_POST['member_id'],$_POST['subcat_name'],$_POST['subcat_description'], $_GET['subcatId']);

                            } else {

                                throw new \Exception( "Cette sous-catégorie est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Supprimer une sous-categorie

                    case 'deleteSubcat':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if ( isset($_GET['subcatId']) &&  $_GET['subcatId'] > 0 ){

                                $this->forumCtrl->deleteSubcategory($_GET['subcatId']);

                            } else {

                                throw new \Exception( "Cette sous-catégorie est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                     break;

        /*------------------------------------------------  FORUM    -------------------------------------------------*/

                        //Accueil du forum

                    case 'forum':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            $this->forumCtrl->showForumPage();

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                     break;

                     //Affichage des sujets selon la catégorie et/ou la sous-categorie

                    case 'topics':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['cat_id']) && $_GET['cat_id'] > 0 && isset($_GET['subcat_id']) && $_GET['subcat_id'] > 0  ) {

                               $this->topicCtrl->showSubjectsByCategoriesAndSubcategories($_GET['cat_id'], $_GET['subcat_id']);

                            } else if (isset($_GET['cat_id']) && $_GET['cat_id'] > 0 && !isset($_GET['subcat_id'])  ) {

                                $this->topicCtrl->showSubjectsByCategories($_GET['cat_id']);

                            } else {

                                throw new \Exception( "Categorie ou sous-categorie non conforme");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                     break;

                        // Afficher un seul sujet

                    case 'singleTopic':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['topicId']) && $_GET['topicId'] > 0) {

                                $this->topicCtrl->showSingleTopic($_GET['topicId']);

                            } else {

                                throw new \Exception("Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    // Afficher les sujets selon leur auteur

                    case 'topicAuthor':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['author']) && $_GET['author'] > 0) {

                                $this->topicCtrl->showSubjectsByAuthor($_GET['author']);

                            } else {

                                throw new \Exception( "Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;

                    //Ajouter un nouveau sujet

                    case 'addTopic':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['cat_id']) && isset($_GET['subcat_id']) && !empty($_POST['member_id']) && !empty($_POST['topic_name']) &&  !empty($_POST['topic_description']) ) {

                                $this->topicCtrl->createSubject($_GET['cat_id'],$_GET['subcat_id'],$_POST['member_id'],$_POST['topic_name'],$_POST['topic_description']);

                            } else {

                                throw new \Exception("Certains champs doivent etre complétés!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Supprimer un sujet

                    case 'deleteTopic':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if ( isset($_GET['topicId']) &&  $_GET['topicId'] > 0 && isset($_GET['catId']) &&  $_GET['catId'] > 0 && isset($_GET['catId']) &&  $_GET['subcatId'] > 0 ){

                                $this->topicCtrl->deleteSubject($_GET['topicId'],$_GET['catId'], $_GET['subcatId']);

                            } else {

                                throw new \Exception("Ce sujet est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;

                        //Ajouter un commentaire

                    case 'addComment':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (!empty($_POST['com_subcatId']) && ($_POST['com_subjectId']) && !empty($_POST['com_author']) &&  !empty($_POST['com_content']) ) {

                                $this->topicCtrl->addComment($_POST['com_subcatId'],$_POST['com_subjectId'],$_POST['com_author'],$_POST['com_content']);

                            } else {

                                throw new \Exception( "Certains champs doivent etre complétés!");
                            }

                            break;

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Afficher un commentaire

                    case 'showComment':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset ($_GET['comId']) && $_GET['comId']>0){

                                    $this->topicCtrl->showComment($_GET['comId']);

                            } else {

                                throw new \Exception("Ce commentaire est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                    break;

                    // Afficher les commentaires selon leur auteur

                    case 'commentsAuthor':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['author']) && $_GET['author'] > 0) {

                                $this->topicCtrl->showCommentsByAuthor($_GET['author']);

                            } else {

                                throw new \Exception("Identifiant non attribué!");
                            }
                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Modifier un commentaire

                    case 'editComment':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset ($_GET['comId']) && $_GET['comId']>0){

                                if (!empty($_POST['com_subcatId']) && ($_POST['com_subjectId']) && !empty($_POST['com_author']) &&  !empty($_POST['com_content']) ) {

                                    $this->topicCtrl->updateComment($_GET['comId'],$_POST['com_subcatId'], $_POST['com_subjectId'], $_POST['com_author'], $_POST['com_content']);
                                } else {
                                    throw new \Exception("Certains champs doivent etre complétés!");
                                }

                            } else {

                                throw new \Exception("Ce commentaire est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error ="Vous devez vous connecter";
                        }

                        break;

                    //Supprimer un commentaire

                    case 'deleteComment':

                        if (isset($_SESSION['connected']) && !empty($_SESSION['connected'])){

                            if (isset($_GET['comId']) && $_GET['comId'] > 0 && isset($_GET['topicId']) &&  $_GET['topicId'] > 0 ){

                                $this->topicCtrl->deleteComment($_GET['comId'],$_GET['topicId']);

                            } else {

                                throw new \Exception("Ce commentaire est introuvable!");
                            }

                        } else {
                            header('Location:index.php?action=connect');
                            $error = "Vous devez vous connecter";
                        }

                        break;

                    default:

                        throw new \Exception('Action non valide');
                }

            } else {

                $this->homeCtrl->showHomepage();
            }

        }catch (\Exception $e){

            echo 'Erreur: '.$e->getMessage();

        }
    }
}