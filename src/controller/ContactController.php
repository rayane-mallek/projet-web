<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

class ContactController
{
  public static function index(): void
  {
      $text = new Text();
      $contactInfo = [
        'address' => $text->getTextBySectionName('address'),
        'phone' => $text->getTextBySectionName('phone'),
        'email' => $text->getTextBySectionName('email')
      ];

      $controller = 'contact';
      $view = 'contact';
      $pagetitle = 'Contact';

      require File::build_path(array("view", "base.php"));
  }

  public static function updateText()
  {
      if ($_SESSION['login'] === true) {
          $sectionName = $_POST['section_name'];
          $text = $_POST['text'];

          $text = new Text();
          $text->saveOrUpdateText($sectionName, $text);

          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
      }
  }
}