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
                    <?php
                               }
                           ?>

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
    <section id="explorer" class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold">Logements populaires</h2>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-filter mr-2"></i>Filtrer
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-sort mr-2"></i>Trier
                        </button>
                    </div>
                </div>
                
                <!-- Rentals Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Rental Card 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Appartement moderne" class="w-full h-48 object-cover">
                            <button class="absolute top-3 right-3 text-white text-xl">
                                <i class="far fa-heart"></i>
                            </button>
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">SUPERHÔTE</div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Appartement moderne à Paris</h3>
                                    <p class="text-gray-600 text-sm">Paris, Île-de-France</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-bold">4.85</span>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">2 voyageurs · 1 chambre · 1 lit · 1 salle de bain</p>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <span class="font-bold text-lg">89€</span>
                                    <span class="text-gray-600"> / nuit</span>
                                </div>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    Réserver
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rental Card 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Chalet montagne" class="w-full h-48 object-cover">
                            <button class="absolute top-3 right-3 text-white text-xl">
                                <i class="fas fa-heart text-red-500"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Chalet cosy en montagne</h3>
                                    <p class="text-gray-600 text-sm">Chamonix, Auvergne-Rhône-Alpes</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-bold">4.92</span>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">6 voyageurs · 3 chambres · 4 lits · 2 salles de bain</p>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <span class="font-bold text-lg">145€</span>
                                    <span class="text-gray-600"> / nuit</span>
                                </div>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    Réserver
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rental Card 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Villa bord de mer" class="w-full h-48 object-cover">
                            <button class="absolute top-3 right-3 text-white text-xl">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Villa avec piscine à Nice</h3>
                                    <p class="text-gray-600 text-sm">Nice, Provence-Alpes-Côte d'Azur</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-bold">4.78</span>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">8 voyageurs · 4 chambres · 6 lits · 3 salles de bain</p>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <span class="font-bold text-lg">210€</span>
                                    <span class="text-gray-600"> / nuit</span>
                                </div>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    Réserver
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rental Card 4 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1480&q=80" 
                                 alt="Studio Bordeaux" class="w-full h-48 object-cover">
                            <button class="absolute top-3 right-3 text-white text-xl">
                                <i class="far fa-heart"></i>
                            </button>
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">SUPERHÔTE</div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg">Studio centre-ville Bordeaux</h3>
                                    <p class="text-gray-600 text-sm">Bordeaux, Nouvelle-Aquitaine</p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-bold">4.65</span>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">2 voyageurs · 1 chambre · 1 lit · 1 salle de bain</p>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <span class="font-bold text-lg">67€</span>
                                    <span class="text-gray-600"> / nuit</span>
                                </div>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    Réserver
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-center mt-10">
                    <nav class="flex items-center space-x-2">
                        <button class="h-10 w-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-100">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-medium">1</button>
                        <button class="h-10 w-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-100">2</button>
                        <button class="h-10 w-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-100">3</button>
                        <span class="px-2">...</span>
                        <button class="h-10 w-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-100">8</button>
                        <button class="h-10 w-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-100">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </section>
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

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

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