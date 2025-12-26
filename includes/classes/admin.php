<?php
include 'utilisateur.php';

class admin extends utilisateur
{
    public function __construct($nom, $email, $motpasse_hash)
    {
        parent::__construct($nom, $email, $motpasse_hash, "admin");
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMotpasse()
    {
        return $this->motpasse_hash;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }
    
}
