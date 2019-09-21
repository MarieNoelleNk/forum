<?php
session_start();

require 'vendor/autoload.php';
use App\Router;

$router = new Router();
$router->routerRequest();