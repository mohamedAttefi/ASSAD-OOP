<?php
class reservation
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

    public function getAll($conn)
    {
        $sql = "SELECT r.id, r.nbpersonnes, r.datereservation, 
               u.nom, u.email,
               v.titre as visite_titre, v.prix, v.dateheure 
        FROM reservations r
        JOIN utilisateurs u ON r.idutilisateur = u.id
        JOIN visitesguidees v ON r.idvisite = v.id
        ORDER BY r.datereservation DESC";
        $result_stmt = $conn->prepare($sql);
        $result_stmt->execute();

        return $result_stmt->fetchall();
    }
    public function reserver($idVisite, $idUtilisateur, $nbPersonnes, $conn)
    {
        $reservation_stmt = $conn->prepare("
        SELECT v.capacite_max,
        SUM(r.nbpersonnes) AS total_reserves
        FROM visitesguidees v
        LEFT JOIN reservations r ON r.idVisite = v.id
        WHERE v.id = ?
        GROUP BY v.id
        ");
        $reservation_stmt->execute([$idVisite]);
        $result_reservation = $reservation_stmt->fetch();

        if (!$result_reservation) {
            echo "La visite n'existe pas.";
            return;
        }

        $placesRestantes = $result_reservation['capacite_max'] - $result_reservation['total_reserves'];

        if ($nbPersonnes > $placesRestantes) {
            echo 'La réservation est pleine ou il n\'y a pas assez de places.';
            return;
        }

        $insert_stmt = $conn->prepare("
        INSERT INTO reservations (idVisite, idUtilisateur, nbpersonnes) 
        VALUES (?, ?, ?)
    ");
        $insert_stmt->execute([$idVisite, $idUtilisateur, $nbPersonnes]);
        echo "Réservation réussie !";
    }


    public function getOne($conn, $id)
    {
        $sql = "SELECT r.id, v.titre, v.dateheure, v.duree, v.prix, 
        r.nbpersonnes, r.datereservation, v.statutVisite,
        u.nom AS guide_nom
        FROM reservations r
        JOIN visitesguidees v ON r.idvisite = v.id
        LEFT JOIN utilisateurs u ON v.id_guide = u.id
        WHERE r.idutilisateur = ?
        ORDER BY r.datereservation DESC
        ";
        $result_stmt = $conn->prepare($sql);
        $result_stmt->execute([$id]);
        return $result_stmt->fetchall();
    }

    public function getCount($conn, $id)
    {
        $reservations_count_stmt = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM reservations 
    WHERE idutilisateur = $id;
");
        $reservations_count_stmt->execute();
        return $reservations_count_stmt->fetch()['total'];
    }

    public function getUpcomingReservation($conn, $id)
    {
        $upcoming_reservations_stmt = $conn->prepare("
    SELECT COUNT(*), r.* as total 
    FROM reservations r
    JOIN visitesguidees v ON r.idVisite = v.id
    WHERE r.idutilisateur = $id
    AND v.dateheure >= CURDATE()
    AND v.statutVisite = 'active'
");

        $upcoming_reservations_stmt->execute();
        return $upcoming_reservations_stmt->fetch();
    }

    public function ajouterReservation($conn, $idVisite)
    {

        $idUtilisateur = $_SESSION['user_id'];

        $check = $conn->prepare(
            "SELECT id FROM reservations 
         WHERE idutilisateur = ? AND idvisite = ?"
        );
        $check->execute([$idUtilisateur, $idVisite]);
        $result = $check->fetch();

        if ($result) {
            return "Réservation déjà existante";
        }

        $stmt = $conn->prepare(
            "INSERT INTO reservations (idutilisateur, idvisite, datereservation) 
         VALUES (?, ?, NOW())"
        );
        $stmt->execute([$idUtilisateur, $idVisite]);
        return "visite reserver avec success";

    }
}
