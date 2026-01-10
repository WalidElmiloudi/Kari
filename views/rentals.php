<?php
session_start();

require '../vendor/autoload.php';

use Core\Database;
use Entities\Host;

$pdo = Database::getInstance();
$user_id = $_SESSION['userID'];

$rentals = Host::getAllRentals($pdo,$user_id);
$rentals_count = Host::getRentalsCount($pdo,$user_id);
$active_rentals_count = Host::getActiveRentalsCount($pdo,$user_id);
$active_bookings_count = Host::getActiveBookingCount($pdo,$user_id);
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
    <nav class="bg-white shadow-lg sticky w-full top-0 z-50">
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
                    <!-- <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-0.5">3</span> -->
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
                <div id="add-rental" class="flex items-center space-x-4">
                    <button  class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition flex items-center">
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
                                <p class="text-gray-600">Réservations actives</p>
                                <p class="text-3xl font-bold"><?= $active_rentals_count ?></p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat Card 2 -->
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Note moyenne</p>
                                <p class="text-3xl font-bold">0</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
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
                        </div>
                        
                        <!-- Rentals List Container -->
                        <div class="space-y-6">
                            <?php
                            foreach($rentals as $rental){
                            $booking_count = Host::getBookingCountById($pdo,$rental['id']);
                            ?>
                                 <div class="bg-white rounded-xl shadow overflow-hidden">
                                <div class="flex">
                                    <div class="w-48 relative">
                                        <img src="<?= $rental['img'] ?>" 
                                             alt="logement photo" class="h-full w-full object-cover">
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-gray-600 text-white text-xs font-bold px-2 py-1 rounded"><?= $rental['statut'] ?></span>
                                        </div>
                                    </div>
                                    <div class="flex-1 p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-lg"><?= $rental['title'] ?></h4>
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fas fa-map-marker-alt mr-1"></i><?= $rental['city'] ?>,<?= $rental['adress'] ?>
                                                </p>
                                                <div class="flex items-center mt-2">
                                                    <!-- <div class="flex text-yellow-400">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <span class="ml-2 font-bold">4.8</span>
                                                    <span class="ml-1 text-gray-600">(42 avis)</span> -->
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold"><?= $rental['price'] ?>$</p>
                                                <p class="text-gray-600 text-sm">par nuit</p>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-3 gap-4 mt-4">
                                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                <p class="text-2xl font-bold text-green-600"><?= $booking_count ?></p>
                                                <p class="text-sm text-gray-600">Réservations</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-6">
                                            <div class="flex space-x-2">
                                                <?php
                                                if($rental['statut'] === 'inactive'){
                                                ?>
                                                <button data-id="<?= $rental['id'] ?>" class="change-statut inactive px-4 py-2 bg-green-400 text-white rounded-lg hover:bg-green-500 transition">
                                                    Activer
                                                </button>
                                                <?php
                                                } else {
                                                ?>
                                                <button data-id="<?= $rental['id'] ?>" class="change-statut active px-4 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500 transition">
                                                    Desactiver
                                                </button>
                                                <?php }
                                                ?>
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
                            <?php
                            }
                            ?>
                        </div>
                           
                        
                        <!-- Empty State -->
                        <!-- <div class="mt-8 text-center p-8 bg-white rounded-xl shadow">
                            <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-home text-blue-600 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold mb-2">Aucun autre logement</h4>
                            <p class="text-gray-600 mb-4">Vous n'avez pas d'autres logements à afficher.</p>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i> Publier un nouveau logement
                            </button>
                        </div> -->
                    </div>
                    
                    <!-- Right Column: Sidebar -->
                    <div class="space-y-8">
                        <!-- Quick Stats -->
                        <div class="bg-white rounded-xl shadow p-6">
                            <h4 class="font-bold text-lg mb-4">Aperçu rapide</h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Logements actifs</span>
                                    <span class="font-bold"><?= $active_rentals_count?>/<?= $rentals_count?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Réservations à venir</span>
                                    <span class="font-bold"><?= $active_bookings_count ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Avis en attente</span>
                                    <span class="font-bold">0</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Recent Reservations -->
                        <div class="bg-white rounded-xl shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-lg">Réservations</h4>
                            </div>
                            <div class="space-y-4">
                           
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
         <!-- Modal Overlay -->
  <div id="add-rental-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center pt-10 justify-center overlay" aria-hidden="true">

    <!-- Modal Box -->
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">

      <!-- Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
          Add New Rental
        </h2>
        <span id="close-add-rental-modal" class="text-gray-400 text-xl cursor-pointer">&times;</span>
      </div>

      <!-- Form -->
      <form class="space-y-4" action ="../services/add-rentals.php" enctype="multipart/form-data" method="post">

        <!-- Title -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Rental Title
          </label>
          <input
            type="text"
            name="title"
            placeholder="e.g. Cozy apartment in city center"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Description
          </label>
          <textarea
            rows="3"
            name="description"
            placeholder="Describe the rental..."
            class="w-full mt-1 px-3 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
        </div>

        <!-- Price -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Price per Night (USD)
          </label>
          <input
            type="number"
            name="price"
            step="0.01"
            placeholder="30"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>

        <!-- Location -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
        Country
          </label>
          <input
            type="text"
            name ="country"
            placeholder="Country"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">
        City
          </label>
          <input
            type="text"
            name="city"
            placeholder="City"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">
        Adress
          </label>
          <input
            type="text"
            name = "adress"
            placeholder="Adress"
            class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>
