<?php
session_start();
?>
<!-- User Profile Preview -->
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                    <div class="flex space-x-6 items-center">
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
                                <span class="text-gray-700"><?=$_SESSION['name']?></span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block transition">
                                
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
                <a href="#explorer" class="text-gray-700 hover:text-blue-600 py-2">Explorer</a>
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
    
    <section id="profile" class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-32"></div>
                        <div class="px-8 py-6 relative">
                            <div class="absolute -top-10 left-8">
                                <div class="h-20 w-20 rounded-full bg-blue-100 border-4 border-white flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-3xl"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-start">
                                <div class="pt-8">
                                    <h2 class="text-2xl font-bold"><?= $_SESSION['name'] ?></h2>
                                    <p class="text-gray-600"><?= ucfirst($_SESSION['role']) ?></p>
                                    <!-- <div class="flex items-center mt-2">
                                        <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                        <span>Paris, France</span>
                                        <i class="fas fa-star text-yellow-400 ml-4 mr-1"></i>
                                        <span class="font-medium">4.9</span>
                                        <span class="text-gray-600 ml-1">(12 avis)</span>
                                    </div> -->
                                </div>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                                    <i class="fas fa-edit mr-2"></i> Modifier
                                </button>
                            </div>
                        </div>
                        
                        <!-- Profile Tabs -->
                        <div class="border-t">
                            <!-- <div class="flex overflow-x-auto">
                                <button class="px-6 py-4 border-b-2 border-blue-600 text-blue-600 font-medium whitespace-nowrap">
                                    <i class="fas fa-user-circle mr-2"></i>Profil
                                </button>
                                <button class="px-6 py-4 border-b-2 border-transparent text-gray-600 hover:text-blue-600 font-medium whitespace-nowrap">
                                    <i class="fas fa-calendar-check mr-2"></i>Réservations
                                </button>
                                <button class="px-6 py-4 border-b-2 border-transparent text-gray-600 hover:text-blue-600 font-medium whitespace-nowrap">
                                    <i class="fas fa-home mr-2"></i>Mes logements
                                </button>
                                <button class="px-6 py-4 border-b-2 border-transparent text-gray-600 hover:text-blue-600 font-medium whitespace-nowrap">
                                    <i class="fas fa-heart mr-2"></i>Favoris
                                </button>
                                <button class="px-6 py-4 border-b-2 border-transparent text-gray-600 hover:text-blue-600 font-medium whitespace-nowrap">
                                    <i class="fas fa-comment-alt mr-2"></i>Avis
                                </button>
                                <button class="px-6 py-4 border-b-2 border-transparent text-gray-600 hover:text-blue-600 font-medium whitespace-nowrap">
                                    <i class="fas fa-cog mr-2"></i>Paramètres
                                </button>
                            </div> -->
                            
                            <!-- Profile Content -->
                            <div class="p-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Left Column -->
                                    <div>
                                        <h3 class="text-xl font-bold mb-4">Informations personnelles</h3>
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                                                <p class="p-3 bg-gray-50 rounded-lg"><?= $_SESSION['name'] ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <p class="p-3 bg-gray-50 rounded-lg"><?= $_SESSION['email'] ?></p>
                                            </div>
                                        </div>
                                        
                                        <h3 class="text-xl font-bold mt-8 mb-4">Préférences de notifications</h3>
                                        <div class="space-y-3">
                                            <label class="flex items-center">
                                                <input type="checkbox" class="mr-2" checked>
                                                <span>Nouvelles réservations</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" class="mr-2" checked>
                                                <span>Messages des voyageurs</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" class="mr-2">
                                                <span>Promotions et offres spéciales</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <!-- Right Column -->
                                    <!-- <div>
                                        <h3 class="text-xl font-bold mb-4">Statistiques</h3>
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg">
                                                <span>Voyages effectués</span>
                                                <span class="font-bold text-lg">8</span>
                                            </div>
                                            <div class="flex justify-between items-center p-4 bg-green-50 rounded-lg">
                                                <span>Logements publiés</span>
                                                <span class="font-bold text-lg">2</span>
                                            </div>
                                            <div class="flex justify-between items-center p-4 bg-purple-50 rounded-lg">
                                                <span>Réservations reçues</span>
                                                <span class="font-bold text-lg">24</span>
                                            </div>
                                            <div class="flex justify-between items-center p-4 bg-yellow-50 rounded-lg">
                                                <span>Note moyenne</span>
                                                <span class="font-bold text-lg">4.9</span>
                                            </div>
                                        </div>
                                        
                                        <h3 class="text-xl font-bold mt-8 mb-4">Avis récents</h3>
                                        <div class="space-y-4">
                                            <div class="p-4 border border-gray-200 rounded-lg">
                                                <div class="flex justify-between mb-2">
                                                    <div class="font-medium">Jean Martin</div>
                                                    <div class="flex">
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                    </div>
                                                </div>
                                                <p class="text-gray-600 text-sm">"Marie est une hôte exceptionnelle, je recommande vivement !"</p>
                                                <p class="text-gray-400 text-xs mt-2">15 juin 2023</p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../assets/script.js"></script>
</body>
</html>