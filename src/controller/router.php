<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/
session_name('projet');
session_start();

if (! isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}

require_once File::build_path(array("controller", "ContactController.php"));
require_once File::build_path(array("controller", "DescriptionController.php"));
require_once File::build_path(array("controller", "HomeController.php"));
require_once File::build_path(array("controller", "ProductController.php"));
require_once File::build_path(array("controller", "UserController.php"));


if (! isset($_GET['action'])) {
    $controller = 'home';
    $view = 'home';
    $pagetitle = 'Accueil';

    $textModel = new Text();
    $aboutText = $textModel->getTextBySectionName('about-text');
    $newsText = $textModel->getTextBySectionName('news-text');
    $contactText = $textModel->getTextBySectionName('contact-text');

    require File::build_path(array("view", "base.php"));
} else {
    $action = $_GET['action'];

    if (! isset($_GET['controller'])) {
        $controller = 'home';
    } else {
        $controller = $_GET['controller'];
    }

    $controller_class = ucfirst($controller) . 'Controller';

    if (class_exists($controller_class)) {
        $allMethodsController = get_class_methods($controller_class);
        if (in_array($action, $allMethodsController)) {
            $controller_class::$action();
        } else {
            UserController::error();
        }
    } else {
        UserController::error();
    }
}



