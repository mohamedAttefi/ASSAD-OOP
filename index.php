<?php 
include 'includes/header.php'; 
include 'includes/db.php';


$sql = 'select * from animaux limit 4';
$result = mysqli_query($conn, $sql); 
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

print_r($data);


?>

<!-- Hero Section avec effet parallaxe -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
    <!-- Background avec effet parallaxe -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-900/90 via-amber-800/80 to-yellow-900/90"></div>
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1546182990-dffeafbe841d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center bg-no-repeat opacity-20"></div>
        <!-- Effet particules -->
        <div class="absolute inset-0">
            <div class="absolute w-64 h-64 bg-amber-500/10 rounded-full -top-32 -left-32 blur-3xl"></div>
            <div class="absolute w-96 h-96 bg-yellow-500/10 rounded-full -bottom-48 -right-48 blur-3xl"></div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-12 animate-fade-in-down">
            <div class="inline-block mb-6">
                <div class="flex items-center justify-center w-24 h-24 bg-white/10 backdrop-blur-sm rounded-full mx-auto mb-4">
                    <i class="fas fa-paw text-white text-4xl"></i>
                </div>
                <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white/90 text-sm font-medium tracking-wider">
                    ZOO VIRTUEL
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Bienvenue au <span class="text-amber-300">Zoo ASSAD</span>
            </h1>
            <p class="text-xl md:text-2xl text-amber-100 max-w-3xl mx-auto mb-8 leading-relaxed">
                Découvrez <span class="font-bold text-amber-300">Asaad</span>, le majestueux Lion des Atlas, 
                et plongez dans un voyage virtuel au cœur de la faune africaine
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
                <a href="#decouverte" class="group bg-white text-amber-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-amber-50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-lg flex items-center justify-center">
                    <span class="mr-3">🦁</span>
                    Rencontrer Asaad
                    <i class="fas fa-arrow-down ml-3 group-hover:translate-y-1 transition-transform"></i>
                </a>
                <a href="animaux.php" class="group border-2 border-white/50 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all duration-300 backdrop-blur-sm flex items-center justify-center">
                    <span class="mr-3">🐘</span>
                    Explorer les animaux
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Statistiques flottantes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-300">
                <div class="text-4xl font-bold text-amber-300 mb-2">50+</div>
                <div class="text-white font-medium">Espèces animales</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-300">
                <div class="text-4xl font-bold text-amber-300 mb-2">24/7</div>
                <div class="text-white font-medium">Visite virtuelle</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-300">
                <div class="text-4xl font-bold text-amber-300 mb-2">100%</div>
                <div class="text-white font-medium">Immersion digitale</div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#decouverte" class="text-white/70 hover:text-white transition">
            <i class="fas fa-chevron-down text-3xl"></i>
        </a>
    </div>
</section>

<!-- Section Découverte d'Asaad -->
<section id="decouverte" class="py-20 bg-gradient-to-b from-white to-amber-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Carte d'Asaad -->
            <div class="relative group">
                <div class="absolute -inset-4 bg-gradient-to-r from-amber-500 to-yellow-500 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition-transform duration-500">
                    <div class="relative h-96 overflow-hidden">
                        <img src="https://i.pinimg.com/1200x/ac/42/1c/ac421cca69b8cff7eafc983b26c279e2.jpg" 
                             alt="Asaad - Lion des Atlas" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-crown text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Asaad</h3>
                                    <p class="text-amber-200">Lion des Atlas • Mâle • 8 ans</p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-6 right-6">
                            <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-medium">
                                Star du zoo
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Le roi des montagnes</h3>
                            <div class="flex space-x-2">
                                <button class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 hover:bg-amber-200 transition">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 hover:bg-amber-200 transition">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Dernier représentant de la lignée royale des lions de l'Atlas, Asaad incarne la noblesse et la puissance d'une espèce aujourd'hui disparue à l'état sauvage.
                        </p>
                        <a href="animal.php?id=1" class="inline-flex items-center text-amber-600 font-bold hover:text-amber-800 transition">
                            <span>Voir la fiche complète</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informations -->
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-amber-100 rounded-full mb-6">
                    <i class="fas fa-star text-amber-600 mr-2"></i>
                    <span class="font-medium text-amber-800">Animal vedette</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Le Lion des Atlas<br>
                    <span class="text-amber-600">Une légende vivante</span>
                </h2>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Originaire des montagnes de l'Atlas au Maroc, cette sous-espèce de lion était réputée pour sa crinière sombre et imposante, symbolisant la force et la majesté de la faune nord-africaine.
                </p>
                
                <!-- Caractéristiques rapides -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-ruler text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Taille</p>
                                <p class="font-bold text-gray-800">3,1 mètres</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-weight text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Poids</p>
                                <p class="font-bold text-gray-800">250 kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Origine</p>
                                <p class="font-bold text-gray-800">Maroc</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-amber-100">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-shield-alt text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Statut</p>
                                <p class="font-bold text-gray-800">Éteint à l'état sauvage</p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#conservation" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-yellow-600 text-white px-6 py-3 rounded-lg font-bold hover:from-amber-700 hover:to-yellow-700 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-shield-heart mr-3"></i>
                    Soutenir la conservation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section Animaux en vedette -->
