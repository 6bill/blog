<?php

namespace Blog\models;


/** Class UserManager **/
class UserManager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    /** Récupération d'un user à partir de son id**/
    public function getUserById($id)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM User WHERE Id_user = ?");
        $stmt->execute(array(
            $id
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\User");
    }

    public function getUserByPseudo($pseudo)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM User WHERE pseudo = ?");
        $stmt->execute(array(
            $pseudo
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\User");
    }

    /** Récupération de tous les user avec leur rôle **/
    public function all()
    {
        $stmt = $this->bdd->query('SELECT * FROM User INNER JOIN Role ON User.Id_role = Role.Id_role');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\User");
    }

    /** Enregistrement du user. **/
    public function store($password)
    {
        $stmt = $this->bdd->prepare("INSERT INTO User(pseudo, password, role) VALUES (?, ?, ?)");
        $stmt->execute(array(
            $_POST["pseudo"],
            $password,
            $_POST["role"],
        ));
    }

    public function getPseudoByWords()
    {
        $stmt = $this->bdd->prepare('SELECT * FROM User WHERE pseudo LIKE ?');
        $stmt->execute(array(
            "%" . $_POST['recherche'] . "%"
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Blog\Models\User");
    }
}