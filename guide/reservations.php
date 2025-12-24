<?php
include '../includes/header.php';
include '../includes/db.php';

$sql = "SELECT r.id, r.nbpersonnes, r.datereservation, 
               u.nom, u.email,
               v.titre as visite_titre, v.prix, v.dateheure
        FROM reservations r
        JOIN utilisateurs u ON r.idutilisateur = u.id
        JOIN visitesguidees v ON r.idvisite = v.id
        ORDER BY r.datereservation DESC";
$result_stmt = $conn->prepare($sql);
$result_stmt->execute();
$result = $result_stmt->fetchall();
?>

<!-- Hero Section -->
<section class="py-6 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Gestion des réservations</h1>
                <p class="text-green-100">Suivez toutes les réservations de visites guidées</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-4">
                <span class="bg-green-600 px-4 py-2 rounded-full text-sm font-medium">
                    <?php echo count($result) ?> réservation(s)
                </span>
                <button class="bg-white text-green-700 px-4 py-2 rounded-lg font-medium hover:bg-green-50 transition">
                    <i class="fas fa-download mr-2"></i>Exporter
                </button>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Filtres et actions -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Toutes les réservations</h2>
                    <p class="text-gray-600">Consultez et gérez les inscriptions</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                    <option>Toutes les visites</option>
                    <option>Visites à venir</option>
                    <option>Visites passées</option>
                </select>

                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                    <option>Tous les statuts</option>
                    <option>Confirmées</option>
                    <option>En attente</option>
                    <option>Annulées</option>
                </select>

                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    <i class="fas fa-filter mr-2"></i>Filtrer
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <?php if (count($result) > 0):
        $confirmed = 0;
        $pending = 0;
        $total_persons = 0;
        $total_revenue = 0;

        foreach ($result as $row){
            $total_persons += $row['nbpersonnes'];
            $total_revenue += $row['prix'] * $row['nbpersonnes'];
            
        };
    ?>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Total réservations</p>
                        <p class="text-3xl font-bold"><?php echo count($result) ?></p>
                    </div>
                    <i class="fas fa-ticket-alt text-3xl opacity-80"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Participants total</p>
                        <p class="text-3xl font-bold"><?php echo $total_persons; ?></p>
                    </div>
                    <i class="fas fa-users text-3xl opacity-80"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm">Revenu total</p>
                        <p class="text-3xl font-bold"><?php echo number_format($total_revenue, 0); ?> DH</p>
                    </div>
                    <i class="fas fa-money-bill-wave text-3xl opacity-80"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Confirmées</p>
                        <p class="text-3xl font-bold"><?php echo $confirmed; ?></p>
                    </div>
                    <i class="fas fa-check-circle text-3xl opacity-80"></i>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Liste des réservations -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Détails des réservations</h3>
                <span class="text-sm text-gray-600">
                    <?php echo count($result) ?> enregistrement(s)
                </span>
            </div>
        </div>

        <?php if (count($result) == 0): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Aucune réservation</h3>
                <p class="text-gray-600">Aucune réservation n'a été effectuée pour le moment.</p>
            </div>
        <?php else:
        ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Visiteur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Visite
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Participants
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date & Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($result as $row){
                            $reservation_date = date('d/m/Y H:i', strtotime($row['datereservation']));
                            $visit_date = date('d/m/Y', strtotime($row['dateheure']));
                            $total_price = $row['prix'] * $row['nbpersonnes'];

                            // Déterminer la couleur du statut
                            $status_class = 'bg-gray-100 text-gray-800';
                            $status_icon = 'fa-clock';
                           
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Visiteur -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                                                <span class="text-white font-bold">
                                                    <?php echo strtoupper(substr($row['nom'], 0, 1)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">
                                                <?php echo htmlspecialchars($row['nom']); ?>
                                            </div>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($row['email']); ?></div>
                                            
                                        </div>
                                    </div>
                                </td>

                                <!-- Visite -->
                                <td class="px-6 py-4">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-900">
                                            <?php echo htmlspecialchars($row['visite_titre']); ?>
                                        </div>
                                        <div class="text-gray-500 mt-1">
                                            <i class="far fa-calendar mr-2"></i><?php echo $visit_date; ?>
                                        </div>
                                        <div class="text-green-600 font-medium mt-1">
                                            <?php echo number_format($total_price, 0); ?> DH
                                        </div>
                                    </div>
                                </td>

                                <!-- Participants -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex flex-col items-center justify-center mr-3">
                                            <span class="text-xl font-bold text-blue-700"><?php echo $row['nbpersonnes']; ?></span>
                                            <span class="text-xs text-blue-500">pers.</span>
                                        </div>
                                        <div class="text-sm">
                                            <div class="text-gray-600"><?php echo number_format($row['prix'], 0); ?> DH/pers</div>
                                            <div class="text-gray-400">x <?php echo $row['nbpersonnes']; ?> personne(s)</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Date & Statut -->
                                <td class="px-6 py-4">
                                    <div class="space-y-2">
                                        <div class="text-sm text-gray-600">
                                            <i class="far fa-clock mr-2"></i><?php echo $reservation_date; ?>
                                        </div>
                                    
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition"
                                            title="Confirmer">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition"
                                            title="Détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition"
                                            title="Annuler"
                                            onclick="return confirm('Annuler cette réservation ?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-800 p-2 hover:bg-purple-50 rounded-lg transition"
                                            title="Contacter">
                                            <i class="fas fa-envelope"></i>
                                        </button>
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
                        Affichage de 1 à <?php echo count($result) ?> réservation(s)
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition disabled:opacity-50" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Informations additionnelles -->
    <div class="grid md:grid-cols-2 gap-8 mt-8">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-line text-green-600 mr-3"></i>
                Réservations par mois
            </h3>
            <div class="h-48 flex items-end space-x-2">
                <?php for ($i = 1; $i <= 12; $i++):
                    $height = rand(20, 100);
                ?>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-green-400 rounded-t-lg" style="height: <?php echo $height; ?>%"></div>
                        <span class="text-xs text-gray-600 mt-2"><?php echo substr(date('F', mktime(0, 0, 0, $i, 1)), 0, 3); ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-cog text-gray-600 mr-3"></i>
                Actions rapides
            </h3>
            <div class="space-y-3">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition flex items-center justify-center">
                    <i class="fas fa-file-export mr-3"></i>
                    Exporter toutes les réservations (CSV)
                </button>
                <button class="w-full border-2 border-green-600 text-green-600 hover:bg-green-50 py-3 rounded-lg font-medium transition flex items-center justify-center">
                    <i class="fas fa-envelope mr-3"></i>
                    Envoyer un rappel aux participants
                </button>
                <button class="w-full border-2 border-gray-300 text-gray-600 hover:bg-gray-50 py-3 rounded-lg font-medium transition flex items-center justify-center">
                    <i class="fas fa-print mr-3"></i>
                    Imprimer la liste
                </button>
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