<section class="py-20 bg-gradient-to-b from-amber-50 to-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Découvrez notre <span class="text-amber-600">ménagerie</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Rencontrez les autres résidents exceptionnels de notre zoo virtuel
            </p>
        </div>

        <!-- Grille d'animaux -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Animal 1 -->
             <?php foreach($data as $value){ ?>
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="relative h-56 overflow-hidden">
                    <img src="<?= $value['image'] ?>" 
                         alt="<?= $value['nom'] ?>" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm">
                            <?= $value['alimentation'] ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2"><?= $value['nom'] ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?= $value['espece'] ?> • <?= $value['paysorigine'] ?></p>
                    <a href="#" class="inline-flex items-center text-amber-600 font-medium hover:text-amber-800">
                        Rencontrer <?= $value['nom'] ?>
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
            <?php } ?>

            

        <div class="text-center">
            <a href="animaux.php" class="inline-flex items-center bg-gradient-to-r from-gray-900 to-gray-800 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-gray-800 hover:to-gray-700 transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                <i class="fas fa-paw mr-3"></i>
                Voir tous les animaux
                <i class="fas fa-arrow-right ml-3"></i>
            </a>
        </div>
    </div>
</section>

<!-- Section Conservation -->
<section id="conservation" class="relative py-20 overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-green-900 via-emerald-900 to-green-800"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full mb-6">
                <i class="fas fa-hands-helping text-white mr-3"></i>
                <span class="text-white font-medium">Engagement pour la conservation</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Protéger notre <span class="text-emerald-300">patrimoine naturel</span>
            </h2>
            <p class="text-xl text-emerald-100 max-w-3xl mx-auto">
                Nous nous engageons à préserver les espèces menacées et à sensibiliser le public à la biodiversité africaine
            </p>
        </div>

        <!-- Cartes de mission -->
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="group bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-dna text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Programme génétique</h3>
                <p class="text-emerald-100 mb-6">
                    Préservation de l'ADN des espèces menacées et participation à des programmes internationaux de reproduction.
                </p>
                <a href="#" class="inline-flex items-center text-emerald-300 font-medium hover:text-emerald-200">
                    En savoir plus
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="group bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Éducation virtuelle</h3>
                <p class="text-emerald-100 mb-6">
                    Ateliers pédagogiques et visites guidées pour sensibiliser toutes les générations à la protection animale.
                </p>
                <a href="#" class="inline-flex items-center text-emerald-300 font-medium hover:text-emerald-200">
                    Découvrir nos programmes
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="group bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-2">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Partenariats internationaux</h3>
                <p class="text-emerald-100 mb-6">
                    Collaboration avec des organisations de conservation en Afrique pour protéger les habitats naturels.
                </p>
                <a href="#" class="inline-flex items-center text-emerald-300 font-medium hover:text-emerald-200">
                    Voir nos partenaires
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- CTA Conservation -->
        <div class="text-center">
            <div class="inline-block bg-gradient-to-r from-emerald-500 to-green-600 rounded-2xl p-1 shadow-2xl">
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-white mb-4">Soutenez notre mission</h3>
                    <p class="text-gray-300 mb-6 max-w-2xl mx-auto">
                        Votre contribution permet de financer nos programmes de conservation, 
                        de recherche et d'éducation pour les générations futures.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-8 py-3 rounded-lg font-bold hover:from-emerald-600 hover:to-green-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-donate mr-2"></i>
                            Faire un don
                        </button>
                        <button class="border-2 border-emerald-500 text-emerald-500 px-8 py-3 rounded-lg font-bold hover:bg-emerald-500 hover:text-white transition-all duration-300">
                            <i class="fas fa-user-friends mr-2"></i>
                            Devenir bénévole
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Newsletter -->
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-gradient-to-br from-amber-50 to-yellow-50 rounded-3xl p-8 md:p-12 shadow-xl border border-amber-200">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope-open-text text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-4">
                    Restez connecté avec <span class="text-amber-600">Asaad</span>
                </h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Recevez des nouvelles exclusives, des photos et des vidéos de nos animaux directement dans votre boîte mail.
                </p>
            </div>
            
            <form class="max-w-xl mx-auto">
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" 
                           placeholder="Votre adresse email" 
                           class="flex-1 px-6 py-3 rounded-xl border border-amber-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 outline-none transition"
                           required>
                    <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 text-white px-8 py-3 rounded-xl font-bold hover:from-amber-700 hover:to-yellow-700 transition-all duration-300 transform hover:-translate-y-1">
                        S'inscrire
                    </button>
                </div>
                <p class="text-center text-sm text-gray-500 mt-4">
                    En vous inscrivant, vous acceptez notre 
                    <a href="#" class="text-amber-600 hover:text-amber-800 font-medium">politique de confidentialité</a>
                </p>
            </form>
        </div>
    </div>
</section>

<style>
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.8s ease-out;
}

.group:hover .group-hover\:translate-y-1 {
    transform: translateY(0.25rem);
}

.group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
}
</style>

<script>
// Animation au scroll
document.addEventListener('DOMContentLoaded', function() {
    // Observer pour les animations d'apparition
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-down');
            }
        });
    }, observerOptions);

    // Observer les sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Animation des cartes au hover
    const cards = document.querySelectorAll('.group');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
});
</script>