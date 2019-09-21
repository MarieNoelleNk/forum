<?php

namespace App\Controller;
use App\Model\TopicsManager;


class HomeController
{
    private $topic;

    public function __construct()
    {
        $this->topic = new TopicsManager();
    }

    public function showHomepage()
    {
        $forumTopics = $this->topic->getLastSubjects();
        include 'app/view/homepage.php';
    }

    public function showAboutUsPage()
    {
        include 'app/view/aboutUs.php';
    }

    public function showLocalisationPage()
    {
        include 'app/view/localisation.php';
    }

    public function showRegistrationPage()
    {
        include 'app/view/registration.php';
    }

    public function showLoginPage()
    {
        include 'app/view/connection.php';
    }


}