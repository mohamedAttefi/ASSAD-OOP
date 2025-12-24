<?php
class resservation
{
    public $id;
    public $idvisite;
    public $idutilisateur;
    public $nbpersonne;
    public $datereservation;
    public function __construct($id, $idvisite, $idutilisateur, $nbpersonne, $datereservation)
    {
        $this->id = $id;
        $this->idvisite = $idvisite;
        $this->idutilisateur = $idutilisateur;
        $this->nbpersonne = $nbpersonne;
        $this->datereservation = $datereservation;
    }
}