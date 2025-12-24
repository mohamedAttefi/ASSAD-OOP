<?php
include '../includes/header.php';
include '../includes/db.php';

// Vérifier si l'utilisateur est connecté

$user_id= 1;
// Traitement du formulaire

?>

<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-4">Partagez votre expérience</h1>
                <p class="text-xl">Votre avis nous aide à améliorer nos visites guidées</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-green-700/50 p-4 rounded-xl">
                    <p class="text-sm">Connecté en tant que</p>
                    <p class="font-bold text-lg"></p>
                    <p class="text-sm text-green-200"></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenu principal -->
<div class="max-w-7xl mx-auto px-4 mb-10">
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Formulaire d'ajout de commentaire -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center mb-8">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <span class="text-green-600 text-2xl">💬</span>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Ajouter un commentaire</h2>
                        <p class="text-gray-600">Donnez votre avis sur une visite</p>
                    </div>
                </div>
                
                <!-- Messages d'erreur/succès -->
                
                
               
                
                <form method="post" class="space-y-6">
                    <!-- Sélection de la visite -->
                    <div>
                        <label for="idvisite" class="block text-sm font-medium text-gray-700 mb-2">
                            Visite à commenter *
                        </label>
                        <select id="idvisite" 
                                name="idvisite" 
                                class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                required>
                            <option value="">Sélectionnez une visite</option>
                            
                        </select>
                        
                    </div>
                    
                    <!-- Note -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Note *
                        </label>
                        <div class="flex items-center mb-2">
                            <div class="flex" id="note-stars">
                               
                            </div>
                            <span id="note-text" class="ml-4 text-lg font-semibold text-gray-700">
                            </span>
                        </div>
                        <input type="hidden" 
                               id="note" 
                               name="note" 
                               value=""
                               required>
                       
                    </div>
                    
                    <!-- Commentaire -->
                    <div>
                        <label for="texte" class="block text-sm font-medium text-gray-700 mb-2">
                            Votre commentaire *
                        </label>
                        <textarea id="texte" 
                                  name="texte" 
                                  rows="6" 
                                  placeholder="Partagez votre expérience : qu'avez-vous aimé ? Qu'est-ce qui pourrait être amélioré ?"
                                  class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                  maxlength="1000"
                                  required></textarea>
                        <div class="flex justify-between mt-1">
                            
                            <p id="char-count" class="text-sm text-gray-500">0/1000</p>
                        </div>
                    </div>
                    
                    <!-- Bouton d'envoi -->
                    <div>
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Publier mon commentaire
                            </span>
                        </button>
                    </div>
                    
                    <!-- Note sur la modération -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">
                            <span class="font-medium">Note :</span> 
                            Tous les commentaires sont modérés avant publication. Les commentaires inappropriés ou hors sujet seront supprimés.
                        </p>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Informations et guide -->
        <div class="space-y-6">
            <!-- Guide d'évaluation -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                <div class="flex items-center mb-6">
                    <div class="bg-green-600 p-3 rounded-full mr-4">
                        <span class="text-white text-2xl">⭐</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Guide d'évaluation</h3>
                        <p class="text-gray-600">Comment attribuer une note ?</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-yellow-400 text-lg">★★★★★</span>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Exceptionnelle</p>
                            <p class="text-sm text-gray-600">Visite parfaite, guide excellent, expérience inoubliable</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-yellow-400 text-lg">★★★★☆</span>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Très bonne</p>
                            <p class="text-sm text-gray-600">Excellente visite, quelques petits points à améliorer</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-yellow-400 text-lg">★★★☆☆</span>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Moyenne</p>
                            <p class="text-sm text-gray-600">Visite correcte, mais peut être améliorée</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-yellow-400 text-lg">★★☆☆☆</span>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Passable</p>
                            <p class="text-sm text-gray-600">Décevante, plusieurs points négatifs</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-yellow-400 text-lg">★☆☆☆☆</span>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Médiocre</p>
                            <p class="text-sm text-gray-600">Visite très décevante, à déconseiller</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mes commentaires récents -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Mes commentaires récents</h3>
                
                <?php
                $recent_comments_sql = "SELECT c.*, v.titre as visite_nom, v.dateheure 
                                       FROM commentaires c 
                                       JOIN visitesguidees v ON c.idvisitesguidees = v.id 
                                       WHERE c.idutilisateur = ?
                                       ORDER BY c.date_commentaire DESC 
                                       LIMIT 3";
                $stmt_recent = $conn->prepare($recent_comments_sql);
                $stmt_recent->execute([$user_id]);
                $recent_result = $stmt_recent->fetchall();
                
                if (count($recent_result) > 0): ?>
                    <div class="space-y-4">
                        <?php foreach ($recent_result as $comment){ 
                            $date_formatted = date('d/m/Y', strtotime($comment['date_commentaire']));
                            $visite_date = date('d/m/Y', strtotime($comment['dateheure']));
                        ?>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium text-gray-800"><?php echo htmlspecialchars($comment['visite_nom']); ?></p>
                                        <p class="text-xs text-gray-500">Visite du <?php echo $visite_date; ?></p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-yellow-400 text-sm"><?php echo str_repeat('★', $comment['note']); ?></span>
                                        <span class="text-gray-400 text-sm ml-1"><?php echo str_repeat('☆', 5 - $comment['note']); ?></span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2"><?php echo htmlspecialchars($comment['texte']); ?></p>
                                <p class="text-xs text-gray-400 mt-2">Posté le <?php echo $date_formatted; ?></p>
                            </div>
                        <?php }; ?>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="mes-commentaires.php" class="text-green-600 hover:text-green-800 text-sm font-medium">
                            Voir tous mes commentaires →
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <div class="text-gray-400 text-4xl mb-3">💬</div>
                        <p class="text-gray-600">Vous n'avez pas encore posté de commentaire.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Statistiques -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Vos statistiques</h3>
                
                <?php
                // Compter les commentaires de l'utilisateur
                $stats_sql = "SELECT 
                    COUNT(*) as total_comments,
                    AVG(note) as avg_note
                    FROM commentaires 
                    WHERE idutilisateur = ?";
                $stmt_stats = $conn->prepare($stats_sql);
                $stmt_stats->execute([$user_id]);
                $stats = $stmt_stats->fetch();
                ?>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-green-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-green-700"><?php echo $stats['total_comments'] ?? 0; ?></p>
                        <p class="text-sm text-green-600">Commentaires</p>
                    </div>
                    
                    <div class="bg-yellow-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-yellow-700">
                            <?php echo number_format($stats['avg_note'] ?? 0, 1); ?>
                        </p>
                        <p class="text-sm text-yellow-600">Note moyenne</p>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        Votre participation aide les autres visiteurs à choisir leurs visites.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Gestion des étoiles de notation
