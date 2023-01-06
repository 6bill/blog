<?php

namespace Blog\Models;


/** Class User **/
class User
{

    private $Id_user;
    private $pseudo;
    private $password;

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

}

