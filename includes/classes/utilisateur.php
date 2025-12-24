<?php
class utilisateur
{
    public $id;
    public $nom;
    public $email;
    public $motpasse_hash;
    public $statut_compte;
    public $role;

    public function __construct($nom, $email, $motpasse_hash, $statut_compte, $role)
    {
        $this->id = null;
        $this->nom = $nom;
        $this->email = $email;
        $this->motpasse_hash = $motpasse_hash;
        $this->statut_compte = $statut_compte;
        $this->role = $role;
    }

    public function seDeconnecter() {}

    public function SeConnecter($email, $motpasse_hash, $conn)
    {
        $sql = "SELECT *
            FROM utilisateurs
            WHERE email = '$email' AND motpasse_hash = '$motpasse_hash'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo "login success";
        } else {
            echo "login failed";
            return;
        }

        $_SESSION['user_id']  = $data['id'];
        $_SESSION['user_nom'] = $data['nom'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['statut'] = $data['statut'];

        print_r($_SESSION);
        if ($data['role'] == "guide") {
            $user = new guide($data['nom'], $data['email'], $data['motpasse_hash']);
            if ($data['role'] == "approuvee") {
                header("location: pendingGuide.php");
                exit;
            } else {
                header("location: dashboardGuide.php");
                exit;
            }
        } else {
            $user = new visiteur($data['nom'], $data['email'], $data['motpasse_hash']);
            header("location: dashboardVisiteur.php");
            exit;
        }
    }
    public function afficherAnimaux() {}
}
