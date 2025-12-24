<?php
include "includes/header.php";
include "includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guide') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    
}


$user_id  = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'];
$sql = "select * from visitesguidees v join utilisateurs u  on v.id_guide = u.id join reservations r on v.id = r.idvisite where v.id_guide = $user_id order by v.dateheure limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($data);
?>

<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-blue-800 to-blue-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                    <i class="fas fa-user-tie mr-2"></i>
                    <span class="font-medium">Guide Professionnel</span>
                </div>
                <h1 class="text-4xl font-bold mb-2">Bienvenue, <?php echo htmlspecialchars($user_nom); ?> !</h1>
                <p class="text-xl text-blue-100">Gérez vos visites et interagissez avec les participants</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <p class="text-sm text-blue-200">Statut</p>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <p class="font-bold text-lg">Disponible</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Statistiques rapides -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Visites programmées -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm">Visites</p>
                    <p class="text-3xl font-bold">12</p>
                    <p class="text-blue-200 text-sm mt-2">Programmées ce mois</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-blue-400">
                <a href="mes-visites.php" class="text-sm text-blue-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir le calendrier
                </a>
            </div>
        </div>

        <!-- Participants totaux -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-emerald-100 text-sm">Participants</p>
                    <p class="text-3xl font-bold">156</p>
                    <p class="text-emerald-200 text-sm mt-2">Ce mois</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-emerald-400">
                <a href="participants.php" class="text-sm text-emerald-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir les participants
                </a>
            </div>
        </div>

        <!-- Note moyenne -->
        <div class="bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-amber-100 text-sm">Satisfaction</p>
                    <p class="text-3xl font-bold">4.8</p>
                    <p class="text-amber-200 text-sm mt-2">/ 5 étoiles</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-star text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-amber-400">
                <a href="avis.php" class="text-sm text-amber-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Voir les avis
                </a>
            </div>
        </div>

        <!-- Revenus -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100 text-sm">Revenus</p>
                    <p class="text-3xl font-bold">4,250</p>
                    <p class="text-purple-200 text-sm mt-2">DH ce mois</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-purple-400">
                <a href="finances.php" class="text-sm text-purple-200 hover:text-white flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Détails financiers
                </a>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Colonne gauche - Calendrier et prochaines visites -->
        <div class="lg:col-span-2">
            
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Prochaine visite</h2>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-circle text-green-500 mr-1" style="font-size: 8px;"></i>
                        <?= $data["statutVisite"] ?>
                    </span>
                </div>

                <div class="border border-blue-200 rounded-xl p-6 bg-gradient-to-r from-blue-50 to-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2"><?= $data["titre"] ?></h3>
                            <div class="flex items-center text-gray-600">
                                <i class="far fa-calendar mr-2"></i>
                                <span><?= $data["dateheure"] ?></span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <div class="text-2xl font-bold text-blue-600"><?= $data["prix"] ?> DH</div>
                            <div class="text-sm text-gray-500">par participant</div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Participants</p>
                                    <p class="text-xl font-bold text-gray-800"><?= $data["nbpersonnes"] ?>/<?= $data["capacite_max"] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-language text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Langue</p>
                                    <p class="text-xl font-bold text-gray-800"><?= $data["langue"] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-hourglass-half text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Durée</p>
                                    <p class="text-xl font-bold text-gray-800"><?= $data["duree"] ?> min</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center">
                            <i class="fas fa-play-circle mr-2"></i>
                            Démarrer la visite
                        </button>
                        <button class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg font-medium transition flex items-center">
                            <i class="fas fa-list mr-2"></i>
                            Liste des participants
                        </button>
                        <button class="border border-gray-300 text-gray-700 hover:bg-gray-50 px-6 py-3 rounded-lg font-medium transition flex items-center">
                            <i class="fas fa-file-alt mr-2"></i>
                            Notes de visite
                        </button>
                    </div>
                </div>
            </div>

            <!-- Visites de la semaine -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-week text-green-600"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Visites de la semaine</h2>
                            <p class="text-gray-600">Planification des 7 prochains jours</p>
                        </div>
                    </div>
                    <a href="calendrier.php" class="text-green-600 hover:text-green-800 font-medium">
                        <i class="fas fa-expand-alt mr-1"></i>
                        Vue complète
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Heure
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Visite
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Participants
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <!-- Ligne 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4">
                                    <div class="text-sm font-medium text-gray-900">Demain<br>10h00</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-900">Safari virtuel savane</div>
                                    <div class="text-sm text-gray-500">Visite standard</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-users text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">18/25</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Confirmée
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 p-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Ligne 2 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4">
                                    <div class="text-sm font-medium text-gray-900">Jeu. 12 déc<br>14h30</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-900">Les oiseaux exotiques</div>
                                    <div class="text-sm text-gray-500">Visite famille</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-users text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">12/20</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        En attente
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 p-1">
                                        <i class="fas fa-user-plus"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Ligne 3 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4">
                                    <div class="text-sm font-medium text-gray-900">Ven. 13 déc<br>11h00</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-medium text-gray-900">Nuit des prédateurs</div>
                                    <div class="text-sm text-gray-500">Visite spéciale</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                            <i class="fas fa-users text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">30/30</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Complète
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <button class="text-blue-600 hover:text-blue-800 p-1">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Colonne droite - Outils et informations -->
        <div class="space-y-8">
            <!-- Outils du guide -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-tools text-blue-600 mr-3"></i>
                    Outils du guide
                </h2>

                <div class="grid grid-cols-2 gap-4">
                    <a href="creer-visite.php" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <p class="font-medium text-gray-800">Nouvelle visite</p>
                    </a>

                    <a href="presentation.php" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-slideshow text-white"></i>
                        </div>
                        <p class="font-medium text-gray-800">Présentations</p>
                    </a>

                    <a href="ressources.php" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                        <p class="font-medium text-gray-800">Ressources</p>
                    </a>

                    <a href="statistiques.php" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-chart-bar text-white"></i>
                        </div>
                        <p class="font-medium text-gray-800">Statistiques</p>
                    </a>
                </div>
            </div>

            <!-- Avis récents -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-star text-amber-500 mr-3"></i>
                    Avis récents
                </h2>

                <div class="space-y-4">
                    <div class="border-l-4 border-green-500 pl-4 py-2">
                        <div class="flex items-center mb-2">
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-sm text-gray-500 ml-2">Hier</span>
                        </div>
                        <p class="text-gray-800 font-medium mb-1">"Guide passionnant !"</p>
                        <p class="text-sm text-gray-600">Marie D. - Visite des félins</p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <div class="flex items-center mb-2">
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-sm text-gray-500 ml-2">Il y a 2 jours</span>
                        </div>
                        <p class="text-gray-800 font-medium mb-1">"Très instructif"</p>
                        <p class="text-sm text-gray-600">Jean P. - Safari virtuel</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="avis.php" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                        <i class="fas fa-comments mr-2"></i>
                        Voir tous les avis (24)
                    </a>
                </div>
            </div>

            <!-- Disponibilité -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Ma disponibilité</h2>

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Cette semaine</p>
                            <p class="text-sm text-gray-500">3 visites sur 5 créneaux</p>
                        </div>
                        <div class="w-24 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Ce mois</p>
                            <p class="text-sm text-gray-500">12 visites sur 20 créneaux</p>
                        </div>
                        <div class="w-24 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button class="w-full bg-gray-800 hover:bg-gray-900 text-white py-2 rounded-lg font-medium transition">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Gérer mon calendrier
                    </button>
                </div>
            </div>

            <!-- Informations importantes -->
            <div class="bg-gradient-to-r from-amber-50 to-amber-100 rounded-xl p-6 border border-amber-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-amber-600 mr-3"></i>
                    Informations importantes
                </h2>

                <div class="space-y-3">
                    <div class="flex items-start">
                        <i class="fas fa-bullhorn text-amber-600 mt-1 mr-3"></i>
                        <p class="text-sm text-gray-700">Réunion d'équipe demain à 10h</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-clock text-amber-600 mt-1 mr-3"></i>
                        <p class="text-sm text-gray-700">Nouvelle procédure de connexion aux visites</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-gift text-amber-600 mt-1 mr-3"></i>
                        <p class="text-sm text-gray-700">Bonus de performance disponible</p>
                    </div>
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