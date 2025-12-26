<?php
class commentaires
{
    public $id;
    public $idvisite;
    public $idutilisateur;
    public $note;
    public $text;
    public $date_commentaire;
    public function __construct($idvisite, $idutilisateur, $note, $text, $date_commentaire)
    {
        $this->id = null;
        $this->idvisite = $idvisite;
        $this->idutilisateur = $idutilisateur;
        $this->note = $note;
        $this->text = $text;
        $this->date_commentaire = $date_commentaire;
    }


    public function getCommentaireCount($conn, $id)
    {
        $comments_count_stmt = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM commentaires 
    WHERE idutilisateur = $id
");
        $comments_count_stmt->execute();
        return $comments_count_stmt->fetch()['total'];
    }

    
}
