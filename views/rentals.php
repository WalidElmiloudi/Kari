<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hôte - Kari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
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
                    <a href="index.php" class="text-gray-700 hover:text-blue-600  transition">Home</a>
                    <div class="flex space-x-6 items-center">
                        <a href="available-rentals.php" class="text-gray-700 hover:text-blue-600 transition">Explorer</a>
                        <a href="favorites.php" class="text-gray-700 hover:text-blue-600 transition">Favoris</a>
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
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t py-4">
            <div class="container mx-auto px-4 flex flex-col space-y-3">
                <a href="index.html" class="text-gray-700 hover:text-blue-600 py-2">Home</a>
                <a href="available-rentals.html" class="text-gray-700 hover:text-blue-600 py-2">Explorer</a>
                <a href="#favorites" class="text-gray-700 hover:text-blue-600 py-2">Favoris</a>
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
        <div class="flex-1">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Bienvenue, <?= ucfirst($_SESSION['name']) ?></h2>
                    <p class="text-gray-600">Voici un aperçu de votre activité hôte</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition flex items-center">
                        <i class="fas fa-plus mr-2"></i> Nouveau logement
                    </button>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Stat Card 1 -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Revenus ce mois</p>
                                <p class="text-3xl font-bold">2,845€</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-euro-sign text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> 18% vs mois dernier
                        </div>
                    </div>
                    
                    <!-- Stat Card 2 -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Réservations actives</p>
                                <p class="text-3xl font-bold">8</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-blue-600">
                            3 arrivées cette semaine
                        </div>
                    </div>
                    
                    <!-- Stat Card 3 -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Taux d'occupation</p>
                                <p class="text-3xl font-bold">78%</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-purple-600">
                            <i class="fas fa-arrow-up mr-1"></i> 12% vs mois dernier
                        </div>
                    </div>
                    
                    <!-- Stat Card 4 -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Note moyenne</p>
                                <p class="text-3xl font-bold">4.9</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            24 avis ce mois-ci
                        </div>
                    </div>
                </div>
                
                <!-- Main Dashboard Sections -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: My Rentals -->
                    <div class="lg:col-span-2">
                        <!-- Section Header -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Mes logements</h3>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-filter mr-2"></i>Filtrer
                                </button>
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus mr-2"></i>Ajouter
                                </button>
                            </div>
                        </div>
                        
                        <!-- Rentals List -->
                        <div class="space-y-6">
                            <!-- Rental 1 -->
                            <div class="bg-white rounded-xl shadow overflow-hidden">
                                <div class="flex">
                                    <div class="w-48 relative">
                                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             alt="Appartement Paris" class="h-full w-full object-cover">
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">ACTIF</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-lg">Appartement moderne à Paris</h4>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>Paris, 15ème arrondissement
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
                                                    <span class="ml-1 text-gray-600">(42 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold">89€</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-3 gap-4 mt-4">
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-blue-600">78%</p>
                                                <p class="text-sm text-gray-600">Occupation</p>
                                            </div>
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-green-600">12</p>
                                                <p class="text-sm text-gray-600">Réservations</p>
                                            </div>
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-purple-600">3,210€</p>
                                                <p class="text-sm text-gray-600">Revenus</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-6">
                                            <div class="flex space-x-2">
                                                <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
                                                    <i class="fas fa-eye mr-1"></i> Voir
                                                </button>
                                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                                    <i class="fas fa-edit mr-1"></i> Modifier
                                                </button>
                                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                                    <i class="fas fa-calendar-alt mr-1"></i> Calendrier
                                                </button>
                                            </div>
                                            <div class="relative group">
                                                <button class="h-10 w-10 flex items-center justify-center rounded-full hover:bg-gray-100">
                                                    <i class="fas fa-ellipsis-v text-gray-600"></i>
                                                </button>
                                                <div class="absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-10">
                                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-chart-bar mr-2"></i>Statistiques
                                                    </a>
                                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-images mr-2"></i>Photos
                                                    </a>
                                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-copy mr-2"></i>Dupliquer
                                                    </a>
                                                    <hr class="my-1">
                                                    <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                                        <i class="fas fa-trash mr-2"></i>Supprimer
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Rental 2 -->
                            <div class="bg-white rounded-xl shadow overflow-hidden">
                                <div class="flex">
                                    <div class="w-48 relative">
                                        <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             alt="Chalet montagne" class="h-full w-full object-cover">
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">EN LIGNE</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-lg">Chalet cosy en montagne</h4>
                                                <p class="text-gray-600 text-sm">
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
                                                    <span class="ml-1 text-gray-600">(18 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold">145€</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-3 gap-4 mt-4">
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-blue-600">92%</p>
                                                <p class="text-sm text-gray-600">Occupation</p>
                                            </div>
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-green-600">24</p>
                                                <p class="text-sm text-gray-600">Réservations</p>
                                            </div>
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-purple-600">8,540€</p>
                                                <p class="text-sm text-gray-600">Revenus</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-6">
                                            <div class="flex space-x-2">
                                                <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
                                                    <i class="fas fa-eye mr-1"></i> Voir
                                                </button>
                                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                                    <i class="fas fa-edit mr-1"></i> Modifier
                                                </button>
                                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                                    <i class="fas fa-calendar-alt mr-1"></i> Calendrier
                                                </button>
                                            </div>
                                            <div class="relative group">
                                                <button class="h-10 w-10 flex items-center justify-center rounded-full hover:bg-gray-100">
                                                    <i class="fas fa-ellipsis-v text-gray-600"></i>
                                                </button>
                                                <div class="absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-10">
                                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-chart-bar mr-2"></i>Statistiques
                                                    </a>
                                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-images mr-2"></i>Photos
                                                    </a>
                                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-copy mr-2"></i>Dupliquer
                                                    </a>
                                                    <hr class="my-1">
                                                    <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                                        <i class="fas fa-trash mr-2"></i>Supprimer
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Rental 3 -->
                            <div class="bg-white rounded-xl shadow overflow-hidden">
                                <div class="flex">
                                    <div class="w-48 relative">
                                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                             alt="Studio Bordeaux" class="h-full w-full object-cover">
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-gray-600 text-white text-xs font-bold px-2 py-1 rounded">INACTIF</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-lg">Studio centre-ville Bordeaux</h4>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>Bordeaux, Centre-ville
                                                </p>
                                                <div class="flex items-center mt-2">
                                                    <div class="flex text-yellow-400">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <span class="ml-2 font-bold">4.6</span>
                                                    <span class="ml-1 text-gray-600">(31 avis)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold">67€</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-3 gap-4 mt-4">
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-blue-600">45%</p>
                                                <p class="text-sm text-gray-600">Occupation</p>
                                            </div>
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-green-600">6</p>
                                                <p class="text-sm text-gray-600">Réservations</p>
                                            </div>
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-purple-600">1,240€</p>
                                                <p class="text-sm text-gray-600">Revenus</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-6">
                                            <div class="flex space-x-2">
                                                <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
                                                    <i class="fas fa-eye mr-1"></i> Voir
                                                </button>
                                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                                    <i class="fas fa-edit mr-1"></i> Modifier
                                                </button>
                                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                                    <i class="fas fa-calendar-alt mr-1"></i> Calendrier
                                                </button>
                                            </div>
                                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                <i class="fas fa-power-off mr-1"></i> Activer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Empty State -->
                        <div class="mt-8 text-center p-8 bg-white rounded-xl shadow">
                            <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-home text-blue-600 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold mb-2">Aucun autre logement</h4>
                            <p class="text-gray-600 mb-4">Vous n'avez pas d'autres logements à afficher.</p>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i> Publier un nouveau logement
                            </button>
                        </div>
                    </div>
                    
                    <!-- Right Column: Sidebar -->
                    <div class="space-y-8">
                        <!-- Quick Stats -->
                        <div class="bg-white rounded-xl shadow p-6">
                            <h4 class="font-bold text-lg mb-4">Aperçu rapide</h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Logements actifs</span>
                                    <span class="font-bold">2/3</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Nouveaux messages</span>
                                    <span class="font-bold text-blue-600">3</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Réservations à venir</span>
                                    <span class="font-bold">5</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Avis en attente</span>
                                    <span class="font-bold">2</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Paiements en attente</span>
                                    <span class="font-bold text-green-600">1,245€</span>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                    <i class="fas fa-chart-bar mr-2"></i> Voir les statistiques détaillées
                                </a>
                            </div>
                        </div>
                        
                        <!-- Recent Reservations -->
                        <div class="bg-white rounded-xl shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-lg">Réservations récentes</h4>
                                <a href="#" class="text-blue-600 text-sm">Voir tout</a>
                            </div>
                            <div class="space-y-4">
                                <div class="p-3 border border-gray-200 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium">Sophie Laurent</p>
                                            <p class="text-sm text-gray-600">Appartement Paris</p>
                                        </div>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Confirmé</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 mt-2">
                                        <i class="fas fa-calendar mr-1"></i>
                                        <span>15 - 20 oct. 2023</span>
                                    </div>
                                </div>
                                
                                <div class="p-3 border border-gray-200 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium">Thomas Bernard</p>
                                            <p class="text-sm text-gray-600">Chalet Chamonix</p>
                                        </div>
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">En cours</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 mt-2">
                                        <i class="fas fa-calendar mr-1"></i>
                                        <span>22 - 29 oct. 2023</span>
                                    </div>
                                </div>
                                
                                <div class="p-3 border border-gray-200 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium">Julie Martin</p>
                                            <p class="text-sm text-gray-600">Studio Bordeaux</p>
                                        </div>
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Annulé</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 mt-2">
                                        <i class="fas fa-calendar mr-1"></i>
                                        <span>5 - 12 nov. 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Performance Tips -->
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                            <h4 class="font-bold text-lg mb-3 text-blue-800">Conseils de performance</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span class="text-sm">Répondez rapidement aux demandes (taux de réponse: 95%)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                    <span class="text-sm">Maintenez un taux d'annulation bas (actuellement 2%)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-exclamation-circle text-yellow-500 mt-1 mr-2"></i>
                                    <span class="text-sm">Ajoutez plus de photos à votre studio Bordeaux</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-lightbulb text-blue-500 mt-1 mr-2"></i>
                                    <span class="text-sm">Ajustez vos prix pour les weekends</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        
    
    <!-- JavaScript for interactivity -->
    <script>
        // Toggle dropdown menus
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle (if needed)
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Make all dropdowns work
            const dropdownButtons = document.querySelectorAll('.group button');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('hidden');
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.group .hidden').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>