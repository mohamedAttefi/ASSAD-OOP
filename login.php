<?php
include "includes/db.php";
require_once "includes/classes/utilisateur.php";
require_once "includes/classes/visiteur.php";
require_once "includes/classes/guide.php";
session_start();

$utilisateur = new utilisateur("", "", "", "");

if (isset($_POST['login'])) {
    echo "wesh";

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $user = $utilisateur->SeConnecter($email, $password, $conn);

    // print_r($user);



    if (!$user) {
        echo "something went wrong";
        return;
    }

    $_SESSION['user_id']  = $user->getId();
    $_SESSION['user_nom'] = $user->getNom();
    $_SESSION['role'] = $user->getRole();
    $_SESSION['statut'] = $user->getStatut();
    $_SESSION['motpasse'] = $user->getMotpasse();
    $_SESSION['email'] = $user->getEmail();

    print_r($_SESSION);




    if ($user->getRole() == "guide") {
        if ($user->getStatut() == "approuvee") {
            header("location: pendingGuide.php");
            exit;
        } else {
            header("location: dashboardGuide.php");
            exit;
        }
    } elseif ($user->getRole() == "visiteur") {
        header("location: dashboardVisiteur.php");
        exit;
    }

    include "includes/header.php";
}




?>
<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Connexion au Zoo Virtuel ASSAD</h1>
        <p class="text-xl">Accédez à votre espace personnel et découvrez des fonctionnalités exclusives</p>
    </div>
</section>

<!-- Contenu principal -->
<div class="max-w-7xl mx-auto px-4 mb-10">
    <div class="grid md:grid-cols-2 gap-10 items-start">
        <!-- Formulaire de connexion -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-8">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <span class="text-green-600 text-2xl">🔐</span>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Connectez-vous</h2>
                    <p class="text-gray-600">Accédez à votre compte</p>
                </div>
            </div>





            <form method="post" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email"
                            id="email"
                            name="email"
                            value=""
                            placeholder="votre@email.com"
                            class="pl-10 w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required
                            autocomplete="email">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password"
                            id="password"
                            name="password"
                            placeholder="Votre mot de passe"
                            class="pl-10 w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required
                            autocomplete="current-password">
                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eye-icon" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="mot-de-passe-oublie.php" class="text-sm text-green-600 hover:text-green-800 font-medium">
                        Mot de passe oublié ?
                    </a>
                </div>

                <div>
                    <button type="submit" name="login" value=""
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Se connecter
                        </span>
                    </button>
                </div>

                <div class="text-center text-sm text-gray-600">
                    <p>Vous n'avez pas de compte ?
                        <a href="inscription.php" class="font-bold text-green-600 hover:text-green-800">
                            S'inscrire maintenant
                        </a>
                    </p>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-center text-sm text-gray-500 mb-4">Ou connectez-vous avec</p>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button"
                        class="flex items-center justify-center p-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                        <span>Facebook</span>
                    </button>
                    <button type="button"
                        class="flex items-center justify-center p-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.954 11.629c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 12.385 4.066 10.255 1.64 7.126c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.397 0-.79-.023-1.177-.067 2.179 1.397 4.768 2.212 7.548 2.212 9.054 0 14.002-7.496 14.002-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
                        </svg>
                        <span>Twitter</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Informations sur les avantages -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 border border-green-200">
            <div class="flex items-center mb-8">
                <div class="bg-green-600 p-3 rounded-full mr-4">
                    <span class="text-white text-2xl">🦁</span>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Pourquoi créer un compte ?</h2>
                    <p class="text-gray-600">Découvrez les avantages exclusifs</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="bg-white p-2 rounded-lg mr-4 shadow-sm">
                        <span class="text-green-600 text-xl">⭐</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1">Contenu exclusif</h3>
                        <p class="text-gray-600">Accédez à des vidéos, photos et articles réservés aux membres</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-white p-2 rounded-lg mr-4 shadow-sm">
                        <span class="text-green-600 text-xl">📅</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1">Visites virtuelles</h3>
                        <p class="text-gray-600">Participez à des visites guidées en direct avec nos soigneurs</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-white p-2 rounded-lg mr-4 shadow-sm">
                        <span class="text-green-600 text-xl">🎁</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1">Avantages membres</h3>
                        <p class="text-gray-600">Réductions sur les produits de la boutique et événements spéciaux</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-white p-2 rounded-lg mr-4 shadow-sm">
                        <span class="text-green-600 text-xl">💾</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1">Sauvegarde des favoris</h3>
                        <p class="text-gray-600">Gardez une trace de vos animaux préférés et de vos observations</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 p-6 bg-white rounded-xl shadow-sm">
                <h3 class="font-bold text-lg mb-4 text-gray-800">⚠️ Sécurité des comptes</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Vos données sont cryptées et protégées</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Nous ne partageons jamais vos informations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Connexion sécurisée HTTPS</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction pour afficher/masquer le mot de passe
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    }

    // Focus sur le champ email au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const emailField = document.getElementById('email');
        if (emailField && !emailField.value) {
            emailField.focus();
        }
    });
</script>