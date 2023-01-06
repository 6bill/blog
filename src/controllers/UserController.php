<?php

namespace Blog\Controllers;

use Blog\Models\UserManager;
use Blog\Models\RoleManager;
use Blog\Validator;

/** Class UserController **/
class UserController {
    private $manager;
    private $role_manager;
    private $validator;

    public function __construct() {
        $this->manager = new UserManager();
        $this->role_manager = new RoleManager();
        $this->validator = new Validator();
    }

    /** Affichage de la page d'authentification **/
    public function showLogin() {
        require VIEWS . 'Auth/login.php';
    }

    /** Affichage de la page register **/
    public function showRegister() {
        //récupération des roles
        $roles = $this->role_manager->getAll();        
        require VIEWS . 'Auth/register.php';
    }

    /** logout **/
    public function logout()
    {
        
        session_destroy();
        header('Location: /login/');
    }

    /** insertion d'un user **/
    public function register() {
        $this->validator->validate([
            "pseudo"=>["required", "min:3", "alphaNum"],
            "password"=>["required", "min:6", "alphaNum", "confirm"],
            "passwordConfirm"=>["required", "min:6", "alphaNum"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            /** vérifie si le pseudo existe déjà **/
            $res = $this->manager->find($_POST["pseudo"]);

            if (empty($res)) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->store($password);

                $_SESSION["user"] = [
                    "id" => $this->manager->getBdd()->lastInsertId(),
                    "pseudo" => $_POST["pseudo"],
                    "role" => $_POST["role"]
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['pseudo'] = "Le pseudo choisi est déjà utilisé !";
                header("Location: /register");
            }
        } else {
            header("Location: /register");
        }
    }

    /** vérification de l'autentification **/
    public function login() {
        $this->validator->validate([
            "pseudo"=>["required", "min:3", "max:9", "alphaNum"],
            "password"=>["required", "min:4", "alphaNum"]
        ]);

        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->getUserById());

            if ($res && password_verify($_POST['password'], $res->getPassword())) {
                $_SESSION["user"] = [
                    "id" => $res->getId_user(),
                    "pseudo" => $res->getPseudo(),
                    "role" => $res->getId_role()
                ];
               
                header("Location: /");
            } else {
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }
}
