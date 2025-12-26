<?php
include 'includes/header.php';
include 'includes/db.php';
include 'includes/classes/animaux.php';
$animaux = new animaux("", "", "", "", "", "", "");

$data = $animaux->getAll($conn);

// print_r($_SESSION);



if (isset($_POST['fiche'])) {
    $id = (int) $_POST['fiche'];


    $animal = $animaux->getOne($conn, $id);
    print_r($animal);
}
$show_modal = isset($animal);
?>

<!-- Header de la page -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4 text-center">Notre Ménagerie</h1>
        <p class="text-xl text-center mb-6">Découvrez tous les résidents du Zoo Virtuel ASSAD</p>
        <div class="flex flex-col md:flex-row justify-center items-center gap-4">
            <div class="flex items-center">
                <div class="bg-green-600 p-3 rounded-full mr-3">
                    <span class="text-white text-xl">🦁</span>
                </div>
                <div>
                    <p class="font-bold">Plus de <?php echo count($data); ?> animaux</p>
                    <p class="text-sm text-green-200">À découvrir</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="bg-green-600 p-3 rounded-full mr-3">
                    <span class="text-white text-xl">🌍</span>
                </div>
                <div>
                    <p class="font-bold">Plusieurs continents</p>
                    <p class="text-sm text-green-200">Représentés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($show_modal): ?>
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white p-6 border-b flex justify-between items-center">
                <h2 class="text-3xl font-bold text-gray-800"><?php echo htmlspecialchars($animal['nom']); ?></h2>
                <form method="post" class="inline">
                    <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </form>
            </div>

            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <img src="<?php echo ($animal['image']); ?>"
                            alt="<?php echo ($animal['nom']); ?>"
                            class="rounded-xl w-full h-64 object-cover mb-4 shadow-lg">

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm text-green-600 font-semibold">Espèce</p>
                                <p class="text-lg font-bold"><?php echo ($animal['espece']); ?></p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm text-green-600 font-semibold">Habitat</p>
                                <p class="text-lg font-bold"><?php echo ($animal['habitat_nom'] ?? 'Non spécifié'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Informations détaillées</h3>

                        <div class="space-y-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Alimentation</p>
                                <p class="text-lg font-medium"><?php echo ($animal['alimentation']); ?></p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Pays d'origine</p>
                                <p class="text-lg font-medium"><?php echo ($animal['paysorigine']); ?></p>
                            </div>


                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">Description</p>
                            <p class="text-gray-700 leading-relaxed"><?php echo ($animal['descriptioncourte']); ?></p>
                        </div>
                    </div>
                </div>



                <div class="mt-8 flex justify-end">
                    <form method="post">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition">
                            Fermer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            window.location.href = 'animaux.php';
        }
    </script>
<?php endif; ?>

<!-- Contenu principal -->
<div class="max-w-7xl mx-auto px-4">
    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Filtrer les animaux</h2>

        <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Habitat</label>
                <select name="habitat" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Tous les habitats</option>

                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Espèce</label>
                <select name="espece" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Toutes les espèces</option>

                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alimentation</label>
                <select name="alimentation" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Tous les régimes</option>

                </select>
            </div>

            <div class="flex items-end">
                <div class="flex gap-2 w-full">
                    <button type="submit" class="flex-1 bg-green-700 hover:bg-green-800 text-white font-semibold px-6 py-3 rounded-lg transition transform hover:scale-105">
                        🔍 Appliquer les filtres
                    </button>
                    <a href="animaux.php" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-3 rounded-lg transition">
                        ✕
                    </a>
                </div>
            </div>
        </form>


    </div>

    <!-- Résultats -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Animaux
                <?php if (count($data) > 0): ?>
                    <span class="text-green-600">(<?php echo count($data); ?>)</span>
                <?php endif; ?>
            </h2>

            <?php if (count($data) > 0): ?>
                <div class="text-gray-600">
                    Triés par ordre alphabétique
                </div>
            <?php endif; ?>
        </div>

        <?php if (count($data) == 0): ?>

            <div class="text-center py-12 bg-white rounded-xl shadow">
                <div class="text-6xl mb-4">🦒</div>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Aucun animal trouvé</h3>
                <p class="text-gray-600 mb-6">Essayez de modifier vos critères de recherche</p>
                <a href="animaux.php" class="inline-block bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Afficher tous les animaux
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($data as $animal) { ?>
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                        <div class="relative overflow-hidden">
                            <img src="<?php echo htmlspecialchars($animal['image']); ?>"
                                alt="<?php echo htmlspecialchars($animal['nom']); ?>"
                                class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <?php echo htmlspecialchars($animal['habitat_nom'] ?? 'Général'); ?>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800"><?php echo ($animal['nom']); ?></h3>
                                <span class="text-gray-500 text-sm">
                                    <?php
                                    switch ($animal['alimentation']) {
                                        case 'Carnivore':
                                            echo '🥩';
                                            break;
                                        case 'Herbivore':
                                            echo '🌿';
                                            break;
                                        case 'Omnivore':
                                            echo '🍎';
                                            break;
                                        default:
                                            echo '🍽️';
                                    }
                                    ?>
                                </span>
                            </div>

                            <p class="text-gray-600 mb-1">
                                <span class="font-medium">Espèce:</span> <?php echo ($animal['espece']); ?>
                            </p>

                            <?php if ($animal['paysorigine']): ?>
                                <p class="text-gray-600 mb-4">
                                    <span class="font-medium">Origine:</span> <?php echo ($animal['paysorigine']); ?>
                                </p>
                            <?php endif; ?>

                            <div class="flex justify-between items-center mt-4">
                                <form method="post" class="w-full">
                                    <button name="fiche" value="<?php echo $animal['id']; ?>"
                                        class="w-full bg-green-100 hover:bg-green-200 text-green-800 font-semibold py-2.5 rounded-lg transition transform hover:scale-[1.02] flex items-center justify-center gap-2">
                                        <span>👁️</span> Voir la fiche complète
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Section informative -->
    <?php if (count($data) > 0): ?>
        <div class="mt-12 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl p-8 border border-green-200">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl mb-4">🛡️</div>
                    <h3 class="font-bold text-lg mb-2 text-gray-800">Protection des espèces</h3>
                    <p class="text-gray-600">Tous nos animaux bénéficient de soins adaptés à leurs besoins spécifiques.</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">📚</div>
                    <h3 class="font-bold text-lg mb-2 text-gray-800">Mission éducative</h3>
                    <p class="text-gray-600">Notre zoo virtuel vise à sensibiliser à la biodiversité et à la conservation.</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-4">❤️</div>
                    <h3 class="font-bold text-lg mb-2 text-gray-800">Bien-être animal</h3>
                    <p class="text-gray-600">Le confort et la santé de nos résidents sont notre priorité absolue.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>