<?php
session_start();

require_once '../vendor/autoload.php';

use Entities\Travler;
use Core\Database;

$pdo = Database::getInstance();
$user_id = $_SESSION['userID'];

$bookings = Travler::getBooking($pdo,$user_id);
$active_bookings_count = Travler::getBookingCount($pdo,$user_id,'active');
$completed_bookings_count = Travler::getBookingCount($pdo,$user_id,'completed');
$canceled_bookings_count = Travler::getBookingCount($pdo,$user_id,'canceled');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - Kari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
                        <a href="available-rentals.php" class="text-gray-700 hover:text-blue-600 transition">Explorer</a>
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

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Mes réservations</h1>
            <p class="text-gray-600 mt-2">Gérez vos réservations à venir et consultez votre historique</p>
        </div>
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">À venir</p>
                        <p class="text-2xl font-bold"><?= $active_bookings_count ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Terminées</p>
                        <p class="text-2xl font-bold"><?= $completed_bookings_count ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center mr-4">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Annulées</p>
                        <p class="text-2xl font-bold"><?= $canceled_bookings_count ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reservations Content -->
        <div id="tab-content">
            <!-- Upcoming Reservations (Default Tab) -->
            <div id="upcoming-content" class="tab-panel active">
                <h2 class="text-xl font-bold mb-6">Vos prochains séjours</h2>
                
                <?php
                foreach($bookings as $booking) {
                ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="md:flex">
                        <div class="md:w-1/4">
                            <img src="<?= $booking['img'] ?>" 
                                 alt="Booking Image" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold"><?= $booking['title'] ?></h3>
                                            <p class="text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i><?= $booking['city'] ?>, <?= $booking['adress'] ?>
                                            </p>
                                            <?php
                                            switch($booking['statut']) {
                                                case 'active' : echo '<span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">
                                                                      Activée
                                                                      </span>';
                                                                break;
                                                case 'canceled' : echo '<span class="bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full">
                                                                      Annulée
                                                                      </span>';
                                                                break;
                                                case 'completed' : echo '<span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                                                      Confirmée
                                                                      </span>';
                                                                break;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Dates</p>
                                            <p class="font-medium">
                                                <i class="far fa-calendar mr-2"></i><?= date('d',strtotime($booking['start_date'])) ?> - <?= date('d M.Y',strtotime($booking['end_date'])) ?>
                                            </p>
                                            <!-- <p class="text-sm text-gray-600 mt-1">3 nuits</p> -->
                                        </div>
                                        <div>
                                            <!-- <p class="text-sm text-gray-600">Prix total</p>
                                            <p class="text-2xl font-bold text-blue-600">267€</p> -->
                                            <p class="text-sm text-gray-600"><?= $booking['price'] ?>$ / nuit</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 mb-1">Hôte</p>
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                            <span class="font-medium"><?= $booking['name'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-file-invoice mr-2"></i> Voir la facture
                                </button>
                                <?php
                                if($booking['statut'] === 'active') {
                                ?>
                                <button onclick="cancellationModal(<?= $booking['booking_id'] ?>)" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                    <i class="fas fa-times mr-2"></i> Annuler la réservation
                                </button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                
            <!-- Cancelled Reservations -->
            <div id="cancelled-content" class="tab-panel hidden">
                <h2 class="text-xl font-bold mb-6">Réservations annulées</h2>
                
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-1/4">
                            <img src="https://images.unsplash.com/photo-1513584684374-8bab748fbf90?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Maison campagne" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold">Maison de campagne en Provence</h3>
                                            <p class="text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Avignon, Provence
                                            </p>
                                        </div>
                                        <div>
                                            <span class="bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full">
                                                Annulée
                                            </span>
                                            <p class="text-sm text-gray-600 mt-1 text-right">Annulé le 15 août 2023</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Dates prévues</p>
                                            <p class="font-medium">20-27 août 2023</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Prix total</p>
                                            <p class="text-xl font-bold text-blue-600">560€</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Remboursement</p>
                                            <p class="font-medium text-green-600">Remboursé: 420€</p>
                                            <p class="text-xs text-gray-600">(Frais de service: 140€)</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Cancellation Details -->
                                    <div class="mt-4 p-4 bg-red-50 rounded-lg">
                                        <h4 class="font-medium text-red-800 mb-2">
                                            <i class="fas fa-info-circle mr-2"></i>Détails de l'annulation
                                        </h4>
                                        <p class="text-sm text-red-700">
                                            Annulé par vous • Politique de remboursement: 75% jusqu'à 7 jours avant l'arrivée
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <!-- Cancellation Modal -->
     <section id="cancellation-modal">

     </section>
    <script src="../assets/script.js"></script>
</body>
</html>