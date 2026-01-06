<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris - Kari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Animation pour retirer des favoris */
        @keyframes fadeOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(-100px); }
        }
        .fade-out {
            animation: fadeOut 0.3s ease forwards;
        }
        /* Animation pour les cartes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>
<body class="bg-gray-50">
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
                    <a href="index.php" class="text-gray-700 hover:text-blue-600  transition">Home</a>
                    <div class="flex space-x-6 items-center">
                        <a href="available-rentals.php" class="text-gray-700 hover:text-blue-600 transition">Explorer</a>
                        <a href="#notifications" class="text-gray-700 hover:text-blue-600 transition relative">
                            <i class="far fa-bell"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </a>

                        <!-- User Menu -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <span class="text-gray-700"><?= $_SESSION['name'] ?></span>
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
                    </div>
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
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Mes favoris</h1>
                    <p class="text-gray-600 mt-2">
                        <span id="favorites-count">12</span> logements sauvegardés pour vos prochains voyages
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-share-alt mr-2"></i>Partager
                    </button>
                    <button id="clear-all" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                        <i class="fas fa-trash-alt mr-2"></i>Tout effacer
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-heart text-red-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Favoris</p>
                        <p class="text-2xl font-bold">12</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Réservés</p>
                        <p class="text-2xl font-bold">3</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                        <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Destinations</p>
                        <p class="text-2xl font-bold">8</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                        <i class="fas fa-euro-sign text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Prix moyen</p>
                        <p class="text-2xl font-bold">124€</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filters and Sorting -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between bg-white rounded-xl shadow p-4">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <select class="pl-10 pr-8 py-2 border border-gray-300 rounded-lg appearance-none bg-white">
                                <option>Trier par: Date d'ajout</option>
                                <option>Prix croissant</option>
                                <option>Prix décroissant</option>
                                <option>Meilleures notes</option>
                                <option>Proximité</option>
                            </select>
                            <i class="fas fa-sort absolute left-3 top-3 text-gray-400"></i>
                            <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <div class="relative">
                            <select class="pl-10 pr-8 py-2 border border-gray-300 rounded-lg appearance-none bg-white">
                                <option>Filtrer par: Tous</option>
                                <option>Disponibles maintenant</option>
                                <option>Avec promotion</option>
                                <option>Superhôtes</option>
                                <option>Par destination</option>
                            </select>
                            <i class="fas fa-filter absolute left-3 top-3 text-gray-400"></i>
                            <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <span class="text-gray-600 text-sm">Affichage:</span>
                    <button id="grid-view" class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button id="list-view" class="p-2 bg-blue-600 text-white rounded-lg">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Favorites Content -->
        <div id="favorites-container" class="space-y-6">
            <!-- View Toggle -->
            <div id="list-view-content">
                <!-- Favorite 1 -->
                <div class="favorite-item bg-white rounded-xl shadow overflow-hidden fade-in" data-id="1">
                    <div class="md:flex">
                        <div class="md:w-1/4 relative">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Appartement Paris" class="h-64 md:h-full w-full object-cover">
                            <div class="absolute top-3 left-3">
                                <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">SUPERHÔTE</span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <button class="remove-favorite h-10 w-10 rounded-full bg-white shadow flex items-center justify-center hover:bg-red-50" 
                                        data-id="1">
                                    <i class="fas fa-times text-red-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold hover:text-blue-600 cursor-pointer">Studio moderne à Montmartre</h3>
                                            <p class="text-gray-600 mt-1">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Paris, 18ème arrondissement
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
                                                <span class="ml-3 text-sm text-green-600">
                                                    <i class="fas fa-check-circle mr-1"></i>Disponible
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-blue-600">89€</p>
                                            <p class="text-gray-600 text-sm">par nuit</p>
                                            <p class="text-green-600 text-sm font-medium mt-1">-20% cette semaine</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Capacité</p>
                                            <p class="font-medium">
                                                <i class="fas fa-user mr-2"></i>2 voyageurs
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Équipements</p>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">WiFi</span>
                                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Cuisine</span>
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">TV</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Ajouté le</p>
                                            <p class="font-medium">15 septembre 2023</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-gray-600 text-sm mb-2">Notes personnelles:</p>
                                        <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                            <p class="text-sm text-yellow-800">
                                                <i class="fas fa-sticky-note mr-2"></i>
                                                Parfait pour un week-end en amoureux. Vue magnifique depuis le balcon.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-calendar-check mr-2"></i> Vérifier disponibilité
                                </button>
                                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    <i class="fas fa-euro-sign mr-2"></i> Réserver maintenant
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-share mr-2"></i> Partager
                                </button>
                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                    <i class="fas fa-trash-alt mr-2"></i> Retirer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Favorite 2 -->
                <div class="favorite-item bg-white rounded-xl shadow overflow-hidden fade-in" data-id="2">
                    <div class="md:flex">
                        <div class="md:w-1/4 relative">
                            <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Chalet montagne" class="h-64 md:h-full w-full object-cover">
                            <div class="absolute top-3 right-3">
                                <button class="remove-favorite h-10 w-10 rounded-full bg-white shadow flex items-center justify-center hover:bg-red-50" 
                                        data-id="2">
                                    <i class="fas fa-times text-red-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold hover:text-blue-600 cursor-pointer">Chalet cosy en montagne</h3>
                                            <p class="text-gray-600 mt-1">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Chamonix, Haute-Savoie
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
                                                <span class="ml-3 text-sm text-red-600">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>Indisponible jusqu'à déc.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-blue-600">145€</p>
                                            <p class="text-gray-600 text-sm">par nuit</p>
                                            <p class="text-gray-500 text-sm font-medium mt-1">Minimum 3 nuits</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Capacité</p>
                                            <p class="font-medium">
                                                <i class="fas fa-user mr-2"></i>6 voyageurs
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Équipements</p>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Cheminée</span>
                                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Jacuzzi</span>
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">Parking</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Ajouté le</p>
                                            <p class="font-medium">2 août 2023</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-gray-600 text-sm mb-2">Mes alertes:</p>
                                        <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm text-blue-800">
                                                        <i class="fas fa-bell mr-2"></i>
                                                        Alerte prix activée • Me notifier si prix < 120€
                                                    </p>
                                                </div>
                                                <button class="text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit mr-1"></i>Modifier
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-calendar-alt mr-2"></i> Voir le calendrier
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition" disabled>
                                    <i class="fas fa-euro-sign mr-2"></i> Indisponible
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-bell mr-2"></i> Alerte disponibilité
                                </button>
                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                    <i class="fas fa-trash-alt mr-2"></i> Retirer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Favorite 3 -->
                <div class="favorite-item bg-white rounded-xl shadow overflow-hidden fade-in" data-id="3">
                    <div class="md:flex">
                        <div class="md:w-1/4 relative">
                            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Villa bord de mer" class="h-64 md:h-full w-full object-cover">
                            <div class="absolute top-3 left-3">
                                <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">PROMO</span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <button class="remove-favorite h-10 w-10 rounded-full bg-white shadow flex items-center justify-center hover:bg-red-50" 
                                        data-id="3">
                                    <i class="fas fa-times text-red-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold hover:text-blue-600 cursor-pointer">Villa avec piscine à Nice</h3>
                                            <p class="text-gray-600 mt-1">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Nice, Côte d'Azur
                                            </p>
                                            <div class="flex items-center mt-2">
                                                <div class="flex text-yellow-400">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <span class="ml-2 font-bold">4.0</span>
                                                <span class="ml-1 text-gray-600">(56 avis)</span>
                                                <span class="ml-3 text-sm text-green-600">
                                                    <i class="fas fa-bolt mr-1"></i>Réduction instantanée
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="flex items-end justify-end">
                                                <p class="text-lg line-through text-gray-400 mr-2">210€</p>
                                                <p class="text-2xl font-bold text-blue-600">168€</p>
                                            </div>
                                            <p class="text-gray-600 text-sm">par nuit</p>
                                            <p class="text-green-600 text-sm font-medium mt-1">-20% cette semaine</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Capacité</p>
                                            <p class="font-medium">
                                                <i class="fas fa-user mr-2"></i>8 voyageurs
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Équipements</p>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Piscine</span>
                                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Jardin</span>
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">BBQ</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Ajouté le</p>
                                            <p class="font-medium">28 juillet 2023</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-gray-600 text-sm mb-2">Pour voyage avec:</p>
                                        <div class="flex items-center space-x-2">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">
                                                <i class="fas fa-users mr-1"></i>Famille
                                            </span>
                                            <span class="px-3 py-1 bg-pink-100 text-pink-800 text-sm rounded-full">
                                                <i class="fas fa-glass-cheers mr-1"></i>Amis
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-calendar-check mr-2"></i> Vérifier disponibilité
                                </button>
                                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    <i class="fas fa-euro-sign mr-2"></i> Réserver maintenant
                                </button>
                                <button class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition">
                                    <i class="fas fa-clock mr-2"></i> Offre expire bientôt
                                </button>
                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                    <i class="fas fa-trash-alt mr-2"></i> Retirer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Grid View (hidden by default) -->
            <div id="grid-view-content" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Appartement Paris" class="h-48 w-full object-cover">
                            <button class="absolute top-3 right-3 h-8 w-8 rounded-full bg-white shadow flex items-center justify-center hover:bg-red-50">
                                <i class="fas fa-heart text-red-500"></i>
                            </button>
                            <div class="absolute top-3 left-3">
                                <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">SUPERHÔTE</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg">Studio moderne à Montmartre</h3>
                            <p class="text-gray-600 text-sm mt-1">
                                <i class="fas fa-map-marker-alt mr-1"></i>Paris, France
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
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">89€</p>
                                    <p class="text-gray-600 text-sm">par nuit</p>
                                </div>
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                                    Réserver
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More grid cards would go here -->
                </div>
            </div>
        </div>
        
        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-16">
            <div class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Vos favoris sont vides</h3>
            <p class="text-gray-600 max-w-md mx-auto mb-8">
                Explorez nos logements et ajoutez vos favoris pour les retrouver facilement ici. 
                Vous pourrez les comparer, partager avec des amis et recevoir des alertes prix.
            </p>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition">
                <i class="fas fa-search mr-2"></i> Explorer les logements
            </button>
        </div>
        
        <!-- Collections -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Mes collections</h2>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i> Nouvelle collection
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Collection 1 -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600 relative">
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <i class="fas fa-sun text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Vacances d'été 2024</h3>
                        <p class="text-gray-600 text-sm mb-4">5 logements • Modifiée hier</p>
                        <div class="flex items-center justify-between">
                            <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </button>
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-lock mr-1"></i> Privée
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Collection 2 -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-green-500 to-teal-600 relative">
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <i class="fas fa-skiing text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Séjour montagne</h3>
                        <p class="text-gray-600 text-sm mb-4">3 logements • Modifiée il y a 3 jours</p>
                        <div class="flex items-center justify-between">
                            <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </button>
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-users mr-1"></i> Partagée
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Collection 3 -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-red-500 to-pink-600 relative">
                        <div class="absolute inset-0 flex items-center justify-center text-white">
                            <i class="fas fa-heart text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Week-ends en amoureux</h3>
                        <p class="text-gray-600 text-sm mb-4">4 logements • Modifiée il y a 1 semaine</p>
                        <div class="flex items-center justify-between">
                            <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm">
                                <i class="fas fa-eye mr-1"></i> Voir
                            </button>
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-lock mr-1"></i> Privée
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Clear All Confirmation Modal -->
    <div id="clear-all-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50  items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="h-16 w-16 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold text-center text-gray-800 mb-3">Vider tous les favoris ?</h3>
                
                <p class="text-gray-600 text-center mb-6">
                    Vous êtes sur le point de supprimer <span class="font-bold">12 logements</span> de vos favoris. 
                    Cette action est irréversible.
                </p>
                
                <div class="flex space-x-3">
                    <button id="confirm-clear-all" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                        Oui, tout vider
                    </button>
                    <button id="cancel-clear-all" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Kari</h3>
                    <p class="text-gray-400">Trouvez votre maison loin de chez vous. Réservez des logements uniques chez des hôtes locaux.</p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-400 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="h-10 w-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition">
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
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Gérer ses annonces</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Ressources pour hôtes</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Forum communautaire</a></li>
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
    <script>
          const userMenuButton = document.querySelector('.group button');
            const userDropdown = document.querySelector('.group .hidden');
            
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking elsewhere
                document.addEventListener('click', () => {
                    userDropdown.classList.add('hidden');
                });
            }
        </script>
</body>
</html>