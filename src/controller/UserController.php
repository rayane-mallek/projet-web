<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "User.php"));
require_once File::build_path(array("controller", "HomeController.php"));

class UserController
{
    public static function error(): void
    {
        echo 'Erreur !';
    }

    public static function login(): void
    {
        $controller = 'user';
        $view = 'login';
        $pagetitle = 'Connexion';

        require File::build_path(array("view", "base.php"));
    }

    public static function loginProcess(): void
    {
        // Récupération des données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Récupération de l'utilisateur par l'email
        $user = new User();
        $userData = $user->getUserByEmail($email);

        // Vérification si l'utilisateur existe
        if ($userData) {
            // Vérification du mot de passe
            if ($userData['password'] === $password) { // A remplacer par password_verify si les mots de passe sont hachés
                // Connexion réussie
                $_SESSION['login'] = true;
                $_SESSION['username'] = $userData['username'];
                $_SESSION['email'] = $userData['email'];

                HomeController::index();
            } else {
                // Mot de passe incorrect
                $_SESSION['login'] = false;
                $controller = 'user';
                $view = 'login';
                $pagetitle = 'Erreur de connexion';
                $error_message = "Mot de passe incorrect.";

                require File::build_path(array("view", "base.php"));
            }
        } else {
            // Utilisateur non trouvé
            $_SESSION['login'] = false;
            $controller = 'user';
            $view = 'login';
            $pagetitle = 'Erreur de connexion';
            $error_message = "Aucun utilisateur trouvé avec cet email.";

            require File::build_path(array("view", "base.php"));
        }
    }

    public static function signupProcess(): void
    {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $user = new User($username, $email, $_POST['password']);
        $user->create();

        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        HomeController::index();
    }

    public static function logout(): void
    {
        session_unset();
        $_SESSION['login'] = false;

        HomeController::index();
    }

    public static function adminCreateUser(): void
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        $controller = 'user';
        $view = 'create_user';
        $pagetitle = 'Créer un utilisateur';

        require File::build_path(array("view", "base.php"));
    }

    public static function adminCreateUserProcess(): void
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $userData = $user->getUserByEmail($email);

        if (! $userData) {
            $newUser = new User($username, $email, $password);
            $newUser->create();

            $success_message = "L'utilisateur a été créé avec succès.";
        } else {
            $error_message = "Un utilisateur avec cet email existe déjà.";
        }

        $controller = 'user';
        $view = 'create_user';
        $pagetitle = 'Créer un utilisateur';
        $userModel = new User();
        $users = $userModel->getAllUsers();

        require File::build_path(array("view", "base.php"));
    }

    public static function adminDeleteUserProcess(): void
    {
        $username = $_POST['username'];

        $userModel = new User();
        $userModel->deleteUser($username);

        $users = $userModel->getAllUsers();
        $controller = 'user';
        $view = 'create_user';
        $pagetitle = 'Créer un utilisateur';

        $success_message = "L'utilisateur a été supprimé avec succès.";
        require File::build_path(array("view", "base.php"));
    }
}
