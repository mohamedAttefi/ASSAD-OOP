<?php
session_start();
include 'includes/header.php';
include 'includes/db.php';
print_r($_SESSION);
echo $_SESSION['user_id']; 

if (!isset($_SESSION['user_id'])) {
    // header('Location: login.php');
    // exit();
}



$reservations_count = $conn->query("
    SELECT COUNT(*) as total 
    FROM reservations 
    WHERE idutilisateur = {$_SESSION['user_id']};
")->fetch_assoc()['total'];

$upcoming_reservations = $conn->query("
    SELECT COUNT(*) as total 
    FROM reservations r
    JOIN visitesguidees v ON r.idvisite = v.id
    WHERE r.idutilisateur = {$_SESSION['user_id']}
    AND v.dateheure >= CURDATE()
    AND v.statutVisite = 'active'
")->fetch_assoc()['total'];



$comments_count = $conn->query("
    SELECT COUNT(*) as total 
    FROM commentaires 
    WHERE idutilisateur = 1
")->fetch_assoc()['total'];

$upcoming_visits = $conn->query("
    SELECT v.*, r.datereservation, r.nbpersonnes, r.statut
    FROM reservations r
    JOIN visitesguidees v ON r.idvisite = v.id
    WHERE r.idutilisateur = 1
    AND v.date_visite >= CURDATE()
    AND r.statut = 'confirmed'
    ORDER BY v.date_visite ASC
    LIMIT 3
");

$favorite_animals = $conn->query("
    SELECT a.* 
    FROM favoris f
    JOIN animaux a ON f.animal_id = a.id
    WHERE f.user_id = 1
    ORDER BY f.date_ajout DESC
    LIMIT 4
");

$recent_activities = $conn->query("
    (
        SELECT 'reservation' as type, v.titre, r.datereservation as date, 'Vous avez réservé une visite' as description
        FROM reservations r
        JOIN visitesguidees v ON r.idvisite = v.id
        WHERE r.idutilisateur = 1
        ORDER BY r.datereservation DESC
        LIMIT 3
    )
    UNION
    (
        SELECT 'commentaire' as type, v.titre, c.date_commentaire as date, 'Vous avez laissé un commentaire' as description
        FROM commentaires c
        JOIN visitesguidees v ON c.idvisite = v.id
        WHERE c.user_id = 1
        ORDER BY c.date_commentaire DESC
        LIMIT 2
    )
    ORDER BY date DESC
    LIMIT 5
");
?>

<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold mb-2">Bonjour, <?php echo htmlspecialchars($user_prenom ?: $user_nom); ?> !</h1>
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
                    <p class="text-3xl font-bold"><?php echo $reservations_count; ?></p>
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
        
        <!-- Visites à venir -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm">À venir</p>
                    <p class="text-3xl font-bold"><?php echo $upcoming_reservations; ?></p>
                    <p class="text-blue-200 text-sm mt-2">Prochaines visites</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-binoculars text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-blue-400">
                <a href="visites.php" class="text-sm text-blue-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Réserver une visite
                </a>
            </div>
        </div>
        
        <!-- Animaux favoris -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-amber-100 text-sm">Favoris</p>
                    <p class="text-3xl font-bold"><?php echo $favorites_count; ?></p>
                    <p class="text-amber-200 text-sm mt-2">Animaux préférés</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-amber-400">
                <a href="favoris.php" class="text-sm text-amber-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir mes favoris
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
                
                <?php if ($upcoming_visits->num_rows > 0): ?>
                    <div class="space-y-4">
                        <?php while($visit = $upcoming_visits->fetch_assoc()): 
                            $visit_date = date('d/m/Y H:i', strtotime($visit['date_visite']));
                            $reservation_date = date('d/m/Y', strtotime($visit['datereservation']));
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
                        <?php endwhile; ?>
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
            
            <!-- Animaux favoris -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-amber-100 p-3 rounded-full mr-4">
                            <i class="fas fa-heart text-amber-600"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Mes animaux favoris</h2>
                            <p class="text-gray-600">Les animaux que vous aimez</p>
                        </div>
                    </div>
                    <a href="favoris.php" class="text-amber-600 hover:text-amber-800 font-medium">
                        Voir tout
                    </a>
                </div>
                
                <?php if ($favorite_animals->num_rows > 0): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php while($animal = $favorite_animals->fetch_assoc()): ?>
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">
                            <div class="relative h-40 bg-gradient-to-r from-green-400 to-emerald-600">
                                <?php if (!empty($animal['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($animal['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($animal['nom']); ?>"
                                         class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-paw text-white text-4xl"></i>
                                    </div>
                                <?php endif; ?>
                                <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center text-amber-500 hover:text-amber-700">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-800 mb-1"><?php echo htmlspecialchars($animal['nom']); ?></h3>
                                <p class="text-sm text-gray-600 mb-2"><?php echo htmlspecialchars($animal['espece']); ?></p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500">
                                        <?php echo htmlspecialchars($animal['paysorigine']); ?>
                                    </span>
                                    <a href="animal.php?id=<?php echo $animal['id']; ?>" 
                                       class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        Voir la fiche
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-5xl mb-4">
                            <i class="fas fa-heart-broken"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun animal favori</h3>
                        <p class="text-gray-600 mb-4">Ajoutez des animaux à vos favoris pour les retrouver facilement</p>
                        <a href="animaux.php" class="inline-block bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-lg font-medium transition">
                            <i class="fas fa-paw mr-2"></i>
                            Découvrir les animaux
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Colonne droite - Activités et raccourcis -->
        <div class="space-y-8">
            <!-- Activités récentes -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-history text-green-600 mr-3"></i>
                    Activités récentes
                </h2>
                
                <div class="space-y-4">
                    <?php if ($recent_activities->num_rows > 0): ?>
                        <?php while($activity = $recent_activities->fetch_assoc()): 
                            $activity_date = date('d/m H:i', strtotime($activity['date']));
                            $activity_icon = $activity['type'] == 'reservation' ? 'fa-calendar-check text-green-500' : 'fa-comment text-blue-500';
                        ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas <?php echo $activity_icon; ?>"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-800"><?php echo htmlspecialchars($activity['description']); ?></p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo htmlspecialchars($activity['titre']); ?> • <?php echo $activity_date; ?>
                                </p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <p class="text-gray-500">Aucune activité récente</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="activites.php" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                        <i class="fas fa-list mr-2"></i>
                        Voir toutes les activités
                    </a>
                </div>
            </div>
            
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
                    $suggestions = $conn->query("
                        SELECT * FROM visitesguidees 
                        WHERE date_visite >= CURDATE() 
                        AND statut = 'active'
                        ORDER BY RAND() 
                        LIMIT 2
                    ");
                    
                    if ($suggestions->num_rows > 0):
                        while($suggestion = $suggestions->fetch_assoc()):
                    ?>
                    <div class="border border-gray-200 rounded-lg p-3 hover:border-green-300 transition">
                        <div class="flex justify-between items-start">
                            <h3 class="font-medium text-gray-800"><?php echo htmlspecialchars($suggestion['titre']); ?></h3>
                            <span class="text-green-600 font-bold"><?php echo number_format($suggestion['prix'], 0); ?> DH</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            <i class="far fa-calendar mr-1"></i>
                            <?php echo date('d/m/Y H:i', strtotime($suggestion['date_visite'])); ?>
                        </div>
                        <a href="visite-details.php?id=<?php echo $suggestion['id']; ?>" 
                           class="block text-center mt-3 text-sm bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition">
                            Découvrir
                        </a>
                    </div>
                    <?php endwhile; endif; ?>
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

