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
    public function getRole(): string
    {
        return $this->role;
    }
    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
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