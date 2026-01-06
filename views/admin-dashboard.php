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
                    <a href="index.php" class="text-gray-700 hover:text-blue-600  transition">Home</a>
                    <div class="flex space-x-6 items-center">
                        <a href="available-rentals.php" class="text-gray-700 hover:text-blue-600  transition">Explorer</a>
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
                                
                                <a href="user-profile.php"
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user-circle mr-2"></i>Mon profil
                                </a>
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
    <!-- Admin Dashboard Preview -->
        <section id="admin" class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center">Tableau de bord administration</h2>
                
                <!-- Admin Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Utilisateurs</p>
                                <p class="text-3xl font-bold">1,247</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> 12% ce mois-ci
                        </div>
                    </div>
                    
                    <div class="bg-green-50 rounded-xl p-6 border border-green-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Logements</p>
                                <p class="text-3xl font-bold">568</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-home text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> 8% ce mois-ci
                        </div>
                    </div>
                    
                    <div class="bg-purple-50 rounded-xl p-6 border border-purple-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Réservations</p>
                                <p class="text-3xl font-bold">3,892</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> 23% ce mois-ci
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Revenus</p>
                                <p class="text-3xl font-bold">289,540€</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-euro-sign text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> 15% ce mois-ci
                        </div>
                    </div>
                </div>
                
                <!-- Admin Actions -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-xl font-bold mb-4">Actions d'administration</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button class="flex items-center justify-center p-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-user-slash text-red-500 mr-2"></i>
                            <span>Gérer les utilisateurs</span>
                        </button>
                        <button class="flex items-center justify-center p-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-home text-blue-500 mr-2"></i>
                            <span>Modérer les logements</span>
                        </button>
                        <button class="flex items-center justify-center p-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-chart-bar text-green-500 mr-2"></i>
                            <span>Voir les statistiques</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
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