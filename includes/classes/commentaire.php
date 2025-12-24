<?php
class commentaires
{
    public $id;
    public $idvisite;
    public $idutilisateur;
    public $note;
    public $text;
    public $date_commentaire;
    public function __construct($id, $idvisite, $idutilisateur, $note, $text, $date_commentaire)
    {
        $this->id = $id;
        $this->idvisite = $idvisite;
        $this->idutilisateur = $idutilisateur;
        $this->note = $note;
        $this->text = $text;
        $this->date_commentaire = $date_commentaire;
    }
}