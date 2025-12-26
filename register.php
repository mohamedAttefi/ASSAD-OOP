<?php

include "includes/db.php";
include "includes/classes/visiteur_non_connecter.php";
include "includes/header.php";
if (isset($_POST['add'])) {
    $nom   = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $confirmPassword = $_POST['confirm_password'];
    if ($password !== $confirmPassword) {
        die("Passwords do not match");
    }

    $_SESSION['date_inscription'] = (new DateTime())->format('Y-m-d H:i:s');


    $newuser = new visiteur_non_connecter($nom, $email, $password, $role);
    $newuser->Sinscrire($conn);
}

?>


<!-- Hero Section -->
<section class="py-8 bg-gradient-to-r from-green-800 to-emerald-900 text-white rounded-lg mb-8">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Rejoignez le Zoo Virtuel ASSAD</h1>
        <p class="text-xl">Créez votre compte et profitez d'expériences exclusives</p>
    </div>
</section>

<!-- Contenu principal -->
<div class="max-w-7xl mx-auto px-4 mb-10">
    <div class="grid md:grid-cols-2 gap-10 items-start">
        <!-- Formulaire d'inscription -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center mb-8">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <span class="text-green-600 text-2xl">📝</span>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Créez votre compte</h2>
                    <p class="text-gray-600">Rejoignez notre communauté</p>
                </div>
            </div>
            <form method="post" class="space-y-6" id="inscriptionForm">
                <!-- Nom et Prénom -->
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom complet *
                        </label>
                        <input type="text"
                            id="nom"
                            name="nom"
                            value=""
                            placeholder="Dupont Jean"
                            class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required>

                    </div>


                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Adresse email *
                    </label>
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
                            required>
                    </div>

                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Mot de passe *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password"
                            id="password"
                            name="password"
                            placeholder="Votre mot de passe sécurisé"
                            class="pl-10 w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required>
                        <button type="button"
                            onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eye-icon-password" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmer le mot de passe *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password"
                            id="confirm_password"
                            name="confirm_password"
                            placeholder="Répétez votre mot de passe"
                            class="pl-10 w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            required>
                        <button type="button"
                            onclick="togglePassword('confirm_password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eye-icon-confirm" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Type de compte *
                    </label>
                    <select id="role"
                        name="role"
                        class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        <option value="Visiteur">Visiteur - Accès basique</option>
                        <option value="Guide">Guide - Visites guidées</option>
                        <option value="Veterinaire">Vétérinaire - Soins aux animaux</option>
                        <option value="Admin">Administrateur - Gestion complète</option>
                    </select>

                </div>

                <!-- Conditions d'utilisation -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms"
                            name="terms"
                            type="checkbox"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                            required>
                    </div>
                    <div class="ml-3">
                        <label for="terms" class="text-sm text-gray-700">
                            J'accepte les
                            <a href="conditions.php" class="text-green-600 hover:text-green-800 font-medium" target="_blank">
                                conditions d'utilisation
                            </a>
                            et la
                            <a href="confidentialite.php" class="text-green-600 hover:text-green-800 font-medium" target="_blank">
                                politique de confidentialité
                            </a>
                            *
                        </label>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="newsletter"
                            name="newsletter"
                            type="checkbox"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    </div>
                    <div class="ml-3">
                        <label for="newsletter" class="text-sm text-gray-700">
                            Je souhaite recevoir la newsletter du Zoo Virtuel ASSAD avec des actualités et des offres spéciales.
                        </label>
                    </div>
                </div>

                <!-- Bouton d'inscription -->
                <div>
                    <button type="submit" name='add'
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Créer mon compte
                        </span>
                    </button>
                </div>

                <!-- Lien vers connexion -->
                <div class="text-center text-sm text-gray-600 pt-4 border-t">
                    <p>Vous avez déjà un compte ?
                        <a href="connexion.php" class="font-bold text-green-600 hover:text-green-800">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Informations sur les rôles -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 border border-green-200">
            <div class="flex items-center mb-8">
                <div class="bg-green-600 p-3 rounded-full mr-4">
                    <span class="text-white text-2xl">👥</span>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Types de comptes</h2>
                    <p class="text-gray-600">Choisissez le rôle qui correspond à vos besoins</p>
                </div>
            </div>

            <div class="space-y-6">
                <!-- Visiteur -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 p-2 rounded-lg mr-4">
                            <span class="text-green-600 text-lg">👤</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Visiteur</h3>
                            <p class="text-sm text-green-600">Accès gratuit</p>
                        </div>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Accès aux animaux et aux galeries</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Commentaires sur les animaux</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Favoris et listes personnelles</span>
                        </li>
                    </ul>
                </div>

                <!-- Guide -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-2 rounded-lg mr-4">
                            <span class="text-blue-600 text-lg">🗣️</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Guide</h3>
                            <p class="text-sm text-blue-600">Sur invitation</p>
                        </div>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tous les avantages Visiteur</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Création de visites guidées</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Animations en direct</span>
                        </li>
                    </ul>
                </div>



                <!-- Sécurité -->
                <div class="mt-8 p-6 bg-white rounded-xl shadow-sm">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">🔒 Sécurité des données</h3>
                    <p class="text-sm text-gray-600 mb-3">
                        Nous prenons la sécurité de vos données très au sérieux. Toutes les informations sont cryptées et protégées.
                    </p>
                    <ul class="text-xs text-gray-500 space-y-1">
                        <li>• Conformité RGPD</li>
                        <li>• Données hébergées en France</li>
                        <li>• Certificat SSL activé</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction pour afficher/masquer le mot de passe
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(`eye-icon-${fieldId}`);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    }

    // Validation en temps réel du mot de passe
</script>