<?php
include '../includes/header.php';
include '../includes/db.php';
include '../includes/classes/utilisateur.php';

$user = new utilisateur("","","","");


$result = $user->getCountReservation($conn);


$stats = $user->getCountByRole($conn);


?>

<!-- Hero Section -->
<section class="py-6 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Gestion des Utilisateurs</h1>
                <p class="text-green-100">Administrez les comptes et les permissions</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-4">
                <span class="bg-green-600 px-4 py-2 rounded-full text-sm font-medium">
                    <?php echo $stats['total']; ?> utilisateur(s)
                </span>
                <a href="ajouter_utilisateur.php" class="bg-white text-green-700 px-4 py-2 rounded-lg font-medium hover:bg-green-50 transition">
                    <i class="fas fa-user-plus mr-2"></i>Ajouter
                </a>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm">Visiteurs</p>
                    <p class="text-3xl font-bold"><?php echo $stats['visiteurs']; ?></p>
                    <p class="text-blue-200 text-sm mt-2">Membres</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-user text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100 text-sm">Guides</p>
                    <p class="text-3xl font-bold"><?php echo $stats['guides']; ?></p>
                    <p class="text-purple-200 text-sm mt-2">Professionnels</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-user-tie text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-red-100 text-sm">Admins</p>
                    <p class="text-3xl font-bold"><?php echo $stats['admins']; ?></p>
                    <p class="text-red-200 text-sm mt-2">Administrateurs</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-crown text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-emerald-100 text-sm">Approuvés</p>
                    <p class="text-3xl font-bold"><?php echo $stats['approuves']; ?></p>
                    <p class="text-emerald-200 text-sm mt-2">/ <?php echo $stats['guides']; ?> guides</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-amber-600 text-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-amber-100 text-sm">Actifs</p>
                    <p class="text-3xl font-bold"><?php echo $stats['actifs']; ?></p>
                    <p class="text-amber-200 text-sm mt-2">/ <?php echo $stats['inactifs']; ?> inactifs</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <i class="fas fa-users-cog text-green-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tous les utilisateurs</h2>
                    <p class="text-gray-600">Filtrez et gérez les comptes</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <input type="text"
                    placeholder="Rechercher un utilisateur..."
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 w-full md:w-64"
                    id="searchInput">

                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"
                    id="filterRole">
                    <option value="">Tous les rôles</option>
                    <option value="visiteur">Visiteur</option>
                    <option value="guide">Guide</option>
                    <option value="admin">Admin</option>
                </select>

                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"
                    id="filterStatus">
                    <option value="">Tous les statuts</option>
                    <option value="approuvee">Approuvé</option>
                    <option value="en_attente">En attente</option>
                </select>

                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500"
                    id="filterActif">
                    <option value="">Tous les états</option>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Liste des utilisateurs</h3>
                <span class="text-sm text-gray-600">
                    <?php echo count($result)?> utilisateur(s)
                </span>
            </div>
        </div>

        <?php if (count($result) == 0): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-users-slash"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun utilisateur</h3>
                <p class="text-gray-600">Aucun utilisateur n'est inscrit sur la plateforme.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Utilisateur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact & Activité
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rôle
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut Guide
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                État Compte
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($result as $row){
                            $role_color = match ($row['role']) {
                                'admin' => 'bg-red-100 text-red-800',
                                'guide' => 'bg-purple-100 text-purple-800',
                                default => 'bg-blue-100 text-blue-800'
                            };
                            $role_icon = match ($row['role']) {
                                'admin' => 'fa-crown',
                                'guide' => 'fa-user-tie',
                                default => 'fa-user'
                            };
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors user-row"
                                data-name="<?php echo strtolower($row['nom']); ?>"
                                data-email="<?php echo strtolower($row['email']); ?>"
                                data-role="<?php echo $row['role']; ?>"
                                data-approved="<?php echo $row['statut'] ?? ''; ?>"
                                <!-- Utilisateur -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                            <?php echo $row['role'] == 'admin' ? 'bg-red-500' : ($row['role'] == 'guide' ? 'bg-purple-500' : 'bg-blue-500'); ?>">
                                                <span class="text-white font-bold">
                                                    <?php echo strtoupper(substr($row['nom'], 0, 1)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">
                                                <?php echo htmlspecialchars($row['nom']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact & Activité -->
                                <td class="px-6 py-4">
                                    <div class="space-y-2">
                                        <div class="text-sm">
                                            <a href="mailto:<?php echo $row['email']; ?>"
                                                class="text-blue-600 hover:text-blue-800">
                                                <?php echo htmlspecialchars($row['email']); ?>
                                            </a>
                                        </div>
                                        <div class="flex space-x-4 text-xs text-gray-500">
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar-check mr-1"></i>
                                                <?php echo $row['nb_reservations'] ?? 0; ?> résa.
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-comment mr-1"></i>
                                                <?php echo $row['nb_commentaires'] ?? 0; ?> avis
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Rôle -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo $role_color; ?>">
                                        <i class="fas <?php echo $role_icon; ?> mr-2"></i>
                                        <?php echo ucfirst($row['role']); ?>
                                    </span>
                                </td>

                                <!-- Statut Guide -->
                                <td class="px-6 py-4">
                                    <?php if ($row['role'] == 'guide'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        <?php echo $row['statut'] == 'approuvee' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                            <i class="fas <?php echo $row['statut'] == 'approuvee' ? 'fa-check-circle' : 'fa-clock'; ?> mr-2"></i>
                                            <?php echo $row['statut'] == 'approuvee' ? 'approuvee' : 'En attente'; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-minus mr-2"></i>
                                            Non applicable
                                        </span>
                                    <?php endif; ?>
                                </td>
                                

                                <!-- État du Compte -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        <?php echo $row['statut'] == 'actif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                        <i class="fas <?php echo $row['statut'] == 'actif' ? 'fa-check-circle' : 'fa-times-circle'; ?> mr-2"></i>
                                        <?php echo $row['statut'] == 'actif' ? 'Actif' : 'Inactif'; ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <?php if ($row['role'] == 'guide'): ?>
                                            <form method='post' action="users_CRUD/actionGuide.php">
                                                <button name="<?php echo $row['statut'] == 'approuvee' ? 'desapprouvee' : 'approuvee'; ?>" value='<?= $row['id']; ?>'
                                                    class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition"
                                                    title="<?php echo $row['statut'] == 'approuvee' ? 'Désapprouver' : 'Approuver'; ?>">
                                                    <i class="fas <?php echo $row['statut'] == 'approuvee' ? 'fa-times-circle' : 'fa-check-circle'; ?>"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>

                                        <form method='post' action="users_CRUD/actionVisiteur.php">
                                            <button name="<?php echo $row['statut'] == "actif" ? 'desactiverCompte' : 'activerCompte'; ?>" 
                                                    value='<?= $row['id']; ?>'
                                                    class="text-orange-600 hover:text-orange-800 p-2 hover:bg-orange-50 rounded-lg transition"
                                                    title="<?php echo $row['statut'] == "actif" ? 'Désactiver le compte' : 'Activer le compte'; ?>"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir <?php echo $row['statut'] == 'actif' ? 'désactiver' : 'activer'; ?> ce compte ?')">
                                                <i class="fas <?php echo $row['statut'] == "actif" ? 'fa-user-slash' : 'fa-user-check'; ?>"></i>
                                            </button>
                                        </form>
                                        <?php endif; ?>

                                        <a href="editer_utilisateur.php?id=<?php echo $row['id']; ?>"
                                            class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition"
                                            title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button class="text-purple-600 hover:text-purple-800 p-2 hover:bg-purple-50 rounded-lg transition"
                                            title="Voir détails"
                                            onclick="showUserDetails(<?php echo $row['id']; ?>)">
                                            <i class="fas fa-eye"></i>
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
                        Affichage de 1 à <?php echo count($result) ?> utilisateur(s)
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

    <!-- Informations et guide -->
    <div class="grid md:grid-cols-2 gap-8 mt-8">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-green-600 mr-3"></i>
                Guide de gestion
            </h3>
            <div class="space-y-4">
                <div class="bg-white p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                        <p class="font-medium text-gray-800">Comptes actifs</p>
                    </div>
                    <p class="text-sm text-gray-600">Peut se connecter et utiliser toutes les fonctionnalités.</p>
                </div>

                <div class="bg-white p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="w-3 h-3 bg-gray-500 rounded-full mr-3"></div>
                        <p class="font-medium text-gray-800">Comptes inactifs</p>
                    </div>
                    <p class="text-sm text-gray-600">Ne peut pas se connecter. Utile pour suspension temporaire.</p>
                </div>

                <div class="bg-white p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                        <p class="font-medium text-gray-800">Guides en attente</p>
                    </div>
                    <p class="text-sm text-gray-600">Doit être approuvé par un administrateur.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                Actions rapides
            </h3>
            <div class="space-y-3">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition flex items-center justify-center">
                    <i class="fas fa-file-export mr-3"></i>
                    Exporter la liste (CSV)
                </button>
                <button class="w-full border-2 border-blue-600 text-blue-600 hover:bg-blue-50 py-3 rounded-lg font-medium transition flex items-center justify-center">
                    <i class="fas fa-envelope mr-3"></i>
                    Envoyer un email groupé
                </button>
                <button class="w-full border-2 border-orange-600 text-orange-600 hover:bg-orange-50 py-3 rounded-lg font-medium transition flex items-center justify-center"
                        onclick="activerTousComptes()">
                    <i class="fas fa-user-check mr-3"></i>
                    Activer tous les comptes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Filtrage et recherche
    const searchInput = document.getElementById('searchInput');
    const filterRole = document.getElementById('filterRole');
    const filterStatus = document.getElementById('filterStatus');
    const filterActif = document.getElementById('filterActif');
    const userRows = document.querySelectorAll('.user-row');

    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = filterRole.value;
        const selectedStatus = filterStatus.value;
        const selectedActif = filterActif.value;

        userRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            const role = row.getAttribute('data-role');
            const approved = row.getAttribute('data-approved');
            const actif = row.getAttribute('data-actif');

            let show = true;

            // Filtre par recherche
            if (searchTerm && !name.includes(searchTerm) && !email.includes(searchTerm)) {
                show = false;
            }

            // Filtre par rôle
            if (selectedRole && role !== selectedRole) {
                show = false;
            }

            // Filtre par statut (seulement pour les guides)
            if (selectedStatus && role === 'guide' && approved !== selectedStatus) {
                show = false;
            }

            // Filtre par état actif/inactif
            if (selectedActif && actif !== selectedActif) {
                show = false;
            }

            row.style.display = show ? '' : 'none';
        });
    }

    // Événements
    searchInput.addEventListener('input', filterUsers);
    filterRole.addEventListener('change', filterUsers);
    filterStatus.addEventListener('change', filterUsers);
    filterActif.addEventListener('change', filterUsers);

    function activerTousComptes() {
        if (confirm('Êtes-vous sûr de vouloir activer tous les comptes inactifs ?')) {
            // Vous pouvez implémenter une requête AJAX ici
            // ou rediriger vers une action spécifique
            window.location.href = 'users_CRUD/action.php?action=activer_tous';
        }
    }

    function showUserDetails(userId) {
        // Implémentez la fonction de détails si nécessaire
        alert('Détails de l\'utilisateur ID: ' + userId);
    }

    // Animation pour les lignes du tableau
    document.addEventListener('DOMContentLoaded', function() {
        userRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f9fafb';
            });

            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

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
    });
</script>