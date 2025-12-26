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

    public function getCount($conn)
    {
        $result_stmt = $conn->prepare("SELECT count(*) as total FROM visitesguidees");
        $result_stmt->execute();
        return $result_stmt->fetchall()['total'];
    }

    public function getUpcomingVisites($conn)
    {
        $upcoming_visits_stmt = $conn->prepare("
    SELECT titre, dateheure, COUNT(r.id) as reservations 
    FROM visitesguidees v 
    LEFT JOIN reservations r ON v.id = r.idvisite 
    WHERE v.dateheure >= CURDATE() 
    GROUP BY v.id 
    ORDER BY v.dateheure ASC 
    LIMIT 5
");
        $upcoming_visits_stmt->execute();

        return $upcoming_visits_stmt->fetchall();
    }

    public function getAll($conn, $id)
    {
        $result_stmt = $conn->prepare("SELECT * FROM visitesguidees inner join utilisateurs on visitesguidees.id_guide =  utilisateurs.id where utilisateurs.id = $id ORDER BY dateheure DESC");
        $result_stmt->execute();
        return $result_stmt->fetchall();
    }

    public function getVistesParGuide($id, $conn)
    {
        $sql = "select * from visitesguidees v join utilisateurs u  on v.id_guide = u.id join reservations r on v.id = r.idvisite where v.id_guide = $id order by v.dateheure limit 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}
