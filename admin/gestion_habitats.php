<?php
include '../includes/header.php';
include '../includes/db.php';
include '../includes/classes/habitat.php';

$habitat = new habitat("","","","");

$result = $habitat->getAll($conn);
?>

<!-- Hero Section -->
<section class="py-6 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Gestion des Habitats</h1>
                <p class="text-green-100">Créez et gérez les environnements du zoo virtuel</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="bg-green-600 px-4 py-2 rounded-full text-sm font-medium">
                    <?php echo count($result) ?> habitat(s) créé(s)
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
                <i class="fas fa-mountain text-green-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    <span id="form-title">Créer un nouvel habitat</span>
                </h2>
                <p class="text-gray-600">
                    <span id="form-subtitle">Définissez un environnement pour les animaux</span>
                </p>
            </div>
        </div>
        
        <form method="post" action="habitat_CRUD/actionHabitat.php" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="hidden" name="id" id="habitat-id">
            
            <!-- Colonne gauche -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de l'habitat *
                    </label>
                    <input type="text" 
                           name="nom" 
                           id="habitat-nom"
                           placeholder="Ex: Savane africaine" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                           required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Type de climat
                    </label>
                    <select name="typeclimat" 
                            id="habitat-climat"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        <option value="">Sélectionner...</option>
                        <option value="Tropical">Tropical</option>
                        <option value="Désertique">Désertique</option>
                        <option value="Tempéré">Tempéré</option>
                        <option value="Montagnard">Montagnard</option>
                        <option value="Polaire">Polaire</option>
                        <option value="Méditerranéen">Méditerranéen</option>
                    </select>
                </div>
            </div>
            
            <!-- Colonne droite -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Zone du zoo
                    </label>
                    <select name="zonezoo" 
                            id="habitat-zone"
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        <option value="">Sélectionner...</option>
                        <option value="Zone Afrique">Zone Afrique</option>
                        <option value="Zone Asie">Zone Asie</option>
                        <option value="Zone Amérique">Zone Amérique</option>
                        <option value="Zone Europe">Zone Europe</option>
                        <option value="Zone Océanie">Zone Océanie</option>
                        <option value="Zone Polaire">Zone Polaire</option>
                        <option value="Zone Tropicale">Zone Tropicale</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description" 
                              id="habitat-description"
                              rows="4"
                              placeholder="Décrivez l'environnement, la végétation, les caractéristiques..."
                              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"></textarea>
                </div>
                
                <!-- Bouton d'action -->
                <div class="pt-4">
                    <button type="submit" name="ajouterHabitat" id="action"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition transform hover:-translate-y-1 shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        <span id="submit-text">Créer l'habitat</span>
                    </button>
                    <button type="button"  
                            id="cancel-edit"
                            class="w-full mt-2 border-2 border-gray-300 text-gray-700 hover:bg-gray-50 py-2 px-4 rounded-lg transition hidden">
                        Annuler la modification
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Liste des habitats -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Habitats existants</h3>
                <span class="text-sm text-gray-600">
                    <?php echo count($result) ?> habitat(s)
                </span>
            </div>
        </div>
        
        <?php if (count($result) == 0): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-mountain"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun habitat créé</h3>
                <p class="text-gray-600">Commencez par créer votre premier habitat.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Habitat
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Informations
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Animaux
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach($result as $row){ 
                            $climat_icon = match($row['typeclimat']) {
                                'Tropical' => 'fa-sun',
                                'Désertique' => 'fa-temperature-high',
                                'Tempéré' => 'fa-cloud-sun',
                                'Montagnard' => 'fa-mountain',
                                'Polaire' => 'fa-snowflake',
                                'Méditerranéen' => 'fa-umbrella-beach',
                                default => 'fa-globe'
                            };
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Habitat -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-mountain text-white"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">
                                            <?php echo htmlspecialchars($row['nom']); ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <i class="fas <?php echo $climat_icon; ?> mr-1"></i>
                                            <?php echo htmlspecialchars($row['typeclimat']); ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Informations -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    <?php if (!empty($row['zonezoo'])): ?>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-map-marker-alt text-gray-400 mr-2 w-4"></i>
                                        <?php echo htmlspecialchars($row['zonezoo']); ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($row['description'])): ?>
                                    <div class="text-sm text-gray-500 line-clamp-2">
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            
                            <!-- Animaux -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="relative">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-paw text-white"></i>
                                        </div>
                                        <?php if ($row['nb_animaux'] > 0): ?>
                                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 text-white text-xs rounded-full flex items-center justify-center">
                                            <?php echo $row['nb_animaux']; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm text-gray-900 font-medium">
                                            <?php echo $row['nb_animaux']; ?> animal<?php echo $row['nb_animaux'] > 1 ? 's' : ''; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="editHabitat(<?php echo $row['id']; ?>, '<?php echo addslashes($row['nom']); ?>', '<?php echo addslashes($row['typeclimat']); ?>', '<?php echo addslashes($row['description']); ?>', '<?php echo addslashes($row['zonezoo']); ?>')" 
                                            class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="?delete=<?php echo $row['id']; ?>" 
                                       class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet habitat ? Cela affectera les animaux associés.')"
                                       title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <button class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition"
                                            title="Voir la fiche">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if ($row['nb_animaux'] > 0): ?>
                                    <button class="text-purple-600 hover:text-purple-800 p-2 hover:bg-purple-50 rounded-lg transition"
                                            title="Affecter des animaux">
                                        <i class="fas fa-link"></i>
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
                        Affichage de 1 à <?php echo count($result) ?> habitat(s)
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
    
    <!-- Statistiques et informations -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <!-- Statistiques -->
        <?php
        $stats_result_stmt = $conn->prepare("
            SELECT 
                COUNT(*) as total_habitats,
                COUNT(DISTINCT typeclimat) as climats_differents,
                COUNT(DISTINCT zonezoo) as zones_differentes,
                SUM(nb_animaux) as total_animaux
            FROM (
                SELECT h.*, COUNT(a.id) as nb_animaux 
                FROM habitats h 
                LEFT JOIN animaux a ON h.id = a.id_habitat 
                GROUP BY h.id
            ) as habitats_stats
        ");
        $stats_result_stmt->execute();
        $stats = $stats_result_stmt->fetch();
        ?>
        
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Statistiques des habitats</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-green-600"><?php echo $stats['total_habitats']; ?></p>
                    <p class="text-sm text-gray-600">Habitats</p>
                </div>
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-blue-600"><?php echo $stats['climats_differents']; ?></p>
                    <p class="text-sm text-gray-600">Climats</p>
                </div>
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-purple-600"><?php echo $stats['zones_differentes']; ?></p>
                    <p class="text-sm text-gray-600">Zones</p>
                </div>
                <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-amber-600"><?php echo $stats['total_animaux']; ?></p>
                    <p class="text-sm text-gray-600">Animaux</p>
                </div>
            </div>
        </div>
        
        <!-- Informations -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-info-circle text-green-600 mr-3"></i>
                Conseils pour les habitats
            </h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-4">
                        <i class="fas fa-lightbulb text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 mb-1">Cohérence écologique</p>
                        <p class="text-sm text-gray-600">Assurez-vous que le climat correspond à la zone géographique.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-4">
                        <i class="fas fa-exclamation-triangle text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 mb-1">Attention aux suppressions</p>
                        <p class="text-sm text-gray-600">Supprimer un habitat affectera tous les animaux qui y sont associés.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-amber-100 p-2 rounded-lg mr-4">
                        <i class="fas fa-link text-amber-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800 mb-1">Association des animaux</p>
                        <p class="text-sm text-gray-600">Vous pouvez associer des animaux à un habitat depuis la gestion des animaux.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fonction pour éditer un habitat
function editHabitat(id, nom, climat, description, zone) {
    // Mettre à jour le formulaire
    document.getElementById('habitat-id').value = id;
    document.getElementById('habitat-nom').value = nom;
    document.getElementById('habitat-climat').value = climat;
    document.getElementById('habitat-description').value = description;
    document.getElementById('habitat-zone').value = zone;
    
    // Mettre à jour les textes
    document.getElementById('form-title').textContent = 'Modifier l\'habitat';
    document.getElementById('form-subtitle').textContent = 'Modifiez les informations de l\'habitat';
    document.getElementById('submit-text').textContent = 'Mettre à jour';


    document.getElementById('action').name = 'modifierHabitat';
    document.getElementById('action').value = id

    // Afficher le bouton annuler
    document.getElementById('cancel-edit').classList.remove('hidden');
    
    // Scroll vers le formulaire
    document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
}

// Annuler l'édition
document.getElementById('cancel-edit').addEventListener('click', function() {
    resetForm();
});

// Réinitialiser le formulaire
function resetForm() {
    document.getElementById('habitat-id').value = '';
    document.querySelector('form').reset();
    
    // Réinitialiser les textes
    document.getElementById('form-title').textContent = 'Créer un nouvel habitat';
    document.getElementById('form-subtitle').textContent = 'Définissez un environnement pour les animaux';
    document.getElementById('submit-text').textContent = 'Créer l\'habitat';
    
    // Cacher le bouton annuler
    document.getElementById('cancel-edit').classList.add('hidden');
}

// Animation pour les lignes du tableau
document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f9fafb';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // Animation d'entrée des cartes
    const cards = document.querySelectorAll('.bg-gradient-to-r, .bg-white');
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

