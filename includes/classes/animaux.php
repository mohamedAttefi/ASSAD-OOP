<?php

class animaux
{
    public $id;
    public $nom;
    public $espece;
    public $alimentation;
    public $paysorigine;
    public $image;
    public $id_habitat;
    public $description;
    public function __construct($nom, $espece, $alimentation, $paysorigine, $image, $id_habitat, $description)
    {
        $this->id = null;
        $this->nom = $nom;
        $this->espece = $espece;
        $this->alimentation = $alimentation;
        $this->paysorigine = $paysorigine;
        $this->image = $image;
        $this->id_habitat = $id_habitat;
        $this->description = $description;
    }


    public function ajouter() {}
    public function modifier($id) {}

    public function supprimer($id) {}
}