function setNote(value) {
    document.getElementById('note').value = value;
    document.getElementById('note-text').textContent = value + "/5";
    
    // Mettre à jour l'affichage des étoiles
    const stars = document.querySelectorAll('.note-star');
    stars.forEach((star, index) => {
        if (index < value) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

// Compteur de caractères
const textarea = document.getElementById('texte');
const charCount = document.getElementById('char-count');

if (textarea && charCount) {
    textarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length + "/1000";
        
        if (length > 1000) {
            charCount.classList.add('text-red-600');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.remove('text-red-600');
            charCount.classList.add('text-gray-500');
        }
    });
    
    // Initialiser le compteur
    charCount.textContent = textarea.value.length + "/1000";
}

// Prévisualisation au survol des étoiles
const stars = document.querySelectorAll('.note-star');
stars.forEach(star => {
    star.addEventListener('mouseenter', function() {
        const value = parseInt(this.getAttribute('data-value'));
        stars.forEach((s, index) => {
            if (index < value) {
                s.classList.add('text-yellow-300');
            }
        });
    });
    
    star.addEventListener('mouseleave', function() {
        const currentNote = parseInt(document.getElementById('note').value || 0);
        stars.forEach((s, index) => {
            s.classList.remove('text-yellow-300');
            if (index >= currentNote) {
                s.classList.add('text-gray-300');
            }
        });
    });
});

// Focus sur le premier champ
document.addEventListener('DOMContentLoaded', function() {
    const selectVisite = document.getElementById('idvisite');
    if (selectVisite) {
        selectVisite.focus();
    }
});
</script>