<!-- Photo Upload -->
<div>
  <label class="block text-sm font-medium text-gray-700 mb-1">
    Rental Photo
  </label>
  <!-- Upload Box -->
  <label
    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-lg cursor-pointer
           border-gray-300 bg-gray-50 hover:bg-gray-100 transition"
  >
    <div class="flex flex-col items-center justify-center text-center">
      <!-- Icon -->
      <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12M5 20h14a2 2 0 002-2v-2H3v2a2 2 0 002 2z"/>
      </svg>

      <p class="text-sm text-gray-600">
        <span class="font-semibold">Click to upload</span>l
      <p class="text-xs text-gray-500">
        PNG, JPG (max 5MB)
      </p>
    </div>

    <!-- Hidden Input -->
    <input
      type="file"
      name ="img"
      class="hidden"
      multiple
      accept="image/*"
    />
  </label>
</div>
        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-4">
          <button
            type="button"
            class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
          >
            Add Rental
          </button>
        </div>

      </form>
    </div>
  </div>

<!-- Overlay -->
<div id="activateRentalModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 overlay" aria-hidden="true">

  <!-- Modal Box -->
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Change Rental Status</h2>
      <button class="text-gray-400 hover:text-gray-600">✕</button>
    </div>

    <!-- Content -->
    <p class="text-gray-600 mb-6">
      Are you sure you want to <span class="font-semibold text-gray-800">activer</span> this rental?
    </p>

    <!-- Actions -->
    <div class="flex justify-end gap-3">
      <button
        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
        Cancel
      </button>

      <!-- Activate -->
      <form method="POST" action="../services/change-rental-statut.php?action=activate">
        <input id="activate-rental-id" type="hidden" name="rental_id">
        <button type="submit"
          class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
          Activer
        </button>
      </form>
    </div>

  </div>
</div>

<div id="deactivateRentalModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 overlay" aria-hidden="true">

  <!-- Modal Box -->
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Change Rental Status</h2>
      <button class="text-gray-400 hover:text-gray-600">✕</button>
    </div>

    <!-- Content -->
    <p class="text-gray-600 mb-6">
      Are you sure you want to <span class="font-semibold text-gray-800">desactiver</span> this rental?
    </p>

    <!-- Actions -->
    <div class="flex justify-end gap-3">
      <button
        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
        Cancel
      </button>

      <!-- Deactivate -->
      <form method="POST" action="../services/change-rental-statut.php?action=deactivate">
        <input id="deactivate-rental-id" type="hidden" name="rental_id">
        <button type="submit"
          class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
          Desactiver
        </button>
      </form>
    </div>

  </div>
</div>


    <!-- JavaScript for interactivity -->
    <script src="../assets/script.js">
        // // Toggle dropdown menus
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Mobile menu toggle (if needed)
        //     const mobileMenuButton = document.getElementById('mobile-menu-button');
        //     const mobileMenu = document.getElementById('mobile-menu');
            
        //     if (mobileMenuButton && mobileMenu) {
        //         mobileMenuButton.addEventListener('click', function() {
        //             mobileMenu.classList.toggle('hidden');
        //         });
        //     }
            
        //     // Make all dropdowns work
        //     const dropdownButtons = document.querySelectorAll('.group button');
        //     dropdownButtons.forEach(button => {
        //         button.addEventListener('click', function(e) {
        //             e.stopPropagation();
        //             const dropdown = this.nextElementSibling;
        //             dropdown.classList.toggle('hidden');
        //         });
        //     });
            
        //     // Close dropdowns when clicking outside
        //     document.addEventListener('click', function() {
        //         document.querySelectorAll('.group .hidden').forEach(dropdown => {
        //             dropdown.classList.add('hidden');
        //         });
        //     });
        // });
    </script>
</body>
</html>