<?php
session_start();

require '../vendor/autoload.php';

use Core\Database;
use Entities\Favorite;

$pdo = Database::getInstance();
$user_id = $_SESSION['userID'];

$favorites = Favorite::getAllFavorites($pdo,$user_id);
$favorite_count = Favorite::getCount($user_id);
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
                        <span id="favorites-count"><?= $favorite_count ?></span> logements sauvegardés pour vos prochains voyages
                    </p>
                </div>
                <?php
                if($favorite_count > 1) {
                ?>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <a href="../services/favorites-handler.php?action=delete-all&target=favorites&rental_id=1" id="clear-all" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                        <i class="fas fa-trash-alt mr-2"></i>Tout effacer
                    </a >
                </div>
                <?php
                }
                ?>
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
                        <p class="text-2xl font-bold"><?= $favorite_count ?></p>
                    </div>
                </div>
            </div>
        </div>
                
        <!-- Favorites Content -->
        <div id="favorites-container" class="space-y-6">
            <div id="list-view-content">
                <?php
                foreach($favorites as $favorite) {
                ?>
                <div class="favorite-item bg-white rounded-xl shadow overflow-hidden fade-in mb-6" data-id="1">
                    <div class="md:flex">
                        <div class="md:w-1/4 relative">
                            <img src="<?= $favorite['img'] ?>"
                                 alt="<?= $favorite['title'] ?>" class="h-64 md:h-full w-full object-cover">
                            <div class="absolute top-3 right-3">
                                <a href="../services/favorites-handler.php?action=delete&rental_id=<?= $favorite['rental_id'] ?>&target=favorites" class="remove-favorite h-10 w-10 rounded-full bg-white shadow flex items-center justify-center hover:bg-red-50" 
                                        data-id="1">
                                    <i class="fas fa-times text-red-500"></i>
                                </a>
                            </div>
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold hover:text-blue-600 cursor-pointer"><?= $favorite['title'] ?></h3>
                                            <p class="text-gray-600 mt-1">
                                                <i class="fas fa-map-marker-alt mr-1"></i><?= $favorite['city'] ?>, <?= $favorite['adress'] ?>
                                            </p>
                                            <div class="flex items-center mt-2">
                                                <span class="ml-2 font-bold">4.8</span>
                                                <span class="ml-1 text-gray-600">(124 avis)</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-blue-600"><?= $favorite['price'] ?>$</p>
                                            <p class="text-gray-600 text-sm">par nuit</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Ajouté le</p>
                                            <p class="font-medium"><?= date('d F Y',strtotime($favorite['date'])) ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button onclick="dispalyBookingModal('<?= $favorite['title'] ?>',<?= $favorite['price'] ?>,<?= $favorite['rental_id'] ?>,'favorites')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    <i class="fas fa-dollar-sign mr-2"></i> Réserver maintenant
                                </button>
                                <a href="../services/favorites-handler.php?action=delete&rental_id=<?= $favorite['img'] ?>&target=favorites" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                    <i class="fas fa-trash-alt mr-2"></i> Retirer
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
                }
                ?>
                
        <!-- Empty State -->
         <?php
        if(empty($favorites)) {
         ?>
        <div id="empty-state" class=" text-center py-16">
            <div class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Vos favoris sont vides</h3>
            <p class="text-gray-600 max-w-md mx-auto mb-8">
                Explorez nos logements et ajoutez vos favoris pour les retrouver facilement ici.
            </p>
            <a href="available-rentals.php" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition">
                <i class="fas fa-search mr-2"></i> Explorer les logements
            </a>
        </div>
        <?php
        }
        ?>
        
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
        <section id="bookingModal">

    </section>
    <script src="../assets/script.js"></script>
</body>
</html>