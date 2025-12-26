<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/classes/reservation.php';
include 'includes/classes/commentaire.php';
include 'includes/classes/visite.php';

print_r($_SESSION);

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$reserevation = new reservation("", "", "", "", "");
$commentaire = new commentaires('','','','','');
$visite = new visite('','','','','','','','','');

$reservations_count = $reserevation->getOne($conn, $_SESSION['user_id']);

$comments_count = $commentaire->getCommentaireCount($conn, $_SESSION['user_id']);

echo $comments_count;

$upcoming_visits_stmt = $conn->prepare("
    SELECT v.*, r.datereservation, r.nbpersonnes, v.statutVisite
    FROM reservations r
    JOIN visitesguidees v ON r.idvisite = v.id
    WHERE r.idutilisateur = 1
    AND v.dateheure >= CURDATE()
    AND v.statutVisite = 'active'
    ORDER BY v.dateheure ASC
    LIMIT 3
");
$upcoming_visits_stmt->execute();

$upcoming_visits = $reserevation->getOne($conn, $_SESSION['user_id']);





?>

<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold mb-2">Bonjour, <?php echo htmlspecialchars($_SESSION['user_nom']); ?> !</h1>
                <p class="text-xl text-green-100">Bienvenue sur votre espace personnel</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <p class="text-sm text-green-200">Membre depuis</p>
                    <p class="font-bold text-lg">
                        <?php
                        if (isset($_SESSION['date_inscription'])) {
                            echo date('d/m/Y', strtotime($_SESSION['date_inscription']));
                        } else {
                            echo date('d/m/Y');
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Statistiques rapides -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Réservations totales -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-emerald-100 text-sm">Réservations</p>
                    <p class="text-3xl font-bold"><?php echo count($reservations_count); ?></p>
                    <p class="text-emerald-200 text-sm mt-2">Total</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-emerald-400">
                <a href="mes-reservations.php" class="text-sm text-emerald-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir mes réservations
                </a>
            </div>
        </div>




        <!-- Commentaires -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100 text-sm">Avis</p>
                    <p class="text-3xl font-bold"><?php echo $comments_count; ?></p>
                    <p class="text-purple-200 text-sm mt-2">Commentaires</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-comment text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-purple-400">
                <a href="mes-commentaires.php" class="text-sm text-purple-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir mes avis
                </a>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Colonne gauche - Prochaines visites -->
        <div class="lg:col-span-2">
            <!-- Prochaines visites -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Mes prochaines visites</h2>
                            <p class="text-gray-600">Vos réservations confirmées</p>
                        </div>
                    </div>
                    <a href="mes-reservations.php" class="text-green-600 hover:text-green-800 font-medium">
                        Voir tout
                    </a>
                </div>

                <?php if (count($upcoming_visits) > 0): ?>
                    <div class="space-y-4">
                        <?php foreach ( $upcoming_visits as $visit){
                            $visit_date = date('d/m/Y H:i', strtotime($visit['dateheure']));
                        ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-green-300 transition">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800"><?php echo htmlspecialchars($visit['titre']); ?></h3>
                                        <div class="flex items-center text-gray-600 text-sm mt-1">
                                            <i class="far fa-clock mr-2"></i>
                                            <span><?php echo $visit['duree']; ?> minutes</span>
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-users mr-2"></i>
                                            <span><?php echo $visit['nbpersonnes']; ?> personne(s)</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-green-600"><?php echo number_format($visit['prix'], 0); ?> DH</div>
                                        <div class="text-sm text-gray-500">par personne</div>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="text-gray-600">
                                        <div class="flex items-center">
                                            <i class="far fa-calendar mr-2"></i>
                                            <span><?php echo $visit_date; ?></span>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Réservé le <?php echo $reservation_date; ?>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="visite-details.php?id=<?php echo $visit['id']; ?>"
                                            class="px-4 py-2 border border-green-600 text-green-600 hover:bg-green-50 rounded-lg font-medium transition">
                                            Détails
                                        </a>
                                        <button class="px-4 py-2 bg-green-600 text-white hover:bg-green-700 rounded-lg font-medium transition">
                                            Accéder
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php }; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-5xl mb-4">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Aucune visite à venir</h3>
                        <p class="text-gray-600 mb-4">Réservez votre première visite guidée !</p>
                        <a href="visites.php" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition">
                            <i class="fas fa-binoculars mr-2"></i>
                            Explorer les visites
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            
        </div>

        <!-- Colonne droite - Activités et raccourcis -->
        <div class="space-y-8">
            <!-- Activités récentes -->
            

            <!-- Raccourcis rapides -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Raccourcis rapides</h2>

                <div class="space-y-3">
                    <a href="visites.php" class="flex items-center justify-between p-3 bg-white rounded-lg hover:shadow transition">
                        <span class="flex items-center">
                            <i class="fas fa-binoculars text-green-600 mr-3"></i>
                            Réserver une visite
                        </span>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </a>

                    <a href="animaux.php" class="flex items-center justify-between p-3 bg-white rounded-lg hover:shadow transition">
                        <span class="flex items-center">
                            <i class="fas fa-paw text-green-600 mr-3"></i>
                            Explorer les animaux
                        </span>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </a>

                    <a href="profil.php" class="flex items-center justify-between p-3 bg-white rounded-lg hover:shadow transition">
                        <span class="flex items-center">
                            <i class="fas fa-user-edit text-green-600 mr-3"></i>
                            Modifier mon profil
                        </span>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </a>

                    <a href="aide.php" class="flex items-center justify-between p-3 bg-white rounded-lg hover:shadow transition">
                        <span class="flex items-center">
                            <i class="fas fa-question-circle text-green-600 mr-3"></i>
                            Centre d'aide
                        </span>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </a>
                </div>
            </div>

            <!-- Suggestions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Suggestions pour vous</h2>
                <p class="text-gray-600 text-sm mb-4">Découvrez des visites qui pourraient vous intéresser</p>

                <div class="space-y-3">
                    <?php
                    $suggestions = $reserevation->getAll($conn);

                    if (count($suggestions) > 0):
                        foreach ( $suggestions as $suggestion){
                    ?>
                            <div class="border border-gray-200 rounded-lg p-3 hover:border-green-300 transition">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-800"><?php echo htmlspecialchars($suggestion['visite_titre']); ?></h3>
                                    <span class="text-green-600 font-bold"><?php echo number_format($suggestion['prix'], 0); ?> DH</span>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <i class="far fa-calendar mr-1"></i>
                                    <?php echo date('d/m/Y H:i', strtotime($suggestion['dateheure'])); ?>
                                </div>
                                <a href="visite-details.php?id=<?php echo $suggestion['id']; ?>"
                                    class="block text-center mt-3 text-sm bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition">
                                    Découvrir
                                </a>
                            </div>
                    <?php };
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation pour les cartes de statistiques
    document.addEventListener('DOMContentLoaded', function() {
        const statCards = document.querySelectorAll('.bg-gradient-to-br');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.transition = 'transform 0.3s ease';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Animation d'entrée progressive
        const elements = document.querySelectorAll('.bg-white, .bg-gradient-to-r');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';

            setTimeout(() => {
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>