<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "Product.php"));

class DescriptionController
{
    public static function index(): void
    {
        $controller = 'description';
        $view = 'description';
        $pagetitle = 'Accueil';

        $productModel = new Product();
        $products = $productModel->getAllProducts();

        require File::build_path(array("view", "base.php"));
    }
}