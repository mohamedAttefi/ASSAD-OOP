<?php
include '../includes/header.php';
include '../includes/db.php';

$result_stmt = $conn->prepare("
    SELECT a.*, h.nom as habitat_nom 
    FROM animaux a 
    LEFT JOIN habitats h ON a.id_habitat = h.id 
    ORDER BY a.nom ASC
");
$result_stmt->execute();
$result = $result_stmt->fetchall();

$habitats_stmt = $conn->prepare("SELECT id, nom FROM habitats ORDER BY nom");
$habitats_stmt->execute();
$habitats = $habitats_stmt->fetchall();


?>

<!-- Hero Section -->
<section class="py-6 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Gestion des Animaux</h1>
                <p class="text-green-100">Administrez la collection du zoo virtuel</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="bg-green-600 px-4 py-2 rounded-full text-sm font-medium">
                    <?php echo count($result) ?> animal(s) enregistré(s)
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
                <i class="fas fa-paw text-green-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    <span id="form-title">Ajouter un nouvel animal</span>
                </h2>
                <p class="text-gray-600">
                    <span id="form-subtitle">Remplissez les informations pour ajouter un animal au zoo</span>
                </p>
            </div>
        </div>

        <form method="post" action="animaux_CRUD/ajouterAnimal.php" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="hidden" name="id" id="animal-id">

            <!-- Colonne gauche -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de l'animal *
                    </label>
                    <input type="text"
                        name="nom"
                        id="animal-nom"
                        placeholder="Ex: Asaad (Lion des Atlas)"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Espèce *
                    </label>
                    <input type="text"
                        name="espece"
                        id="animal-espece"
                        placeholder="Ex: Panthera leo leo"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alimentation
                    </label>
                    <select name="alimentation"
                        id="animal-alimentation"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        <option value="">Sélectionner...</option>
                        <option value="Carnivore">Carnivore</option>
                        <option value="Herbivore">Herbivore</option>
                        <option value="Omnivore">Omnivore</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pays d'origine
                    </label>
                    <input type="text"
                        name="paysorigine"
                        id="animal-pays"
                        placeholder="Ex: Maroc"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Habitat
                    </label>
                    <select name="id_habitat"
                        id="animal-habitat"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        <option value="">Sélectionner un habitat...</option>
                        <?php foreach ($habitats as $habitats) { ?>
                            <option value="<?php echo $habitat['id']; ?>">
                                <?php echo ($habitat['nom']); ?>
                            </option>
                        <?php }; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description courte
                    </label>
                    <textarea name="descriptioncourte"
                        id="animal-description"
                        rows="3"
                        placeholder="Description de l'animal, comportements, particularités..."
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        URL Image
                    </label>
                    <input type="text"
                        name="image"
                        id="animal-image"
                        placeholder=""
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                </div>

                <!-- Bouton d'action -->
                <div class="pt-4">
                    <button type="submit" name="ajouterAnimal" id="action"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition transform hover:-translate-y-1 shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        <span id="submit-text">Ajouter l'animal</span>
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

    <!-- Liste des animaux -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Collection du zoo</h3>
                <span class="text-sm text-gray-600">
                    <?php echo count($result); ?> animal(s)
                </span>
            </div>
        </div>

        <?php if (count($result) == 0): ?>
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-paw"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun animal enregistré</h3>
                <p class="text-gray-600">Commencez par ajouter votre premier animal.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Animal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Informations
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Habitat
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($result as $row) {
                            $alim_icon = match ($row['alimentation']) {
                                'Carnivore' => 'fa-drumstick-bite',
                                'Herbivore' => 'fa-leaf',
                                'Omnivore' => 'fa-apple-alt',
                                default => 'fa-utensils'
                            };
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Animal -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <?php if (!empty($row['image'])): ?>
                                                <img src="<?php echo htmlspecialchars($row['image']); ?>"
                                                    alt="<?php echo htmlspecialchars($row['nom']); ?>"
                                                    class="w-12 h-12 rounded-lg object-cover">
                                            <?php else: ?>
                                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-paw text-white"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">
                                                <?php echo htmlspecialchars($row['nom']); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($row['espece']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Informations -->
                                <td class="px-6 py-4">
                                    <div class="space-y-2">
                                        <?php if (!empty($row['paysorigine'])): ?>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-globe-africa text-gray-400 mr-2 w-4"></i>
                                                <?php echo htmlspecialchars($row['paysorigine']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($row['alimentation'])): ?>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="fas <?php echo $alim_icon; ?> text-gray-400 mr-2 w-4"></i>
                                                <?php echo htmlspecialchars($row['alimentation']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!-- Habitat -->
                                <td class="px-6 py-4">
                                    <?php if (!empty($row['habitat_nom'])): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-mountain mr-2"></i>
                                            <?php echo htmlspecialchars($row['habitat_nom']); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-500">Non assigné</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <input type="hidden" value='<?= $row["id"] ?>'>
                                        <button onclick="editAnimal(<?php echo $row['id']; ?>, '<?php echo addslashes($row['nom']); ?>', '<?php echo addslashes($row['espece']); ?>', '<?php echo addslashes($row['alimentation']); ?>', '<?php echo addslashes($row['paysorigine']); ?>', '<?php echo addslashes($row['descriptioncourte']); ?>', '<?php echo $row['id_habitat']; ?>')"
                                            class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition"
                                            title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="animaux_CRUD/supprimerAnimal.php" method="post">
                                            <button name="supprimerAnimal" value="<?php echo $row['id']; ?>"
                                                class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')"
                                                title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <button class="text-green-600 hover:text-green-800 p-2 hover:bg-green-50 rounded-lg transition"
                                            title="Voir la fiche">
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
                        Affichage de 1 à <?php echo count($result) ?> animal(s)
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

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <?php
        // Statistiques rapides
        $stats_result_stmt = $conn->prepare("
            SELECT 
                COUNT(*) as total,
                COUNT(DISTINCT espece) as especes,
                COUNT(DISTINCT alimentation) as regimes
            FROM animaux
        ");
        $stats_result_stmt->execute();
        $stats = $stats_result_stmt->fetch();
        ?>

        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
            <div class="flex items-center">
                <div class="bg-green-600 p-3 rounded-full mr-4">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $stats['total']; ?></p>
                    <p class="text-sm text-gray-600">Animaux enregistrés</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
            <div class="flex items-center">
                <div class="bg-blue-600 p-3 rounded-full mr-4">
                    <i class="fas fa-dna text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $stats['especes']; ?></p>
                    <p class="text-sm text-gray-600">Espèces différentes</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-amber-50 to-amber-100 p-6 rounded-xl border border-amber-200">
            <div class="flex items-center">
                <div class="bg-amber-600 p-3 rounded-full mr-4">
                    <i class="fas fa-utensils text-white"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $stats['regimes']; ?></p>
                    <p class="text-sm text-gray-600">Régimes alimentaires</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('animal-image').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const imageName = document.getElementById('image-name');

        if (fileName) {
            imageName.textContent = 'Fichier sélectionné : ' + fileName;
            imageName.classList.remove('hidden');
        } else {
            imageName.classList.add('hidden');
        }
    });

    function editAnimal(id, nom, espece, alimentation, pays, description, habitat) {
        // Mettre à jour le formulaire
        document.getElementById('animal-id').value = id;
        document.getElementById('animal-nom').value = nom;
        document.getElementById('animal-espece').value = espece;
        document.getElementById('animal-alimentation').value = alimentation;
        document.getElementById('animal-pays').value = pays;
        document.getElementById('animal-description').value = description;
        document.getElementById('animal-habitat').value = habitat;

        document.getElementById('form-title').textContent = 'Modifier l\'animal';
        document.getElementById('form-subtitle').textContent = 'Modifiez les informations de l\'animal';
        document.getElementById('submit-text').textContent = 'Mettre à jour';
        document.getElementById('action').name = 'modifierAnimal'
        document.getElementById('action').value = id
        document.getElementById('cancel-edit').classList.remove('hidden');

        document.querySelector('form').scrollIntoView({
            behavior: 'smooth'
        });
    }

    document.getElementById('cancel-edit').addEventListener('click', function() {
        resetForm();
    });

    function resetForm() {
        document.getElementById('animal-id').value = '';
        document.querySelector('form').reset();
        document.getElementById('image-name').classList.add('hidden');

        // Réinitialiser les textes
        document.getElementById('form-title').textContent = 'Ajouter un nouvel animal';
        document.getElementById('form-subtitle').textContent = 'Remplissez les informations pour ajouter un animal au zoo';
        document.getElementById('submit-text').textContent = 'Ajouter l\'animal';

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
        const cards = document.querySelectorAll('.bg-gradient-to-r');
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