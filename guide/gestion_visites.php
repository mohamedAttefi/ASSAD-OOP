<?php
include '../includes/header.php';
include '../includes/db.php';
include '../includes/classes/visite.php';

$visite = new visite("","","","","","","","","");

$result = $visite->getAll($conn, $_SESSION['user_id']);
?>

<!-- Hero Section -->
<section class="py-6 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Gestion des visites guidées</h1>
                <p class="text-green-100">Créez et gérez les visites virtuelles du zoo</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="bg-green-600 px-4 py-2 rounded-full text-sm font-medium">
                    <?php echo count($result) ?> visite(s)
                </span>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Formulaire d'ajout/modification -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-center mb-6">
            <div class="bg-green-100 p-3 rounded-full mr-4">
                <i class="fas fa-plus text-green-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Nouvelle visite guidée</h2>
                <p class="text-gray-600">Remplissez les informations pour créer une visite</p>
            </div>
        </div>

        <form method="post" action="visites_CRUD/action.php" class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Colonne gauche -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Titre de la visite *
                    </label>
                    <input type="text"
                        name="titre"
                        id="titre"
                        placeholder="Ex: Découverte des lions des Atlas"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Date et heure *
                    </label>
                    <input type="datetime-local"
                    id="dateheure"
                        name="dateheure"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Durée (min) *
                        </label>
                        <input type="number"
                        id="duree"
                            name="duree"
                            placeholder="90"
                            min="15"
                            step="15"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Prix (DH) *
                        </label>
                        <input type="number"
                        id="prix"
                            name="prix"
                            placeholder="150"
                            min="0"
                            step="10"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required>
                    </div>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Langue *
                    </label>
                    <select name="langue" id="langue"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        <option value="Français">Français</option>
                        <option value="Anglais">Anglais</option>
                        <option value="Arabe">Arabe</option>
                        <option value="Espagnol">Espagnol</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Capacité maximale *
                    </label>
                    <input type="number"
                        name="capacite_max"
                        id="capacite_max"
                        placeholder="50"
                        min="1"
                        max="500"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Statut
                    </label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio"
                            id="statut_active"
                                name="statut"
                                value="active"
                                checked
                                class="text-green-600 focus:ring-green-500">
                            <span class="ml-2">Active</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio"
                                name="statut"
                                id="statut_inactive"
                                value="anuulee"
                                class="text-red-600 focus:ring-red-500">
                            <span class="ml-2">Inactive</span>
                        </label>
                    </div>
                </div>

                <!-- Bouton d'action -->
                <div class="pt-4">
                    <button type="submit" id="action" name="ajouter"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition transform hover:-translate-y-1 shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer la visite
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Liste des visites existantes -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Visites existantes</h3>
                <span class="text-sm text-gray-600">
                    <?php echo count($result); ?> visite(s) programmée(s)
                </span>
            </div>
        </div>

        <?php if (count($result) == 0): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-binoculars"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Aucune visite</h3>
                <p class="text-gray-600">Commencez par créer votre première visite guidée.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Visite
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date & Heure
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Détails
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($result as $row){
                            $date_formatted = date('d/m/Y H:i', strtotime($row['dateheure']));
                            $is_active = $row['statutVisite'] == 'active';
                            
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Titre -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-binoculars text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900"><?php echo htmlspecialchars($row['titre']); ?></div>
                                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($row['langue']); ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Date & Heure -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-medium"><?php echo $date_formatted; ?></div>
                                    <div class="text-sm text-gray-500"><?php echo $row['duree']; ?> minutes</div>
                                </td>

                                <!-- Détails -->
                                <td class="px-6 py-4">
                                    <div class="text-sm">
                                        <div class="flex items-center text-gray-600 mb-1">
                                            <i class="fas fa-users text-gray-400 mr-2 w-4"></i>
                                            <?php echo $row['capacite_max']; ?> places max
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-money-bill-wave text-gray-400 mr-2 w-4"></i>
                                            <?php echo number_format($row['prix'], 0); ?> DH
                                        </div>
                                    </div>
                                </td>

                                <!-- Statut -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo $is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                        <?php if ($is_active): ?>
                                            <i class="fas fa-circle text-green-500 mr-2" style="font-size: 8px;"></i>
                                            Active
                                        <?php else: ?>
                                            <i class="fas fa-circle text-gray-400 mr-2" style="font-size: 8px;"></i>
                                            Inactive
                                        <?php endif; ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button name="modifier" value="<?php echo $row['id']; ?>" onclick="editVisite(
        <?php echo $row['id']; ?>,
        '<?php echo addslashes($row['titre']); ?>',
        '<?php echo $row['dateheure']; ?>',
        <?php echo $row['duree']; ?>,
        <?php echo $row['prix']; ?>,
        '<?php echo $row['langue']; ?>',
        <?php echo $row['capacite_max']; ?>,
        '<?php echo $row['statut']; ?>'
    )"
                                            class=" text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition"
                                            title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="visites_CRUD/action.php" method="post">
                                            <button value="<?php echo $row['id']; ?>" name="supprimer"
                                                class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette visite ?')"
                                                title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <button class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition"
                                            title="Voir les réservations">
                                            <i class="fas fa-users"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Affichage de 1 à <?php echo count($result); ?> visite(s)
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50 transition disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded text-gray-600 hover:bg-gray-50 transition">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <?php if (count($result) > 0):
        $active_count = 0;
        $total_capacity = 0;

        foreach ($result as $row){
            if ($row['statut'] == 'active') $active_count++;
            $total_capacity += $row['capacite_max'];
        };
    ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                <div class="flex items-center">
                    <div class="bg-green-600 p-3 rounded-full mr-4">
                        <i class="fas fa-calendar-alt text-white"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800"><?php echo $active_count; ?></p>
                        <p class="text-sm text-gray-600">Visites actives</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                <div class="flex items-center">
                    <div class="bg-blue-600 p-3 rounded-full mr-4">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800"><?php echo $total_capacity; ?></p>
                        <p class="text-sm text-gray-600">Places totales</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-amber-100 p-6 rounded-xl border border-amber-200">
                <div class="flex items-center">
                    <div class="bg-amber-600 p-3 rounded-full mr-4">
                        <i class="fas fa-money-bill-wave text-white"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">
                            <?php
                            $total_revenue = 0;
                            foreach ($result as $row){
                                $total_revenue += $row['prix'] * $row['capacite_max'];
                            };
                            echo number_format($total_revenue, 0);
                            ?> DH
                        </p>
                        <p class="text-sm text-gray-600">Revenu potentiel</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>    

    document.addEventListener('DOMContentLoaded', function() {
        const firstInput = document.querySelector('input[name="titre"]');
        if (firstInput) {
            firstInput.focus();
        }

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

    function editVisite(id, titre, dateheure, duree, prix, langue, capacite, statut) {

        document.getElementById('titre').value = titre;
        document.getElementById('dateheure').value = dateheure;
        document.getElementById('duree').value = duree;
        document.getElementById('prix').value = prix;
        document.getElementById('langue').value = langue;
        document.getElementById('capacite_max').value = capacite;

        if (statut == 'active') {
            document.getElementById('statut_active').checked = true;
        } else {
            document.getElementById('statut_inactive').checked = true;
        }

        document.getElementById('action').name = 'modifier';
        document.getElementById('action').value = id;

        document.getElementById('action').textContent = 'Modifier la visite';

        document.querySelector('form').scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>


