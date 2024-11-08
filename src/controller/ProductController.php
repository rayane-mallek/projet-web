<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "Product.php"));

class ProductController
{
    public static function index(): void
    {
        // Instancie le modèle Product
        $productModel = new Product();
        $products = $productModel->getAllProducts();

        $controller = 'product';
        $view = 'index';
        $pagetitle = 'Gestion des Produits';

        require File::build_path(array("view", "base.php"));
    }

    public static function createProductForm(): void
    {
        $controller = 'product';
        $view = 'create_edit_product'; // Utilise la même vue que pour l'édition
        $pagetitle = 'Ajouter un produit';

        require File::build_path(array("view", "base.php"));
    }

    public static function createProduct(): void
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        echo $_FILES['image']['error'];
        // Traitement de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadedFile = $_FILES['image']['tmp_name'];
            $imagePath = "assets/uploads/" . $name . ".png"; // Utilise le nom du produit pour le fichier image

            self::resizeImage($uploadedFile, $imagePath, 500, 500);
        }

        // Crée un nouvel objet Product
        $product = new Product($name, $description, $price);
        $product->create();

        $success_message = "Produit créé avec succès.";
        self::showDescriptionPage();
    }

    public static function updateProduct(): void
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Crée un objet Product pour la mise à jour
        $product = new Product($name, $description, $price);
        $product->update($id);

        // Vérifie si une nouvelle image a été téléchargée
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadedFile = $_FILES['image']['tmp_name'];
            $imagePath = "assets/uploads/" . $name . ".png";

            // Vérifie et supprime l'ancienne image si elle existe
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Redimensionne et sauvegarde la nouvelle image
            self::resizeImage($uploadedFile, $imagePath, 500, 500);
        }

        $success_message = "Produit modifié avec succès.";
        self::showDescriptionPage();
    }

    public static function showDescriptionPage(): void
    {
        $controller = 'description';
        $view = 'description';
        $pagetitle = 'À propos';

        // Instancie Product pour récupérer les produits
        $productModel = new Product();
        $products = $productModel->getAllProducts();

        require File::build_path(array("view", "base.php"));
    }

    public static function editProduct(): void
    {
        $id = $_GET['id'];

        $productModel = new Product();
        $product = $productModel->getProductById($id);

        $controller = 'product';
        $view = 'create_edit_product';
        $pagetitle = 'Modifier un produit';

        require File::build_path(array("view", "base.php"));
    }

    public static function deleteProduct(): void
    {
        $id = $_GET['id'];

        $productModel = new Product();
        $productModel->delete($id);

        $success_message = "Produit supprimé avec succès.";
        self::showDescriptionPage();
    }

    private static function resizeImage($sourcePath, $destinationPath): void
    {
        // Obtenir l'extension du fichier source
        $imageFileType = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));

        // Création de l'image source selon le type de fichier
        $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));

        // Création de l'image de destination aux dimensions spécifiées
        $destImage = imagecreatetruecolor(200, 200);

        // Obtention des dimensions de l'image source
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);

        // Redimensionnement
        imagecopyresampled($destImage, $sourceImage, 0, 0, 0, 0, 200, 200, $sourceWidth, $sourceHeight);

        // Sauvegarde de l'image redimensionnée selon le type
        imagejpeg($destImage, $destinationPath, 60); // Qualité 90


        // Libération de la mémoire
        imagedestroy($sourceImage);
        imagedestroy($destImage);
    }
}
