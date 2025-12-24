<?php 
class habitat
{
    public $id;
    public $nom;
    public $typeclimat;
    public $description;
    public $zonezoo;
    public function __construct($id, $nom, $typeclimat, $description, $zonezoo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->typeclimat = $typeclimat;
        $this->description = $description;
        $this->zonezoo = $zonezoo;
    }
    public function ajouter() {}
    public function modifier($id) {}
    public function supprimer($id) {}
}