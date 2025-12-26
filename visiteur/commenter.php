<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
include '../includes/classes/visiteur.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";
print_r($_SESSION);

$Visiteur = new visiteur($_SESSION['user_nom'],$_SESSION['email'], $_SESSION['motpasse_hash'], $_SESSION['motpasse_hash'], $_SESSION['motpasse_hash']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['idvisite']) &&
        !empty($_POST['note']) &&
        !empty($_POST['texte'])
    ) {
        $idvisite = (int) $_POST['idvisite'];
        $note = (int) $_POST['note'];
        $texte = trim($_POST['texte']);

    $message = $Visiteur->commenter($conn, $idvisite, $user_id, $note, $texte);    

    } else {
        $message = "❌ Tous les champs sont obligatoires.";
    }
}
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
                    <p class="font-bold text-lg"><?php echo htmlspecialchars($_SESSION['user_nom'] ?? 'Utilisateur'); ?></p>
                    <p class="text-sm text-green-200">Votre opinion compte !</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenu principal -->
<div class="max-w-7xl mx-auto px-4 mb-10">
    <?php if (!empty($message)): ?>
        <div class="mb-6 p-4 rounded-xl <?php echo str_contains($message, '✅') ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

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
                            <?php
                            $sqlVisites = "SELECT id, titre, dateheure FROM visitesguidees ORDER BY dateheure DESC";
                            $resultVisites = $conn->query($sqlVisites);

                            while ($visite = $resultVisites->fetch_assoc()):
                                $date_formatted = date('d/m/Y', strtotime($visite['dateheure']));
                            ?>
                                <option value="<?php echo $visite['id']; ?>">
                                    <?php echo htmlspecialchars($visite['titre']) . " (" . $date_formatted . ")"; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Note avec étoiles -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Note *
                        </label>
                        <div class="flex items-center mb-2">
                            <div class="flex space-x-1" id="note-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <button type="button"
                                        class="note-star text-3xl transition-all duration-200 hover:scale-125 <?php echo $i <= 3 ? 'text-yellow-400' : 'text-gray-300'; ?>"
                                        data-value="<?php echo $i; ?>"
                                        onclick="setNote(<?php echo $i; ?>)"
                                        onmouseover="hoverStar(<?php echo $i; ?>)"
                                        onmouseout="resetStars()">
                                        ★
                                    </button>
                                <?php endfor; ?>
                            </div>
                            <span id="note-text" class="ml-4 text-lg font-semibold text-gray-700">
                                3/5
                            </span>
                        </div>
                        <input type="hidden"
                            id="note"
                            name="note"
                            value="3"
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
                            <p id="char-count" class="text-sm text-gray-500">0/1000 caractères</p>
                            <p class="text-sm text-gray-500">Minimum 20 caractères</p>
                        </div>
                    </div>

                    <!-- Bouton d'envoi -->
                    <div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
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

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Mes commentaires récents</h3>

                <?php
                $recent_comments_sql = "SELECT c.*, v.titre, v.dateheure 
                                       FROM commentaires c 
                                       JOIN visitesguidees v ON c.idvisitesguidees = v.id 
                                       WHERE c.idutilisateur = ?
                                       ORDER BY c.date_commentaire DESC 
                                       LIMIT 3";
                $stmt_recent = $conn->prepare($recent_comments_sql);
                $stmt_recent->bind_param("i", $user_id);
                $stmt_recent->execute();
                $recent_result = $stmt_recent->get_result();

                if ($recent_result->num_rows > 0): ?>
                    <div class="space-y-4">
                        <?php while ($comment = $recent_result->fetch_assoc()):
                            $date_formatted = date('d/m/Y', strtotime($comment['date_commentaire']));
                            $visite_date = date('d/m/Y', strtotime($comment['dateheure']));
                        ?>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium text-gray-800"><?php echo htmlspecialchars($comment['titre']); ?></p>
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
                        <?php endwhile; ?>
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
                <?php $stmt_recent->close(); ?>
            </div>

            <!-- Statistiques -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Vos statistiques</h3>

                <?php
                $stats_sql = "SELECT 
                    COUNT(*) as total_comments,
                    AVG(note) as avg_note
                    FROM commentaires 
                    WHERE idutilisateur = ?";
                $stmt_stats = $conn->prepare($stats_sql);
                $stmt_stats->bind_param("i", $user_id);
                $stmt_stats->execute();
                $stats_result = $stmt_stats->get_result();
                $stats = $stats_result->fetch_assoc();
                $stmt_stats->close();
                ?>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-green-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-green-700"><?php echo $stats['total_comments']; ?></p>
                        <p class="text-sm text-green-600">Commentaires</p>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-yellow-700">
                            <?php echo ($stats['avg_note']); ?>
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
    // Variables globales
    let currentNote = 3;
    let hoveredNote = 0;

    // Définir la note
    function setNote(value) {
        currentNote = value;
        document.getElementById('note').value = value;
        document.getElementById('note-text').textContent = value + "/5";
        updateStars();
    }

    // Survol des étoiles
    function hoverStar(value) {
        hoveredNote = value;
        updateStars();
    }

    // Réinitialiser le survol
    function resetStars() {
        hoveredNote = 0;
        updateStars();
    }

    // Mettre à jour l'affichage des étoiles
    function updateStars() {
        const stars = document.querySelectorAll('.note-star');
        const displayNote = hoveredNote > 0 ? hoveredNote : currentNote;

        stars.forEach((star, index) => {
            const starValue = index + 1;
            if (starValue <= displayNote) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    // Compteur de caractères avec validation
    const textarea = document.getElementById('texte');
    const charCount = document.getElementById('char-count');
    const submitButton = document.querySelector('button[type="submit"]');

    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length + "/1000 caractères";

            // Validation
            const isValid = length >= 20 && length <= 1000;

            if (length > 1000) {
                charCount.classList.add('text-red-600');
                charCount.classList.remove('text-gray-500');
            } else if (length < 20) {
                charCount.classList.add('text-yellow-600');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.remove('text-red-600', 'text-yellow-600');
                charCount.classList.add('text-gray-500');
            }

            // Activer/désactiver le bouton
            if (submitButton) {
                submitButton.disabled = !isValid;
                submitButton.classList.toggle('opacity-50', !isValid);
                submitButton.classList.toggle('cursor-not-allowed', !isValid);
            }
        });

        charCount.textContent = textarea.value.length + "/1000 caractères";
    }

    // Validation du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        const visiteSelect = document.getElementById('idvisite');
        const noteInput = document.getElementById('note');
        const texteInput = document.getElementById('texte');

        let isValid = true;
        let errorMessage = "";

        // Validation de la visite
        if (!visiteSelect.value) {
            isValid = false;
            errorMessage += "Veuillez sélectionner une visite.\n";
            visiteSelect.classList.add('border-red-500');
        } else {
            visiteSelect.classList.remove('border-red-500');
        }

        // Validation de la note
        if (!noteInput.value || noteInput.value < 1 || noteInput.value > 5) {
            isValid = false;
            errorMessage += "Veuillez donner une note entre 1 et 5.\n";
        }

        // Validation du texte
        if (!texteInput.value.trim()) {
            isValid = false;
            errorMessage += "Veuillez écrire un commentaire.\n";
            texteInput.classList.add('border-red-500');
        } else if (texteInput.value.trim().length < 20) {
            isValid = false;
            errorMessage += "Le commentaire doit contenir au moins 20 caractères.\n";
            texteInput.classList.add('border-red-500');
        } else if (texteInput.value.trim().length > 1000) {
            isValid = false;
            errorMessage += "Le commentaire ne peut pas dépasser 1000 caractères.\n";
            texteInput.classList.add('border-red-500');
        } else {
            texteInput.classList.remove('border-red-500');
        }

        if (!isValid) {
            e.preventDefault();
            alert("Veuillez corriger les erreurs suivantes :\n\n" + errorMessage);
        }
    });

    // Focus sur le premier champ
    document.addEventListener('DOMContentLoaded', function() {
        const selectVisite = document.getElementById('idvisite');
        if (selectVisite) {
            selectVisite.focus();
        }

        // Initialiser les étoiles
        updateStars();
    });

    // Animation des étoiles
    document.querySelectorAll('.note-star').forEach(star => {
        star.addEventListener('click', function() {
            this.style.transform = 'scale(0.8)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });
</script>

