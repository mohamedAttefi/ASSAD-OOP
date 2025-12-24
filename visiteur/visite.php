<?php
include '../includes/header.php';
include '../includes/db.php';

$visite_stmt = $conn->prepare("SELECT * FROM visitesguidees WHERE dateheure > NOW() ORDER BY dateheure ASC");
$visite_stmt->execute();
$visites = $visite_stmt->fetchAll();

foreach ($visites as $key => $visite) {
    $visites[$key]['date_formatted'] = date('d F Y', strtotime($visite['dateheure']));
    $visites[$key]['heure_formatted'] = date('H:i', strtotime($visite['dateheure']));
    $visites[$key]['date_complete'] = date('l d F Y à H:i', strtotime($visite['dateheure']));
    $visites[$key]['date_complete'] = str_replace(
        ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
        $visites[$key]['date_complete']
    );
}

if(empty($visites)){
    echo "<div class='max-w-6xl mx-auto px-4 py-16 text-center'>
            <div class='text-6xl mb-6 text-gray-400'>🔍</div>
            <h2 class='text-3xl font-bold text-gray-700 mb-4'>Aucune visite disponible</h2>
            <p class='text-gray-600 mb-8'>Il n'y a pas de visites programmées pour le moment.</p>
            <a href='../index.php' class='inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition'>
                Retour à l'accueil
            </a>
          </div>";
    exit;
}
?>

<!-- Hero Section -->
<section class="relative py-12 bg-gradient-to-br from-green-900 via-emerald-800 to-green-700 text-white overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-green-600 rounded-full -translate-y-32 translate-x-32 opacity-20"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-600 rounded-full translate-y-48 -translate-x-48 opacity-20"></div>
    
    <div class="relative max-w-6xl mx-auto px-4 z-10">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <span class="text-sm font-medium">Visites Guidées</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Découvrez nos visites guidées virtuelles</h1>
            <p class="text-xl text-green-100 mb-6">Explorez le Zoo Virtuel ASSAD avec nos guides experts. Choisissez la visite qui vous convient et réservez votre place !</p>
            
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl">
                    <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-green-200">Participants</p>
                        <p class="font-semibold">Jusqu'à 30 personnes</p>
                    </div>
                </div>
                
                <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl">
                    <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-green-200">Durée</p>
                        <p class="font-semibold">60-90 minutes</p>
                    </div>
                </div>
                
                <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl">
                    <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-green-200">Annulation</p>
                        <p class="font-semibold">Gratuite 24h avant</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filtres et recherche -->
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800"><?php echo count($visites); ?> visites disponibles</h2>
                <p class="text-gray-600">Choisissez une date et réservez votre place</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Rechercher une visite..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                
                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Trier par</option>
                    <option value="date">Date (croissant)</option>
                    <option value="date_desc">Date (décroissant)</option>
                    <option value="prix">Prix (croissant)</option>
                    <option value="prix_desc">Prix (décroissant)</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Grille des visites -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <?php foreach ($visites as $visite): ?>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
            <!-- Image/Header de la visite -->
            <div class="relative h-48 bg-gradient-to-r from-green-600 to-emerald-600">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-white text-4xl mb-2">🦁</div>
                        <h3 class="text-xl font-bold text-white"><?php echo htmlspecialchars($visite['titre']); ?></h3>
                    </div>
                </div>
                <!-- Badge de statut -->
                <div class="absolute top-4 left-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 backdrop-blur-sm text-white">
                        <?php echo htmlspecialchars($visite['langue']); ?>
                    </span>
                </div>
                <!-- Badge de places disponibles -->
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo $visite['capacite_max'] > 10 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                        <?php echo $visite['capacite_max']; ?> places
                    </span>
                </div>
            </div>
            
            <!-- Contenu -->
            <div class="p-6">
                <!-- Date et heure -->
                <div class="flex items-center text-gray-600 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-medium"><?php echo $visite['date_complete']; ?></span>
                </div>
                
                <!-- Durée -->
                <div class="flex items-center text-gray-600 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span><?php echo $visite['duree']; ?> minutes</span>
                </div>
                
                <!-- Description courte -->
                <?php if (!empty($visite['description'])): ?>
                <p class="text-gray-700 mb-4 text-sm line-clamp-2">
                    <?php echo htmlspecialchars(substr($visite['description'], 0, 100)); ?>...
                </p>
                <?php endif; ?>
                
                <!-- Prix et CTA -->
                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-sm text-gray-600">À partir de</p>
                        <p class="text-2xl font-bold text-gray-800"><?php echo number_format($visite['prix'], 2); ?> DH</p>
                        <p class="text-xs text-gray-500">par personne</p>
                    </div>
                    
                    <a href="reserver.php?id=<?php echo $visite['id']; ?>" 
                       class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition transform hover:-translate-y-1">
                        Réserver
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- FAQ -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Questions fréquentes</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-2">Comment fonctionnent les visites virtuelles ?</h3>
                    <p class="text-gray-600 text-sm">Nos visites se déroulent sur Zoom. Vous recevez un lien après réservation pour rejoindre la visite guidée.</p>
                </div>
                
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-2">Puis-je annuler ma réservation ?</h3>
                    <p class="text-gray-600 text-sm">Oui, vous pouvez annuler gratuitement jusqu'à 24 heures avant la visite. Contactez-nous pour plus d'informations.</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-2">Quel équipement est nécessaire ?</h3>
                    <p class="text-gray-600 text-sm">Un ordinateur, une tablette ou un smartphone avec connexion internet et l'application Zoom installée.</p>
                </div>
                
                <div class="bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-800 mb-2">Les visites sont-elles enregistrées ?</h3>
                    <p class="text-gray-600 text-sm">Certaines visites sont enregistrées. Vous recevrez un lien pour la rediffusion si disponible.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CTA -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl shadow-xl p-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Vous avez des questions ?</h2>
        <p class="text-green-100 mb-6 max-w-2xl mx-auto">Notre équipe est disponible pour vous aider à choisir la visite qui vous convient le mieux.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="../contact.php" 
               class="bg-white text-green-600 hover:bg-green-50 px-8 py-3 rounded-lg font-bold transition">
                Nous contacter
            </a>
            <a href="../faq.php" 
               class="bg-transparent border-2 border-white text-white hover:bg-white/10 px-8 py-3 rounded-lg font-bold transition">
                Voir la FAQ
            </a>
        </div>
    </div>
</div>

<script>
// Filtrage et recherche
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[type="text"]');
    const sortSelect = document.querySelector('select');
    const visiteCards = document.querySelectorAll('.grid > div');
    
    // Fonction de recherche
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        visiteCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p') ? card.querySelector('p').textContent.toLowerCase() : '';
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Animation au survol
    visiteCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Compteur de visites
    const visiteCount = <?php echo count($visites); ?>;
    const countElement = document.querySelector('h2.text-2xl');
    
    // Mise à jour dynamique du compteur
    searchInput.addEventListener('input', function() {
        const visibleCards = Array.from(visiteCards).filter(card => 
            card.style.display !== 'none'
        ).length;
        
        countElement.textContent = visibleCards + ' visites disponibles';
    });
});
</script>