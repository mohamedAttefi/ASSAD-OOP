<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT r.id, v.titre, v.dateheure, v.duree, v.prix, 
               r.nbpersonnes, r.datereservation, v.statutVisite,
               u.nom as guide_nom
        FROM reservations r
        JOIN visitesguidees v ON r.idvisite = v.id
        LEFT JOIN utilisateurs u ON v.id_guide = u.id
        ORDER BY r.datereservation DESC";
$result_stmt = $conn->prepare($sql);
$result_stmt->execute();
$result = $result_stmt->fetchall();
?>

<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Mes Réservations</h1>
                <p class="text-xl text-green-100">Consultez l'historique de vos visites guidées</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-green-700/50 p-4 rounded-xl backdrop-blur-sm">
                    <p class="text-sm text-green-200">Nombre de réservations</p>
                    <p class="text-3xl font-bold"><?php echo count($result) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenu principal -->
<div class="max-w-7xl mx-auto px-4 mb-10">
    
    <!-- Filtres et actions -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Toutes vos réservations</h2>
                <p class="text-gray-600">Visites à venir et passées</p>
            </div>
            
            <div class="flex gap-3">
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nouvelle réservation
                </button>
                
                <button class="px-4 py-2 border border-green-600 text-green-600 hover:bg-green-50 rounded-lg font-medium transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filtres
                </button>
            </div>
        </div>
    </div>
    
    <!-- Statistiques rapides -->
    <?php if (count($result) > 0): 
        $upcoming = 0;
        $past = 0;
        $total_price = 0;
        
        foreach($result as $row){
            $visit_date = new DateTime($row['dateheure']);
            $today = new DateTime();
            
            if ($visit_date > $today) {
                $upcoming++;
            } else {
                $past++;
            }
            
            $total_price += ($row['prix'] * $row['nbpersonnes']);
        };
        
    ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">À venir</p>
                    <p class="text-3xl font-bold"><?php echo $upcoming; ?></p>
                </div>
                <div class="text-3xl">📅</div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm">Passées</p>
                    <p class="text-3xl font-bold"><?php echo $past; ?></p>
                </div>
                <div class="text-3xl">✅</div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm">Dépenses totales</p>
                    <p class="text-3xl font-bold"><?php echo number_format($total_price, 2); ?> €</p>
                </div>
                <div class="text-3xl">💰</div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Liste des réservations -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- En-tête du tableau -->
        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Détails des réservations</h3>
                <span class="text-sm text-gray-600">
                    <?php echo count($result) ?> réservation<?php echo count($result) > 1 ? 's' : ''; ?>
                </span>
            </div>
        </div>
        
        <?php if (count($result) == 0): ?>
            <!-- Aucune réservation -->
            <div class="text-center py-16">
                <div class="text-6xl mb-6">📭</div>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Aucune réservation</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore réservé de visite guidée.</p>
                <a href="#" class="inline-block bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition transform hover:-translate-y-1 shadow-lg">
                    Explorer les visites disponibles
                </a>
            </div>
        <?php else: ?>
            <!-- Tableau des réservations -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Visite
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Date & Guide
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Participants
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach($result as $row){ 
                            $visit_date = new DateTime($row['dateheure']);
                            $today = new DateTime();
                            $is_upcoming = $visit_date > $today;
                            $status_class = $is_upcoming ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
                            $status_text = $is_upcoming ? 'À venir' : 'Terminée';
                            $total_price = $row['prix'] * $row['nbpersonnes'];
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <!-- Visite -->
                            <td class="px-6 py-4">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-bold">V</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($row['titre']); ?></p>
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                            <?php echo htmlspecialchars($row['description'] ?? 'Visite guidée'); ?>
                                        </p>
                                        <p class="text-sm font-medium text-gray-700 mt-2">
                                            <?php echo number_format($row['prix'], 2); ?> € / personne
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Date & Guide -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="font-medium">
                                            <?php echo date('d/m/Y', strtotime($row['dateheure'])); ?>
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm text-gray-600"><?php echo $row['duree']; ?> min</span>
                                    </div>
                                    <?php if (!empty($row['guide_nom'])): ?>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-sm text-gray-600">
                                            <?php echo htmlspecialchars($row['guide_nom']); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            
                            <!-- Participants -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span class="font-bold text-lg"><?php echo $row['nbpersonnes']; ?></span>
                                        <span class="text-sm text-gray-600 ml-1">personne(s)</span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        Réservé le <?php echo date('d/m/Y', strtotime($row['datereservation'])); ?>
                                    </div>
                                    <div class="font-medium text-gray-800">
                                        Total : <?php echo number_format($total_price, 2); ?> €
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Statut -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo $status_class; ?>">
                                    <?php if ($is_upcoming): ?>
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php endif; ?>
                                    <?php echo $status_text; ?>
                                </span>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition" 
                                            title="Voir les détails">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    
                                    <?php if ($is_upcoming): ?>
                                    <button class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" 
                                            title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    
                                    <button class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition" 
                                            title="Annuler">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                    <?php else: ?>
                                    <button class="p-2 text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" 
                                            title="Laisser un avis">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                    </button>
                                    
                                    <button class="p-2 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition" 
                                            title="Télécharger facture">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Affichage de 1 à <?php echo count($result); ?> sur <?php echo count($result); ?> résultats
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition disabled:opacity-50" disabled>
                            Précédent
                        </button>
                        <button class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Section d'aide -->
    <div class="grid md:grid-cols-2 gap-8 mt-10">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
            <div class="flex items-center mb-4">
                <div class="bg-green-600 p-3 rounded-full mr-4">
                    <span class="text-white text-xl">❓</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Questions fréquentes</h3>
                    <p class="text-gray-600">Trouvez des réponses rapidement</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="bg-white p-4 rounded-lg">
                    <p class="font-medium text-gray-800 mb-2">Comment modifier une réservation ?</p>
                    <p class="text-sm text-gray-600">Cliquez sur l'icône ✏️ à côté de votre réservation à venir.</p>
                </div>
                
                <div class="bg-white p-4 rounded-lg">
                    <p class="font-medium text-gray-800 mb-2">Puis-je annuler une réservation ?</p>
                    <p class="text-sm text-gray-600">Oui, jusqu'à 48h avant la visite via l'icône 🗑️.</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-center mb-4">
                <div class="bg-blue-600 p-3 rounded-full mr-4">
                    <span class="text-white text-xl">📞</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Besoin d'aide ?</h3>
                    <p class="text-gray-600">Notre équipe est là pour vous</p>
                </div>
            </div>
            
            <p class="text-gray-700 mb-4">Pour toute question concernant vos réservations, contactez notre service client :</p>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span class="font-medium">01 23 45 67 89</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-medium">contact@zoo-assad.fr</span>
                </div>
                
                <a href="#" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    Contacter le support
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Animation pour les cartes de statistiques
document.addEventListener('DOMContentLoaded', function() {
    const statCards = document.querySelectorAll('.bg-gradient-to-r');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animation pour les lignes du tableau
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f9fafb';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>

