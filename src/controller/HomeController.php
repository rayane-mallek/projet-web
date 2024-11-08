<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "Text.php"));

class HomeController
{
    public static function index(): void
    {
        $controller = 'home';
        $view = 'home';
        $pagetitle = 'Accueil';

        $textModel = new Text();
        $aboutText = $textModel->getTextBySectionName('about-text');
        $newsText = $textModel->getTextBySectionName('news-text');
        $contactText = $textModel->getTextBySectionName('contact-text');

        require File::build_path(array("view", "base.php"));
    }

    public static function updateText(): void
    {
        if ($_SESSION['login'] && isset($_POST['section_name']) && isset($_POST['text'])) {
            $sectionName = $_POST['section_name'];
            $newText = $_POST['text'];

            $textModel = new Text();
            $textModel->saveOrUpdateText($sectionName, $newText);  // Utilise la nouvelle méthode

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Non autorisé ou données manquantes']);
        }
    }
}

