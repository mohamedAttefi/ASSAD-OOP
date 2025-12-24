<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Virtuel ASSAD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Header principal -->
    <header class="sticky top-0 z-50 bg-green-700 text-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/ASSAD/ASSAD/index.php" class="flex items-center space-x-3 hover:opacity-90 transition">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-paw text-green-700 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Zoo Virtuel ASSAD</h1>
                    </div>
                </a>

                <!-- Menu Desktop -->
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="/ASSAD/index.php" class="hover:text-green-200 transition font-medium">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="/ASSAD/ASSAD/animaux.php" class="hover:text-green-200 transition font-medium">
                        <i class="fas fa-paw mr-2"></i>Animaux
                    </a>


                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'visiteur'): ?>
                        <div class="relative group">
                            <button class="flex items-center space-x-2 hover:text-green-200">
                                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span><?php echo ($_SESSION['user_nom'] ?? 'Mon compte'); ?></span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>

                            <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg py-2 hidden group-hover:block">
                                <a href="/ASSAD/visiteur/visite.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Les visites
                                </a>
                                <a href="/ASSAD/visiteur/mes_reservations.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Mes Réservations
                                </a>
                                <a href="/ASSAD/visiteur/commenter.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Commentaires
                                </a>
                                <hr class="my-2">
                                <a href="/ASSAD/logout.php" class="block px-4 py-2 hover:bg-red-50 text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
                        <div class="relative group">
                            <button class="flex items-center space-x-2 hover:text-green-200">
                                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span><?php echo ($_SESSION['user_nom'] ?? 'Mon compte'); ?></span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>

                            <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg py-2 hidden group-hover:block">
                                <a href="/ASSAD/admin/dashboard.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-user-circle mr-2 text-green-600"></i>dashboard
                                </a>
                                <a href="/ASSAD/admin/gestion_animaux.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Gestion des animaux
                                </a>
                                <a href="/ASSAD/admin/gestion_habitats.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Gestion des habitats
                                </a>
                                <a href="/ASSAD/admin/gestion_utilisateurs.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Gestion des utilisateurs
                                </a>
                                <hr class="my-2">
                                <a href="/ASSAD/logout.php" class="block px-4 py-2 hover:bg-red-50 text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'guide'): ?> <div class="relative group">
                            <button class="flex items-center space-x-2 hover:text-green-200">
                                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span><?php echo ($_SESSION['user_nom'] ?? 'Mon compte'); ?></span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>

                            <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg py-2 hidden group-hover:block">
                                <a href="/ASSAD/guide/gestion_visites" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-user-circle mr-2 text-green-600"></i>Gestion des visites
                                </a>
                                <a href="/ASSAD/guide/reservations.php" class="block px-4 py-2 hover:bg-green-50">
                                    <i class="fas fa-calendar-check mr-2 text-green-600"></i>Réservations
                                </a>
                                <hr class="my-2">
                                <a href="/ASSAD/logout.php" class="block px-4 py-2 hover:bg-red-50 text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="flex items-center space-x-4">
                            <a href="/ASSAD/login.php" class="hover:text-green-200 transition font-medium">
                                <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                            </a>
                            <a href="/ASSAD/register.php" class="bg-white text-green-700 px-4 py-2 rounded-lg font-medium hover:bg-green-50 transition">
                                <i class="fas fa-user-plus mr-2"></i>Inscription
                            </a>
                        </div>
                    <?php endif; ?>
                </nav>

                <!-- Bouton menu mobile -->
                <button class="md:hidden text-2xl" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Menu Mobile -->
    <div class="md:hidden bg-white shadow-lg absolute top-16 left-0 right-0 z-40 hidden" id="mobileMenu">
        <div class="px-4 py-3 space-y-2">
            <a href="/index.php" class="block py-3 px-4 hover:bg-green-50 rounded-lg">
                <i class="fas fa-home mr-3 text-green-600"></i>Accueil
            </a>
            <a href="/animaux.php" class="block py-3 px-4 hover:bg-green-50 rounded-lg">
                <i class="fas fa-paw mr-3 text-green-600"></i>Animaux
            </a>
            <a href="visiteur/visites.php" class="block py-3 px-4 hover:bg-green-50 rounded-lg">
                <i class="fas fa-binoculars mr-3 text-green-600"></i>Visites Guidées
            </a>

            <hr class="my-2">

            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="px-4 py-2">
                    <p class="font-medium text-gray-700">Connecté en tant que</p>
                    <p class="text-green-600"><?php echo htmlspecialchars($_SESSION['user_nom'] ?? 'Utilisateur'); ?></p>
                </div>
                <a href="/profil.php" class="block py-3 px-4 hover:bg-green-50 rounded-lg">
                    <i class="fas fa-user-circle mr-3 text-green-600"></i>Mon Profil
                </a>
                <a href="visiteur/mes-reservations.php" class="block py-3 px-4 hover:bg-green-50 rounded-lg">
                    <i class="fas fa-calendar-check mr-3 text-green-600"></i>Mes Réservations
                </a>
                <a href="/logout.php" class="block py-3 px-4 hover:bg-red-50 rounded-lg text-red-600">
                    <i class="fas fa-sign-out-alt mr-3"></i>Déconnexion
                </a>
            <?php else: ?>
                <a href="/login.php" class="block py-3 px-4 bg-green-100 text-green-700 rounded-lg font-medium text-center">
                    <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                </a>
                <a href="/register.php" class="block py-3 px-4 bg-green-600 text-white rounded-lg font-medium text-center">
                    <i class="fas fa-user-plus mr-2"></i>Inscription
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-6">