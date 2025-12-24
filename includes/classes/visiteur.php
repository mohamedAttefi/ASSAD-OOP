<?php
include "utilisateur.php";

class visiteur extends utilisateur
{
    public function __construct($nom, $email, $motpasse_hash)
    {
        parent::__construct($nom, $email, $motpasse_hash, "actif", "visiteur");
    }
    public function consulterVisite() {}
    public function commenter() {}
    public function chercherVisite() {}
}