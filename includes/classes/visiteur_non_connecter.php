<?php
include "utilisateur.php";
class visiteur_non_connecter extends utilisateur
{

    public function __construct($nom, $email, $motpasse_hash, $role)
    {
        if ($role == 'guide') {
            $statut_compte = 'desapprouvee';
        } else {
            $statut_compte = "actif";
        }
        parent::__construct($nom, $email, $motpasse_hash, $statut_compte, $role);
    }
    public function Sinscrire($conn)
    {
        $password_hash = md5($this->motpasse_hash);

        if ($this->role == 'guide') {
            $sql = "INSERT INTO utilisateurs (nom, email, role, motpasse_hash, statut)
            VALUES ('$this->nom', '$this->email', '$this->role', '$password_hash', 'desapprouvee')";
        } else {
            $sql = "INSERT INTO utilisateurs (nom, email, role, motpasse_hash)
            VALUES ('$this->nom', '$this->email', '$this->role', '$password_hash')";
        }

        // $result = $conn->query($sql);

        echo $sql;


        // header("Location: login.php");
        // exit;
    }
}
