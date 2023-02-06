<?php

namespace Blog\controllers;

use Blog\Models\UserManager;

/** Class UserController **/
class UserController
{
    private $manager;

    public function __construct()
    {
        $this->manager = new UserManager();
    }

    /** Affichage de la page d'authentification **/
    public function index()
    {
        require VIEWS . 'Auth/login.php';
    }

    /** Affichage de la page register **/
    public function showRegister()
    {
        require VIEWS . 'Auth/register.php';
    }

    /** logout **/
    public function logout()
    {
        unset($_SESSION["user"]);
        header('Location: /login/');
    }

    /** insertion d'un user **/
    public function register()
    {
//        $this->validator->validate([
//            "pseudo"=>["required", "min:3", "alphaNum"],
//            "password"=>["required", "min:6", "alphaNum", "confirm"],
//            "passwordConfirm"=>["required", "min:6", "alphaNum"]
//        ]);
        $_SESSION['old'] = $_POST;

//        if (!$this->validator->errors()) {
//            /** vérifie si le pseudo existe déjà **/
            $res = $this->manager->getUserByPseudo($_POST["username"]);

        if (empty($res)) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->manager->store($password);
            header("Location: /");
        } else {
            $_SESSION["error"]['pseudo'] = "Le pseudo choisi est déjà utilisé !";
            header("Location: /register");
        }

    }


    /** vérification de l'autentification **/
    public function login() {
//        $this->validator->validate([
//            "pseudo"=>["required", "min:3", "max:9", "alphaNum"],
//            "password"=>["required", "min:4", "alphaNum"]
//        ]);

        $_SESSION['old'] = $_POST;

        $res = $this->manager->getUserbyPseudo($_POST["username"])[0];

        if ($res && password_verify($_POST['password'], $res->getPassword())) {
            $_SESSION["user"] = [
                "id" => $res->getId_user(),
                "pseudo" => $res->getPseudo(),
                "role" => $res->getRole()
            ];

            header("Location: /");
        }

        else {
            $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
            header("Location: /login");
        }
    }

    /** Formulaire de recherche d'un article par mots clefs **/
    public function searchUserByPseudo()
    {
        $output = "";
        $users = $this->manager->searchUserByPseudo();
        if ($users) {
            foreach ($users as $user) {
                $output .= "<a  href='/articleUser/" . $user->getId_user() . "'>" . $user->getPseudo() . "</a><br>";

                echo $output;
            }
        }
    }

}
