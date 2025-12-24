<?php
session_start();
print_r($_SESSION);

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'];
$role = $_SESSION['role'];
echo $_SESSION['statut'];

if ($role === 'guide' && $_SESSION['statut'] == "approuvee") {
    header('Location: dashboardGuide.php');
    exit();
}

if ($role !== 'guide') {
    header('Location: dashboard.php');
    exit();
}
include 'includes/header.php'; 

?>

<section class="py-8 bg-gradient-to-r from-gray-700 to-gray-800 text-white rounded-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                    <i class="fas fa-user-clock mr-2"></i>
                    <span class="font-medium">Guide en attente de validation</span>
                </div>
                <h1 class="text-4xl font-bold mb-2">Bienvenue, <?php echo htmlspecialchars($user_nom); ?> !</h1>
                <p class="text-xl text-gray-200">Votre compte est en cours de vérification par notre équipe</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                    <p class="text-sm text-gray-200">Statut du compte</p>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2 animate-pulse"></div>
                        <p class="font-bold text-lg">En attente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 mb-10">
    <!-- Section d'information principale -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border-l-4 border-yellow-500">
        <div class="flex items-start mb-6">
            <div class="bg-yellow-100 p-4 rounded-full mr-6">
                <i class="fas fa-hourglass-half text-yellow-600 text-2xl"></i>
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Validation en cours</h2>
                <p class="text-gray-600 mb-4">Votre profil de guide professionnel est actuellement examiné par notre équipe d'administration. Cette procédure nous permet de garantir la qualité de nos services.</p>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Prochaines étapes
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                            <span>Inscription terminée ✓</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-user-check text-yellow-500 mt-1 mr-2"></i>
                            <span>Vérification des informations en cours</span>
                        </li>
                        <li class="flex items-start">
                            <i class="far fa-clock text-gray-400 mt-1 mr-2"></i>
                            <span>Validation par l'administrateur</span>
                        </li>
                        <li class="flex items-start">
                            <i class="far fa-envelope text-gray-400 mt-1 mr-2"></i>
                            <span>Notification par email</span>
                        </li>
                    </ul>
                </div>
                
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-history mr-2"></i>
                    <span>Délai moyen de traitement : 24 à 48 heures</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Colonne gauche - Que faire en attendant -->
        <div class="lg:col-span-2">
            <!-- Préparation -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-tasks text-blue-600 mr-3"></i>
                    Préparez-vous pendant l'attente
                </h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 p-3 rounded-full mr-4">
                                <i class="fas fa-user-edit text-blue-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">Complétez votre profil</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Ajoutez des informations détaillées sur vos compétences et expériences pour faciliter la validation.</p>
                        <a href="completer-profil.php" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Compléter mon profil
                        </a>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 p-3 rounded-full mr-4">
                                <i class="fas fa-book-open text-green-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">Explorez les ressources</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Familiarisez-vous avec nos guides, procédures et ressources pédagogiques.</p>
                        <a href="ressources-pedagogiques.php" class="inline-flex items-center text-green-600 font-medium hover:text-green-800">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Voir les ressources
                        </a>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-100 p-3 rounded-full mr-4">
                                <i class="fas fa-video text-purple-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">Visionnez les démos</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Regardez des démonstrations de visites pour comprendre notre format et nos standards.</p>
                        <a href="demonstrations.php" class="inline-flex items-center text-purple-600 font-medium hover:text-purple-800">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Voir les démos
                        </a>
                    </div>
                    
                    <div class="bg-gradient-to-r from-amber-50 to-amber-100 rounded-xl p-6 border border-amber-200">
                        <div class="flex items-center mb-4">
                            <div class="bg-amber-100 p-3 rounded-full mr-4">
                                <i class="fas fa-file-contract text-amber-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">Lisez le guide</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Consultez notre guide du guide pour connaître toutes nos procédures et bonnes pratiques.</p>
                        <a href="guide-du-guide.php" class="inline-flex items-center text-amber-600 font-medium hover:text-amber-800">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lire le guide
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- FAQ -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-question-circle text-blue-600 mr-3"></i>
                    Questions fréquentes
                </h2>
                
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(1)">
                            <span class="font-medium text-gray-800">Combien de temps prend la validation ?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform" id="faq-icon-1"></i>
                        </button>
                        <div id="faq-content-1" class="mt-3 text-gray-600 hidden">
                            <p>Le délai de validation varie entre 24 et 48 heures. Notre équipe examine chaque dossier avec attention pour garantir la qualité de notre réseau de guides. Vous recevrez une notification par email dès que votre compte sera approuvé.</p>
                        </div>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(2)">
                            <span class="font-medium text-gray-800">Puis-je commencer à créer des visites ?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform" id="faq-icon-2"></i>
                        </button>
                        <div id="faq-content-2" class="mt-3 text-gray-600 hidden">
                            <p>Vous pouvez préparer vos visites en mode brouillon, mais vous ne pourrez les publier ou les programmer qu'après validation de votre compte. Profitez de ce temps pour perfectionner vos contenus.</p>
                        </div>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(3)">
                            <span class="font-medium text-gray-800">Que vérifie l'administrateur ?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform" id="faq-icon-3"></i>
                        </button>
                        <div id="faq-content-3" class="mt-3 text-gray-600 hidden">
                            <p>Nous vérifions : vos informations de profil, vos qualifications, votre expérience, la qualité de votre présentation, et nous nous assurons que vous comprenez bien notre plateforme et ses standards de qualité.</p>
                        </div>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                        <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ(4)">
                            <span class="font-medium text-gray-800">Que faire si ma validation prend plus de temps ?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform" id="faq-icon-4"></i>
                        </button>
                        <div id="faq-content-4" class="mt-3 text-gray-600 hidden">
                            <p>Si votre validation prend plus de 48 heures, vous pouvez contacter notre support à l'adresse <a href="mailto:support@zoo-virtuel.com" class="text-blue-600 hover:underline">support@zoo-virtuel.com</a>. Pensez à vérifier vos spams au cas où notre email serait filtré.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne droite - Contacts et actions -->
        <div class="space-y-8">
            <!-- Contact support -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-headset text-blue-600 mr-3"></i>
                    Support & Contact
                </h2>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-envelope text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-800">Email de support</p>
                            <a href="mailto:support@zoo-virtuel.com" class="text-blue-600 hover:underline text-sm">support@zoo-virtuel.com</a>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-phone text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-800">Téléphone</p>
                            <p class="text-gray-600 text-sm">+212 5 XX XX XX XX</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-clock text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-800">Horaires de support</p>
                            <p class="text-gray-600 text-sm">Lun-Ven : 9h-18h</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-blue-200">
                    <a href="contact-support.php" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-medium transition">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Contacter le support
                    </a>
                </div>
            </div>
            
            <!-- Progression -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Progression de votre dossier</h2>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium text-gray-700">Informations de base</span>
                            <span class="font-bold text-green-600">100%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium text-gray-700">Qualifications</span>
                            <span class="font-bold text-blue-600"><?php echo isset($_SESSION['qualifications_complete']) && $_SESSION['qualifications_complete'] ? '100%' : '75%'; ?></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: <?php echo isset($_SESSION['qualifications_complete']) && $_SESSION['qualifications_complete'] ? '100' : '75'; ?>%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium text-gray-700">Validation admin</span>
                            <span class="font-bold text-yellow-600">En cours</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full animate-pulse" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i>
                        <span>Dernière mise à jour : il y a 12 heures</span>
                    </div>
                </div>
            </div>
            
            <!-- Aperçu du dashboard -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-300">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-eye text-gray-600 mr-3"></i>
                    Aperçu de votre futur dashboard
                </h2>
                
                <div class="space-y-4">
                    <div class="flex items-center bg-white p-3 rounded-lg shadow-sm">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-calendar-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Gestion des visites</p>
                            <p class="text-sm text-gray-500">Planifiez et gérez vos visites virtuelles</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white p-3 rounded-lg shadow-sm">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Interactions</p>
                            <p class="text-sm text-gray-500">Communiquez avec les participants</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white p-3 rounded-lg shadow-sm">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Statistiques</p>
                            <p class="text-sm text-gray-500">Suivez vos performances et revenus</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-300">
                    <p class="text-sm text-gray-600 italic">"Dès validation, vous aurez accès à tous ces outils et bien plus encore!"</p>
                </div>
            </div>
            
            <!-- Rafraîchir le statut -->
            <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Vérifier le statut</h2>
                <p class="text-gray-600 mb-4 text-sm">Cliquez ci-dessous pour vérifier si votre compte a été validé.</p>
                <button onclick="checkApprovalStatus()" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-medium transition flex items-center justify-center">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Vérifier maintenant
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Fonction pour toggler les FAQ
function toggleFAQ(id) {
    const content = document.getElementById('faq-content-' + id);
    const icon = document.getElementById('faq-icon-' + id);
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}

// Vérification du statut d'approbation
function checkApprovalStatus() {
    const button = event.currentTarget;
    const originalText = button.innerHTML;
    
    // Afficher un indicateur de chargement
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Vérification en cours...';
    button.disabled = true;
    
    // Simuler une requête AJAX
    setTimeout(() => {
        // En réalité, ici vous feriez une requête AJAX vers le serveur
        // pour vérifier le statut d'approbation
        fetch('check-approval.php')
            .then(response => response.json())
            .then(data => {
                if (data.approved) {
                    // Rediriger vers le dashboard si approuvé
                    window.location.href = 'dashboard-guide.php';
                } else {
                    // Afficher un message si toujours en attente
                    alert('Votre compte est toujours en attente de validation. Nous vous enverrons un email dès qu\'il sera approuvé.');
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la vérification. Veuillez réessayer.');
                button.innerHTML = originalText;
                button.disabled = false;
            });
    }, 1500);
}

// Animation d'entrée
document.addEventListener('DOMContentLoaded', function() {
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
    
    // Initialiser les FAQ
    document.querySelectorAll('[id^="faq-content-"]').forEach(content => {
        content.classList.add('hidden');
    });
});
</script>

