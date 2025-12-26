<?php
include '../includes/header.php';
include '../includes/db.php';
include '../includes/classes/utilisateur.php';
include '../includes/classes/animaux.php';
include '../includes/classes/reservation.php';
include '../includes/classes/visite.php';
$user = new utilisateur("","","","");
$animal = new animaux("","","","", "","","");
$visite = new visite("","","","","","","","","");
$user = new utilisateur("","","","");


$total_visiteurs = $user->getAll($conn);


$total_animaux = $animal->getAll($conn);


$total_visites = $visite->getAll($conn);



$reservations_stmt = $conn->prepare("SELECT COUNT(*) as total FROM reservations WHERE DATE(datereservation) = CURDATE()");
$reservations_stmt->execute();
$reservations_today = $reservations_stmt->fetch()['total'];


$stmt_revenue = $conn->prepare("
    SELECT SUM(v.prix * r.nbpersonnes) as total 
    FROM reservations r 
    JOIN visitesguidees v ON r.idvisite = v.id");
$stmt_revenue->execute();
$total_revenue = $stmt_revenue->fetch()['total'];


$latest_users = $user->getLatest($conn);



$upcoming_visits = $visite->getUpcomingVisites($conn);
?>

<!-- Hero Section -->
<div class="py-6 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Tableau de bord Admin</h1>
                <p class="text-green-100">Vue d'ensemble du Zoo Virtuel ASSAD</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm text-green-200">Dernière mise à jour</p>
                    <p class="font-bold"><?php echo date('d/m/Y H:i'); ?></p>
                </div>
                <button class="bg-white text-green-700 px-4 py-2 rounded-lg font-medium hover:bg-green-50 transition">
                    <i class="fas fa-sync-alt mr-2"></i>Actualiser
                </button>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Visiteurs -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm">Visiteurs</p>
                    <p class="text-3xl font-bold"><?php echo ($total_visiteurs); ?></p>
                    <p class="text-blue-200 text-sm mt-2">Inscrits sur la plateforme</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-blue-400">
                <a href="utilisateurs.php" class="text-sm text-blue-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Gérer les utilisateurs
                </a>
            </div>
        </div>

        <!-- Animaux -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-amber-100 text-sm">Animaux</p>
                    <p class="text-3xl font-bold"><?php echo number_format($total_animaux); ?></p>
                    <p class="text-amber-200 text-sm mt-2">Espèces différentes</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-paw text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-amber-400">
                <a href="animaux.php" class="text-sm text-amber-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Gérer les animaux
                </a>
            </div>
        </div>

        <!-- Visites -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-emerald-100 text-sm">Visites guidées</p>
                    <p class="text-3xl font-bold"><?php echo number_format($total_visites); ?></p>
                    <p class="text-emerald-200 text-sm mt-2">Programmées</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-binoculars text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-emerald-400">
                <a href="visites.php" class="text-sm text-emerald-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Gérer les visites
                </a>
            </div>
        </div>

        <!-- Revenus -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100 text-sm">Revenus totaux</p>
                    <p class="text-3xl font-bold"><?php echo ($total_revenue); ?> DH</p>
                    <p class="text-purple-200 text-sm mt-2">Réservations confirmées</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-purple-400">
                <a href="reservations.php" class="text-sm text-purple-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir les réservations
                </a>
            </div>
        </div>
    </div>

    <!-- Deuxième ligne de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Réservations du jour -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center mb-6">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <i class="fas fa-calendar-day text-green-600"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Aujourd'hui</h3>
                    <p class="text-gray-600">Réservations du jour</p>
                </div>
            </div>
            <div class="text-center py-4">
                <p class="text-5xl font-bold text-green-600"><?php echo $reservations_today; ?></p>
                <p class="text-gray-500 mt-2">nouvelles réservations</p>
            </div>
        </div>

        <!-- Occupation moyenne -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center mb-6">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <i class="fas fa-chart-pie text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Occupation</h3>
                    <p class="text-gray-600">Taux de remplissage</p>
                </div>
            </div>
            <div class="text-center py-4">
                <div class="relative w-32 h-32 mx-auto">
                    <svg class="w-full h-full" viewBox="0 0 100 100">
                        <!-- Cercle de fond -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="10" />
                        <!-- Cercle de progression -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="10"
                            stroke-dasharray="282.74"
                            stroke-dashoffset="<?php echo 282.74 * (1 - 0.65); ?>"
                            stroke-linecap="round" transform="rotate(-90 50 50)" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-800">65%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 text-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold mb-6">Actions rapides</h3>
            <div class="space-y-3">
                <a href="visites.php?action=add" class="flex items-center justify-between p-3 bg-white/10 hover:bg-white/20 rounded-lg transition">
                    <span>
                        <i class="fas fa-plus mr-3"></i>
                        Nouvelle visite
                    </span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a href="animaux.php?action=add" class="flex items-center justify-between p-3 bg-white/10 hover:bg-white/20 rounded-lg transition">
                    <span>
                        <i class="fas fa-paw mr-3"></i>
                        Ajouter un animal
                    </span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a href="utilisateurs.php" class="flex items-center justify-between p-3 bg-white/10 hover:bg-white/20 rounded-lg transition">
                    <span>
                        <i class="fas fa-user-cog mr-3"></i>
                        Gérer les utilisateurs
                    </span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Tableaux -->
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Derniers utilisateurs -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Derniers inscrits</h3>
                    <a href="utilisateurs.php" class="text-sm text-green-600 hover:text-green-800">
                        Voir tout
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <?php if (count($latest_users) > 0): ?>
                        <?php foreach ($latest_users as $user){

                        ?>
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                        <?php echo strtoupper(substr($user['nom'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800"><?php echo htmlspecialchars($user['nom']); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></p>
                                    </div>
                                </div>

                            </div>
                        <?php }; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-users text-3xl mb-3 opacity-50"></i>
                            <p>Aucun utilisateur inscrit</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Prochaines visites -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Prochaines visites</h3>
                    <a href="visites.php" class="text-sm text-green-600 hover:text-green-800">
                        Voir tout
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <?php if (count($upcoming_visits) > 0): ?>
                        <?php foreach ($upcoming_visits as $visit){
                            $visit_date = date('d/m H:i', strtotime($visit['dateheure']));
                            $reservation_count = $visit['reservations'] ?? 0;
                        ?>
                            <div class="p-3 border border-gray-200 rounded-lg hover:border-green-300 transition">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-medium text-gray-800"><?php echo htmlspecialchars($visit['titre']); ?></h4>
                                    <span class="text-sm text-green-600 font-medium"><?php echo $visit_date; ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-users mr-1"></i>
                                        <?php echo $reservation_count; ?> réservation(s)
                                    </span>
                                    <a href="reservations.php?visite=<?php echo $visit['id'] ?? ''; ?>" class="text-sm text-blue-600 hover:text-blue-800">
                                        Voir les réservations
                                    </a>
                                </div>
                            </div>
                        <?php }; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-times text-3xl mb-3 opacity-50"></i>
                            <p>Aucune visite programmée</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Pied de page du dashboard -->
    <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Besoin d'aide ?</h3>
                <p class="text-gray-600">Consultez la documentation ou contactez le support</p>
            </div>
            <div class="flex space-x-3 mt-4 md:mt-0">
                <button class="bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-question-circle mr-2"></i>
                    Documentation
                </button>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-headset mr-2"></i>
                    Support
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation pour les cartes
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée des cartes
        const cards = document.querySelectorAll('.bg-gradient-to-br, .bg-white');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Animation au survol des cartes de statistiques
        const statCards = document.querySelectorAll('.bg-gradient-to-br');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>