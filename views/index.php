<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kari - Location courte durée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-blue-600">Kari.</a>
                    <span class="ml-2 text-sm text-gray-500 hidden md:inline">Votre maison loin de chez vous</span>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="available-rentals.php" class="text-gray-700 hover:text-blue-600  transition">Explorer</a>
                    <?php
                        if (! isset($_SESSION['userID'])) {
                        ?>
                    <div>
                        <button id="loginBtn"
                            class="text-gray-700 py-3 px-2 rounded-lg border hover:text-blue-600 hover:border-blue-600 transition">se
                            connecter</button>
                        <button id="signupBtn"
                            class="py-3 px-3 rounded-lg bg-blue-600 text-white hover:bg-blue-950 transition">s'inscrire</button>
                    </div>
                    <?php
                        } else {
                        ?>
                    <div class="flex space-x-6 items-center">
                        <a href="favorites.php" class="text-gray-700 hover:text-blue-600 transition">Favoris</a>
                        <a href="#notifications" class="text-gray-700 hover:text-blue-600 transition relative">
                            <i class="far fa-bell"></i>
                        </a>

                        <!-- User Menu -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <span class="text-gray-700"><?=$_SESSION['name']?></span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block transition">
                                
                                <a href="user-profile.php"
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user-circle mr-2"></i>Mon profil
                                </a>
                                <?php
                                 switch($_SESSION['role']){
                                    case 'travler' : echo '<a href="reservations.php"
                                                           class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                                           <i class="fas fa-calendar-check mr-2"></i>Mes réservations
                                                           </a>';
                                                     break;
                                    case 'host'    : echo '<a href="rentals.php"
                                                           class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                                           <i class="fas fa-home mr-2"></i>Mes logements
                                                           </a>';
                                                     break;
                                    case 'admin'   : echo '<a href="admin-dashboard.php"
                                                           class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                                           <i class="fas fa-cog mr-2"></i>Administration
                                                           </a>';
                                                     break;
                                 }
                                ?>
                                <hr class="my-1">
                                <a href="../repositories/logout.php?target=index"
                                    class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </a>
                            </div>
                        </div>

                    </div>
                    <?php
                               }
                           ?>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t py-4">
            <div class="container mx-auto px-4 flex flex-col space-y-3">
                <a href="#explorer" class="text-gray-700 hover:text-blue-600 py-2">Explorer</a>
                <a href="#favorites" class="text-gray-700 hover:text-blue-600 py-2">Favoris</a>
                <a href="#host" class="text-gray-700 hover:text-blue-600 py-2">Devenir hôte</a>
                <a href="#notifications" class="text-gray-700 hover:text-blue-600 py-2">
                    <i class="far fa-bell mr-2"></i>Notifications
                    <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">3</span>
                </a>
                <hr>
                <a href="#profile" class="text-gray-700 hover:text-blue-600 py-2">
                    <i class="fas fa-user-circle mr-2"></i>Mon profil
                </a>
                <a href="#reservations" class="text-gray-700 hover:text-blue-600 py-2">
                    <i class="fas fa-calendar-check mr-2"></i>Mes réservations
                </a>
                <a href="#logout" class="text-red-600 hover:text-red-800 py-2">
                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-12 md:py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Trouvez votre maison <span
                            class="text-yellow-300">loin de chez vous</span></h1>
                    <p class="text-xl mb-8 text-blue-100">Réservez des logements uniques chez des hôtes locaux dans plus
                        de 100 pays.</p>

                    <!-- Search Form -->
                    <div class="bg-white rounded-xl shadow-2xl p-6 text-gray-800">
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <!-- Pays -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Pays</label>
                                    <div class="relative">
                                        <select
                                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                            <option value="">Sélectionnez un pays</option>
                                            <option value="france">France</option>
                                            <option value="spain">Espagne</option>
                                            <option value="italy">Italie</option>
                                            <option value="portugal">Portugal</option>
                                            <option value="germany">Allemagne</option>
                                            <option value="uk">Royaume-Uni</option>
                                            <option value="usa">États-Unis</option>
                                            <option value="canada">Canada</option>
                                            <option value="japan">Japon</option>
                                            <option value="australia">Australie</option>
                                        </select>
                                        <i
                                            class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>

                                <!-- Ville (dynamique selon le pays) -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Ville</label>
                                    <div class="relative">
                                        <select id="city-select"
                                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white"
                                            disabled>
                                            <option value="">Sélectionnez d'abord un pays</option>
                                        </select>
                                        <i
                                            class="fas fa-chevron-down absolute right-3 top-3.5 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>

                                <!-- Dates -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Dates</label>
                                    <input type="text"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="jj/mm - jj/mm">
                                </div>

                                <!-- Voyageurs -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Voyageurs</label>
                                    <div class="flex items-center border border-gray-300 rounded-lg p-3">
                                        <i class="fas fa-user text-gray-400 mr-2"></i>
                                        <input type="number" id="guest-count" class="w-full focus:outline-none"
                                            placeholder="2" min="1" max="16" value="2">
                                        <div class="flex ml-2">
                                            <button type="button"
                                                class="h-6 w-6 rounded-full border border-gray-400 flex items-center justify-center text-gray-600 hover:bg-gray-100"
                                                onclick="decrementGuests()">-</button>
                                            <button type="button"
                                                class="h-6 w-6 rounded-full border border-gray-400 flex items-center justify-center text-gray-600 hover:bg-gray-100 ml-1"
                                                onclick="incrementGuests()">+</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bouton Rechercher -->
                                <div class="flex items-end">
                                    <button
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                                        <i class="fas fa-search mr-2"></i> Rechercher
                                    </button>
                                </div>
                            </div>

                            <!-- Filtres avancés -->
                            <div class="mt-4">
                                <div class="flex items-center text-sm mb-2">
                                    <span class="text-gray-600 mr-4">Recherche avancée:</span>
                                    <div class="flex space-x-4">
                                        <label class="flex items-center cursor-pointer">
                                            <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded"> Prix min
                                        </label>
                                        <label class="flex items-center cursor-pointer">
                                            <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded"> Prix max
                                        </label>
                                        <label class="flex items-center cursor-pointer">
                                            <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded"> Superhôte
                                        </label>
                                    </div>
                                </div>

                                <!-- Filtres détaillés (apparaissent quand checkboxes cochées) -->
                                <div id="advanced-filters"
                                    class="hidden grid-cols-1 md:grid-cols-3 gap-4 mt-4 p-4 bg-gray-50 rounded-lg">
                                    <!-- Prix min/max -->
                                    <div class="col-span-1 md:col-span-2 grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Prix minimum</label>
                                            <div class="relative">
                                                <input type="number"
                                                    class="w-full p-2 border border-gray-300 rounded-lg" placeholder="0"
                                                    min="0">
                                                <span class="absolute right-3 top-2 text-gray-500">€/nuit</span>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Prix maximum</label>
                                            <div class="relative">
                                                <input type="number"
                                                    class="w-full p-2 border border-gray-300 rounded-lg"
                                                    placeholder="500" min="0">
                                                <span class="absolute right-3 top-2 text-gray-500">€/nuit</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Type de logement -->
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Type de logement</label>
                                        <select class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="">Tous types</option>
                                            <option value="apartment">Appartement</option>
                                            <option value="house">Maison</option>
                                            <option value="villa">Villa</option>
                                            <option value="chalet">Chalet</option>
                                            <option value="studio">Studio</option>
                                        </select>
                                    </div>

                                    <!-- Nombre de chambres -->
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Chambres</label>
                                        <select class="w-full p-2 border border-gray-300 rounded-lg">
                                            <option value="">Toutes</option>
                                            <option value="1">1 chambre</option>
                                            <option value="2">2 chambres</option>
                                            <option value="3">3 chambres</option>
                                            <option value="4+">4 chambres ou plus</option>
                                        </select>
                                    </div>

                                    <!-- Équipements -->
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Équipements</label>
                                        <div class="grid grid-cols-2 gap-2">
                                            <label class="flex items-center text-sm">
                                                <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded"> WiFi
                                            </label>
                                            <label class="flex items-center text-sm">
                                                <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded">
                                                Piscine
                                            </label>
                                            <label class="flex items-center text-sm">
                                                <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded">
                                                Parking
                                            </label>
                                            <label class="flex items-center text-sm">
                                                <input type="checkbox" class="mr-1 h-4 w-4 text-blue-600 rounded">
                                                Climatisation
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-10">Comment fonctionne Kari</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-blue-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-search text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Recherchez</h3>
                        <p class="text-gray-600">Trouvez le logement idéal qui correspond à vos dates, votre budget et
                            vos envies.</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-blue-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-check text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Réservez</h3>
                        <p class="text-gray-600">Réservez en toute sécurité grâce à notre système de paiement sécurisé.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="bg-blue-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-home text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Séjournez</h3>
                        <p class="text-gray-600">Profitez de votre séjour et laissez un avis pour aider la communauté.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Kari</h3>
                        <p class="text-gray-400">Trouvez votre maison loin de chez vous. Réservez des logements uniques
                            chez des hôtes locaux.</p>
                        <div class="flex space-x-4 mt-6">
                            <a href="#"
                                class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-400 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#"
                                class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold mb-4">Pour les voyageurs</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Comment réserver</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Paiement sécurisé</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Assurance voyage</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Centre d'aide</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold mb-4">Pour les hôtes</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Devenir hôte</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Gérer ses annonces</a>
                            </li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Ressources pour hôtes</a>
                            </li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Forum communautaire</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold mb-4">Contact</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-envelope mr-2"></i> support@kari.com
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-phone mr-2"></i> +33 1 23 45 67 89
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="fas fa-map-marker-alt mr-2"></i> 123 Rue de Paris, 75000 Paris
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="border-gray-800 my-8">

                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400">© 2026 Kari. Tous droits réservés.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white transition">Confidentialité</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Conditions</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Plan du site</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">Cookies</a>
                    </div>
                </div>
            </div>
        </footer>
        <div id="results-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
            <div class="min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden">
                    <!-- En-tête du modal -->
                    <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Résultats de recherche</h2>
                                <p class="text-gray-600 text-sm mt-1">
                                    <span id="results-count">24</span> logements disponibles à
                                    <span id="search-location" class="font-medium">Paris, France</span>
                                </p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <!-- Filtres rapides -->
                                <div class="hidden md:flex items-center space-x-2">
                                    <button
                                        class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                                        <i class="fas fa-filter mr-1"></i>Filtrer
                                    </button>
                                    <select class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg bg-white">
                                        <option>Trier par: Pertinence</option>
                                        <option>Prix croissant</option>
                                        <option>Prix décroissant</option>
                                        <option>Meilleures notes</option>
                                    </select>
                                </div>
                                <button id="close-modal"
                                    class="h-10 w-10 rounded-full hover:bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-times text-xl text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Résumé de la recherche -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-blue-100 text-blue-800 text-sm rounded-full flex items-center">
                                <i class="fas fa-calendar-alt mr-1.5 text-xs"></i>15-20 oct. 2023 • 2 voyageurs
                            </span>
                            <span
                                class="px-3 py-1.5 bg-green-100 text-green-800 text-sm rounded-full flex items-center">
                                <i class="fas fa-euro-sign mr-1.5 text-xs"></i>Prix: 50€ - 200€
                            </span>
                            <span
                                class="px-3 py-1.5 bg-purple-100 text-purple-800 text-sm rounded-full flex items-center">
                                <i class="fas fa-home mr-1.5 text-xs"></i>Appartements
                            </span>
                            <button
                                class="px-3 py-1.5 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-full">
                                <i class="fas fa-edit mr-1"></i>Modifier la recherche
                            </button>
                        </div>
                    </div>

                    <!-- Contenu du modal -->
                    <div class="flex h-[calc(90vh-180px)]">
                        <!-- Liste des résultats -->
                        <div class="w-full lg:w-1/2 overflow-y-auto p-6 border-r border-gray-200">
                            <!-- Résultat 1 -->
                            <div class="mb-6 pb-6 border-b border-gray-100 last:border-b-0">
                                <div class="flex">
                                    <div class="w-32 h-32 rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Appartement Paris" class="h-full w-full object-cover">
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-bold text-lg hover:text-blue-600 cursor-pointer">Studio
                                                    moderne à Montmartre</h3>
                                                <p class="text-gray-600 text-sm mt-1">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>Paris, 18ème
                                                    arrondissement
                                                </p>
                                                <div class="flex items-center mt-2">
                                                    <div class="flex text-yellow-400">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <span class="ml-2 font-bold">4.8</span>
                                                    <span class="ml-1 text-gray-600">(124 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-center">
                                                    <i
                                                        class="fas fa-heart text-gray-300 hover:text-red-500 cursor-pointer ml-2"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-500 text-sm">2 voyageurs • 1 chambre • 1 salle de
                                                    bain</p>
                                                <div class="flex items-center mt-1">
                                                    <span
                                                        class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2">WiFi
                                                        gratuit</span>
                                                    <span
                                                        class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Cuisine
                                                        équipée</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold text-blue-600">89€</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                                <p class="text-green-600 text-sm font-medium">Disponible</p>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex space-x-2">
                                            <button
                                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                                Réserver
                                            </button>
                                            <button
                                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Résultat 2 -->
                            <div class="mb-6 pb-6 border-b border-gray-100 last:border-b-0">
                                <div class="flex">
                                    <div class="w-32 h-32 rounded-xl overflow-hidden flex-shrink-0 relative">
                                        <img src="https://images.unsplash.com/photo-1513584684374-8bab748fbf90?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Appartement vue Tour Eiffel" class="h-full w-full object-cover">
                                        <span
                                            class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">SUPERHÔTE</span>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-bold text-lg hover:text-blue-600 cursor-pointer">
                                                    Appartement vue Tour Eiffel</h3>
                                                <p class="text-gray-600 text-sm mt-1">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>Paris, 7ème arrondissement
                                                </p>
                                                <div class="flex items-center mt-2">
                                                    <div class="flex text-yellow-400">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span class="ml-2 font-bold">5.0</span>
                                                    <span class="ml-1 text-gray-600">(89 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-center">
                                                    <i class="fas fa-heart text-red-500 cursor-pointer ml-2"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-500 text-sm">4 voyageurs • 2 chambres • 1 salle de
                                                    bain</p>
                                                <div class="flex items-center mt-1">
                                                    <span
                                                        class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2">Vue
                                                        exceptionnelle</span>
                                                    <span
                                                        class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Ascenseur</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold text-blue-600">145€</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                                <p class="text-red-600 text-sm font-medium">Dernière chambre !</p>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex space-x-2">
                                            <button
                                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                                Réserver
                                            </button>
                                            <button
                                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Résultat 3 -->
                            <div class="mb-6 pb-6 border-b border-gray-100 last:border-b-0">
                                <div class="flex">
                                    <div class="w-32 h-32 rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Loft Saint-Germain" class="h-full w-full object-cover">
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-bold text-lg hover:text-blue-600 cursor-pointer">Loft
                                                    design Saint-Germain</h3>
                                                <p class="text-gray-600 text-sm mt-1">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>Paris, 6ème arrondissement
                                                </p>
                                                <div class="flex items-center mt-2">
                                                    <div class="flex text-yellow-400">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                    <span class="ml-2 font-bold">4.2</span>
                                                    <span class="ml-1 text-gray-600">(67 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-center">
                                                    <i
                                                        class="fas fa-heart text-gray-300 hover:text-red-500 cursor-pointer ml-2"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-500 text-sm">2 voyageurs • Studio • 1 salle de bain
                                                </p>
                                                <div class="flex items-center mt-1">
                                                    <span
                                                        class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2">Terrasse</span>
                                                    <span
                                                        class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Machine
                                                        à laver</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold text-blue-600">112€</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                                <p class="text-green-600 text-sm font-medium">Disponible</p>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex space-x-2">
                                            <button
                                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                                Réserver
                                            </button>
                                            <button
                                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Résultat 4 -->
                            <div class="mb-6 pb-6 border-b border-gray-100 last:border-b-0">
                                <div class="flex">
                                    <div class="w-32 h-32 rounded-xl overflow-hidden flex-shrink-0 relative">
                                        <img src="https://images.unsplash.com/photo-1558036117-15e82a2c9a9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                            alt="Maison de ville Marais" class="h-full w-full object-cover">
                                        <span
                                            class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">PROMO
                                            -20%</span>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-bold text-lg hover:text-blue-600 cursor-pointer">Maison
                                                    de ville dans le Marais</h3>
                                                <p class="text-gray-600 text-sm mt-1">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>Paris, 4ème arrondissement
                                                </p>
                                                <div class="flex items-center mt-2">
                                                    <div class="flex text-yellow-400">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <span class="ml-2 font-bold">4.7</span>
                                                    <span class="ml-1 text-gray-600">(203 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-center">
                                                    <i
                                                        class="fas fa-heart text-gray-300 hover:text-red-500 cursor-pointer ml-2"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-500 text-sm">6 voyageurs • 3 chambres • 2 salles de
                                                    bain</p>
                                                <div class="flex items-center mt-1">
                                                    <span
                                                        class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2">Jardin
                                                        privé</span>
                                                    <span
                                                        class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Cheminée</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-end justify-end">
                                                    <p class="text-lg line-through text-gray-400 mr-2">250€</p>
                                                    <p class="text-2xl font-bold text-blue-600">200€</p>
                                                </div>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                                <p class="text-green-600 text-sm font-medium">Disponible</p>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex space-x-2">
                                            <button
                                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                                Réserver
                                            </button>
                                            <button
                                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Charger plus de résultats -->
                            <div class="text-center pt-4">
                                <button class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <i class="fas fa-spinner mr-2"></i>Charger plus de résultats (20+)
                                </button>
                            </div>
                        </div>

                        <!-- Carte et informations détaillées -->
                        <div class="hidden lg:block w-1/2 p-6">
                            <!-- Carte (placeholder) -->
                            <div class="h-64 bg-gray-200 rounded-xl overflow-hidden mb-6 relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 opacity-80 flex items-center justify-center">
                                    <div class="text-white text-center">
                                        <i class="fas fa-map-marked-alt text-4xl mb-3"></i>
                                        <p class="text-xl font-bold">Carte interactive</p>
                                        <p class="text-sm mt-1">Les logements sont affichés sur la carte</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Filtres détaillés -->
                            <div class="mb-6">
                                <h3 class="font-bold text-lg mb-3">Affiner votre recherche</h3>
                                <div class="space-y-4">
                                    <!-- Prix -->
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Prix par nuit</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="range" min="0" max="500" value="200"
                                                class="flex-1 h-2 bg-gray-300 rounded-lg appearance-none cursor-pointer">
                                            <span class="text-sm font-medium">0€ - 200€</span>
                                        </div>
                                    </div>

                                    <!-- Type de logement -->
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Type de logement</label>
                                        <div class="grid grid-cols-2 gap-2">
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <span>Appartement</span>
                                            </label>
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <span>Maison</span>
                                            </label>
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <span>Studio</span>
                                            </label>
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <span>Loft</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Équipements -->
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Équipements</label>
                                        <div class="grid grid-cols-2 gap-2">
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <i class="fas fa-wifi mr-2 text-gray-500"></i>
                                                <span>WiFi</span>
                                            </label>
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <i class="fas fa-swimming-pool mr-2 text-gray-500"></i>
                                                <span>Piscine</span>
                                            </label>
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <i class="fas fa-car mr-2 text-gray-500"></i>
                                                <span>Parking</span>
                                            </label>
                                            <label
                                                class="flex items-center p-2 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 rounded">
                                                <i class="fas fa-snowflake mr-2 text-gray-500"></i>
                                                <span>Climatisation</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Boutons filtres -->
                                    <div class="flex space-x-2">
                                        <button
                                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                            Appliquer les filtres
                                        </button>
                                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                            Réinitialiser
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistiques -->
                            <div class="bg-gray-50 rounded-xl p-4">
                                <h3 class="font-bold text-lg mb-3">Conseils pour Paris</h3>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2"></i>
                                        <span>Les prix sont généralement plus élevés en été et pendant les
                                            événements</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-subway text-blue-500 mt-0.5 mr-2"></i>
                                        <span>Les arrondissements 1-8 sont les mieux desservis par les transports</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-utensils text-blue-500 mt-0.5 mr-2"></i>
                                        <span>Le Marais et Saint-Germain sont parfaits pour les restaurants</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Pied du modal -->
                    <div class="sticky bottom-0 bg-white border-t border-gray-200 px-6 py-4">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="mb-3 md:mb-0">
                                <p class="text-gray-600 text-sm">
                                    Affichage de <span class="font-bold">1-4</span> sur <span
                                        class="font-bold">24</span> résultats
                                </p>
                                <p class="text-gray-500 text-xs mt-1">
                                    <i class="fas fa-sync-alt mr-1"></i>Résultats mis à jour il y a 2 minutes
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <button class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-download mr-2"></i>Exporter
                                </button>
                                <button
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                                    <i class="fas fa-share-alt mr-2"></i>Partager
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Connexion -->
        <div id="loginModal"
            class="overlay fixed inset-0 bg-black bg-opacity-50  z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
                <!-- En-tête -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-800">Connexion</h2>
                        <button id="close-login" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">Connectez-vous à votre compte Kari</p>
                </div>

                <!-- Formulaire -->
                <form id="login-form" class="p-6" action="../repositories/login.php" method="post">
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <div class="relative">
                            <input type="email" name="email" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="vous@exemple.com">
                            <i class="fas fa-envelope absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Votre mot de passe">
                            <i class="fas fa-lock absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 mb-4">
                        Se connecter
                    </button>

                    <!-- Lien vers inscription -->
                    <div class="text-center">
                        <p class="text-gray-600 text-sm">
                            Vous n'avez pas de compte ?
                            <button type="button" id="signupRedirectBtn"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                S'inscrire
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal d'Inscription -->
        <div id="signupModal"
            class="overlay fixed inset-0 bg-black bg-opacity-50  z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
                <!-- En-tête -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-800">Inscription</h2>
                        <button id="close-register" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">Rejoignez la communauté Kari</p>
                </div>

                <!-- Formulaire -->
                <form id="register-form" class="p-6" action="../repositories/signup.php" method="post">
                    <!-- Nom et Prénom -->
                    <div class="flex flex-col gap-4 mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Votre Nom Complet</label>
                        <input type="text" name="name" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Jean Duhh">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <div class="relative">
                            <input type="email" name="email" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="vous@exemple.com">
                            <i class="fas fa-envelope absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Créez un mot de passe">
                            <i class="fas fa-lock absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères avec chiffres et lettres</p>
                    </div>

                    <!-- Type de compte -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Je souhaite :</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                <input type="radio" name="roles" value="1" class="h-4 w-4 text-blue-600">
                                <div class="ml-3">
                                    <span class="block font-medium">Voyager</span>
                                    <span class="block text-xs text-gray-500">Réserver des logements</span>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                <input type="radio" name="roles" value="2" class="h-4 w-4 text-blue-600">
                                <div class="ml-3">
                                    <span class="block font-medium">Être hôte</span>
                                    <span class="block text-xs text-gray-500">Louer mon logement</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 mb-4">
                        Créer mon compte
                    </button>

                    <!-- Lien vers connexion -->
                    <div class="text-center">
                        <p class="text-gray-600 text-sm">
                            Vous avez déjà un compte ?
                            <button type="button" id="loginRedirectBtn"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                Se connecter
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <script src="../assets/script.js"></script>
</body>

</html>