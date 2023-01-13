<?php

namespace Blog\models;


/** Class User **/
class User
{

    private $Id_user;
    private $pseudo;
    private $password;
    private $role;

    public function getId_user()
    {
        return $this->Id_user;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }


    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function setId_user(int $Id_user)
    {
        $this->Id_user = $Id_user;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setRole(int $role)
    {
        $this->role = $role;
    }

}

