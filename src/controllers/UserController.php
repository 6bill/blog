<?php

namespace Blog\controllers;

use Blog\models\UserManager;

/** Class UserController **/
class UserController
{
    private $manager;

    public function __construct()
    {
        $this->manager = new UserManager();
    }

    /** Affichage de la page d'authentification **/
    public function showLogin()
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
        $_SESSION = array();
        unset($_SESSION);
        header('Location: /');
    }
    public function register() {

        $res = $this->manager->getUserbyPseudo($_POST["pseudo"]);
        if ((!empty($_POST['pseudo']) && !empty($_POST['password'])) && ($_POST['password'] == $_POST['passwordConfirm'])) {
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
                $_SESSION["error"]['pseudo'] = "Le pseudo est déjà pris !";
                header("Location: /register");
            }
        } if (empty($_POST['pseudo'])){
            $_SESSION["error"]['pseudo'] = " Choisissez un pseudo !";
            header("Location: /register");
        } if (empty($_POST['password'])){
            $_SESSION["error"]['password'] = "Choisissez un mot de passe !";
            header("Location: /register");
        } if ($_POST['password'] != $_POST['passwordConfirm']) {
            $_SESSION["error"]['passwordConfirm'] = "Les mots de passes doivent êtres différents !";
            header("Location: /register");
        }
    }
    public function searchByWordsPseudo()
    {
        $output = "";
        $users = $this->manager->getPseudoByWords();
        if ($users) {
            foreach ($users as $user) {
                $output .= "<a href='/user/" . $user->getId_user() . "'>" . $user->getPseudo() . "</a><br>";
            }
            echo $output;
        }
    }
    /** Vérification de l'authentification **/
    public function login()
    {
        $_SESSION['old'] = $_POST;
        //on recherche si le pseudo existe
        $user = $this->manager->getUserbyPseudo($_POST["pseudo"])[0];
        //si l'user existe.
        if ($user != null) {
            //on vérifie si le mot de passe est bon
            if ($_POST['password'] == $user->getPassword()) {
                $_SESSION["user"] = [
                    "id" => $user->getId_user(),
                    "pseudo" => $user->getPseudo(),
                    "role" => $user->getRole()
                ];
                header("Location: /");
            }
            //le mot de passe est erroné.
            else {
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /login");
            }
        }
        //le pseudo n'existe pas dans la bdd donc l'user est null
        else {
            $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
            header("Location: /login");
        }
    }
}