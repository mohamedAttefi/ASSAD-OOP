<?php
class visite
{
    public $id;
    public $titre;
    public $dateheure;
    public $langue;
    public $capacite_max;
    public $statut = ["active", "annulee"];
    public $duree;
    public $prix;
    public $id_guide;
    public function __construct($id, $titre, $dateheure, $langue, $capacite_max, $statut, $duree, $prix, $id_guide)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->dateheure = $dateheure;
        $this->langue = $langue;
        $this->capacite_max = $capacite_max;
        $this->statut = $statut;
        $this->duree = $duree;
        $this->prix = $prix;
        $this->id_guide = $id_guide;
    }

    public function ajouter() {}
    public function modifier($id) {}
    public function supprimer($id) {}
}