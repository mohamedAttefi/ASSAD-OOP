<?php
require_once "utilisateur.php";

class visiteur extends utilisateur
{
    private $statut_compte;

    public function __construct($nom, $email, $motpasse_hash, $role, $statut_compte)
    {
        parent::__construct($nom, $email, $motpasse_hash, "visiteur");
        $this->statut_compte = $statut_compte;
    }


    public static function activerUtilisateurs($conn, $id)
    {
        return $conn->prepare("update utilisateurs set statut = 'actif' where id = $id and statut = 'desaactive'")->execute();
    }
    public static function desactiverUtilisateurs($conn, $id)
    {
        return $conn->prepare("update utilisateurs set statut = 'desactive' where id = $id and statut = 'actif'")->execute();
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
    public function getStatut()
    {
        return $this->statut_compte;
    }
    public function setStatut($newStatut)
    {
        $this->statut_compte = $newStatut;
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
