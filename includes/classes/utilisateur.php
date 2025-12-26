<?php
class utilisateur
{
    protected $id;
    protected $nom;
    protected $email;
    protected $motpasse_hash;
    protected $role;

    public function __construct($nom, $email, $motpasse_hash, $role)
    {
        $this->id = null;
        $this->nom = $nom;
        $this->email = $email;
        $this->motpasse_hash = $motpasse_hash;
        $this->role = $role;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMotpasse()
    {
        return $this->motpasse_hash;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($newId)
    {
        $this->id = $newId;
    }


    public function seDeconnecter()
    {
        $_SESSION = [];

        session_destroy();


        header("Location: ASSAD/ASSAD/index.php");
        exit;
    }

    public function SeConnecter($email, $motpasse_hash, $conn)
    {
        $sql = "SELECT *
            FROM utilisateurs
            WHERE email = '$email' AND motpasse_hash = '$motpasse_hash'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $utilisateur = new utilisateur($data['nom'], $data['email'], $data['motpasse_hash'], $data['role']);
            $utilisateur->setId($data["id"]);

            if ($utilisateur->getRole() == 'guide') {
                $logedUser = new guide($data['nom'], $data['email'], $data['motpasse_hash'], $data['role'], $data['statut']);
                $logedUser->setId($data['id']);

                return $logedUser;
            } else {
                $logedUser = new visiteur($data['nom'], $data['email'], $data['motpasse_hash'], $data['role'], $data['statut']);
                $logedUser->setId($data['id']);
                return $logedUser;
            }
        } else {
            return null;
        }
    }

    public function getAll($conn)
    {
        $stmt_visiteurs = $conn->prepare("SELECT COUNT(*) as total FROM utilisateurs WHERE role='visiteur'");
        $stmt_visiteurs->execute();
        return $stmt_visiteurs->fetch()['total'];
    }


    public function getLatest($conn)
    {
        $latest_users_stmt = $conn->prepare("SELECT nom, email FROM utilisateurs ORDER BY nom DESC LIMIT 5");
        $latest_users_stmt->execute();
        return $latest_users_stmt->fetchall();
    }

    public function getCountReservation($conn)
    {
        $sql = "SELECT u.*, 
               COUNT(DISTINCT r.id) as nb_reservations,
               COUNT(DISTINCT c.id) as nb_commentaires,
               MAX(r.datereservation) as derniere_reservation
        FROM utilisateurs u
        LEFT JOIN reservations r ON u.id = r.idutilisateur
        LEFT JOIN commentaires c ON u.id = c.idutilisateur
        GROUP BY u.id
        ";

        $result_stmt = $conn->prepare($sql);
        $result_stmt->execute();

        return $result_stmt->fetchall();
    }

    public function getCountByRole($conn)
    {
        $stats_sql = "SELECT 
    COUNT(*) AS total,
    COUNT(CASE WHEN role = 'visiteur' THEN 1 END) AS visiteurs,
    COUNT(CASE WHEN role = 'guide' THEN 1 END) AS guides,
    COUNT(CASE WHEN statut = 'approuvee' and role = 'guide' THEN 1 END) AS approuves,
    COUNT(CASE WHEN role = 'admin' THEN 1 END) AS admins,
    COUNT(CASE WHEN statut = 'actif' = 1 THEN 1 END) AS actifs,
    COUNT(CASE WHEN statut = 'desactive' THEN 1 END) AS inactifs
FROM utilisateurs;";

        $stats_stmt = $conn->prepare($stats_sql);
        $stats_stmt->execute();
        return $stats_stmt->fetch();
    }
}
