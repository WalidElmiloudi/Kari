<?php
session_start();

require '../vendor/autoload.php';

use Core\Database;
use Entities\Admin;
use Entities\Notification;

    
$pdo = Database::getInstance();
$user_id = $_SESSION['userID'];
    
$users_count = Admin::getUsersCount($pdo);
$rentals_count = Admin::getActiveRentalsCount($pdo);
$bookings_count = Admin::getBookingsCount($pdo);
$users = Admin::getAllUsers($pdo);
$rentals = Admin::getAllRentals($pdo);
$bookings = Admin::getAllBookings($pdo);
$notifications = Notification::getUserNotifications($user_id);
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kari - Location courte durée</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
                        <button id="open-notifications-modal" class="cursor-pointer text-gray-700 hover:text-blue-600 transition relative">
                            <i class="far fa-bell"></i>
                        </button>

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
                    <h2 class="text-2xl font-bold text-gray-800">Tableau de bord administrateur</h2>
                    <p class="text-gray-600">Gestion complète de la plateforme Kari</p>
                </div>

            </header>
            
            <!-- Main Content -->
            <div class="p-8">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Utilisateurs totaux</p>
                                <p class="text-3xl font-bold"><?= $users_count ?></p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Logements actifs</p>
                                <p class="text-3xl font-bold"><?= $rentals_count ?></p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-home text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Réservations</p>
                                <p class="text-3xl font-bold"><?= $bookings_count ?></p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Revenus totaux</p>
                                <p class="text-3xl font-bold">-$</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Sections Tabs -->
                <div class="mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="flex space-x-8 overflow-x-auto">
                            <button id="tab-users" class="tab-button py-4 px-1 border-b-2 border-blue-600 text-blue-600 font-medium whitespace-nowrap">
                                <i class="fas fa-users mr-2"></i>Gestion Utilisateurs
                            </button>
                            <button id="tab-rentals" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                                <i class="fas fa-home mr-2"></i>Modération Logements
                            </button>
                            <button id="tab-reservations" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                                <i class="fas fa-calendar-check mr-2"></i>Toutes les Réservations
                            </button>
                        </nav>
                    </div>
                </div>
                
                <!-- Tab Content -->
                <div id="tab-content">
                    <!-- Users Management Tab -->
                    <div id="users-content" class="tab-panel active">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Gestion des utilisateurs</h3>
                        </div>
                        
                        <!-- Users Table -->
                        <div class="bg-white rounded-xl shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Utilisateur
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rôle
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Statut
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php
                                        foreach($users as $user) {
                                        ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-blue-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900"><?= $user['name'] ?></div>
                                                        <div class="text-sm text-gray-500"><?= $user['email'] ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php
                                                switch($user['role_name']) {
                                                    case 'travler' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                                           Voyageur
                                                                           </span>';
                                                                     break;
                                                    case 'host' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                                           Hôte
                                                                           </span>';
                                                                     break;
                                                }
                                                ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php
                                                switch($user['statut']) {
                                                    case 'active' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                                          Actif
                                                                          </span>';
                                                                    break;
                                                    case 'inactive' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                                          Suspendée
                                                                          </span>';
                                                                    break;
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                <?php
                                                switch($user['statut']) {
                                                    case 'active' : echo "<button onclick=\"changeUserStatut({$user['id']},'{$user['statut']}','users')\" class=\"text-red-600 hover:text-red-900\">
                                                                          Suspender
                                                                          </button>";
                                                                    break;
                                                    case 'inactive' : echo "<button onclick=\"changeUserStatut({$user['id']},'{$user['statut']}','users')\" class=\"text-green-600 hover:text-green-900\">
                                                                            Activer
                                                                            </button>";
                                                                    break;
                                                }
                                                ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Rentals Management Tab -->
                    <div id="rentals-content" class="tab-panel hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Modération des logements</h3>
                        </div>
                        
                        <!-- All Rentals Table -->
                        <div class="bg-white rounded-xl shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Logement
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Hôte
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Statut
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Réservations
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php
                                        foreach($rentals as $rental) {
                                        ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded overflow-hidden mr-3">
                                                        <img src="<?= $rental['img'] ?>" 
                                                             class="h-full w-full object-cover">
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900"><?= $rental['title'] ?></div>
                                                        <div class="text-sm text-gray-500"><?= $rental['price'] ?>$/nuit</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?= $rental['host'] ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                               <?php
                                                switch($rental['statut']) {
                                                    case 'active' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                                          Actif
                                                                          </span>';
                                                                    break;
                                                    case 'inactive' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                                          Suspendée
                                                                          </span>';
                                                                    break;
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?= $rental['total_bookings'] ?> réservations
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                <?php
                                                switch($rental['statut']) {
                                                    case 'active' : echo "<button onclick=\"changeUserStatut({$rental['id']},'{$rental['statut']}','rentals')\"  class=\"text-red-600 hover:text-red-900\">
                                                                          Suspender
                                                                          </button>";
                                                                    break;
                                                    case 'inactive' : echo "<button onclick=\"changeUserStatut({$rental['id']},'{$rental['statut']}','rentals')\" class=\"text-green-600 hover:text-green-900\">
                                                                            Activer
                                                                            </button>";
                                                                    break;
                                                }
                                                ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reservations Management Tab -->
                    <div id="reservations-content" class="tab-panel hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Gestion des réservations</h3>
                        </div>
                        
                        <!-- Reservations Table -->
                        <div class="bg-white rounded-xl shadow overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Logement
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Voyageur
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Dates
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Montant
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Statut
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php
                                        foreach($bookings as $booking) {
                                        ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <?= $booking['id'] ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded overflow-hidden mr-3">
                                                        <img src="<?= $booking['img'] ?>" 
                                                             class="h-full w-full object-cover">
                                                    </div>
                                                    <div class="text-sm text-gray-900"><?= $booking['title'] ?></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?= $booking['travler'] ?></div>
                                                <div class="text-sm text-gray-500"><?= $booking['email'] ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                               <?= date('d',strtotime($booking['start_date'])) ?> - <?= date('d M.Y',strtotime($booking['end_date'])) ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                -$
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php
                                                switch($booking['statut']) {
                                                    case 'active' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                                          Actif
                                                                          </span>';
                                                                    break;
                                                    case 'canceled' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                                          Annulée
                                                                          </span>';
                                                                    break;
                                                    case 'completed' : echo '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                                          Confirmée
                                                                          </span>';
                                                                    break;
                                                }
                                                ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                <?php
                                                if($booking['statut'] === 'active') {
                                                ?>
                                                <button onclick="cancellationModal(<?= $booking['id'] ?>,'admin-dashboard')" class="text-red-600 hover:text-red-900 cancel-reservation-admin" data-id="2456">
                                                    Annuler
                                                </button>
                                                <?php
                                                }
                                                ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modals -->
    <!-- Cancel Reservation Modal -->
    <div id="cancel-reservation-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="h-16 w-16 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold text-center text-gray-800 mb-3">Annuler une réservation</h3>
                
                <div id="reservation-details" class="p-4 bg-gray-50 rounded-lg mb-6">
                    <!-- Dynamic content will be inserted here -->
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Raison de l'annulation</label>
                    <select id="cancellation-reason" class="w-full p-3 border border-gray-300 rounded-lg">
                        <option value="">Sélectionnez une raison</option>
                        <option value="fraud">Fraude suspectée</option>
                        <option value="safety">Problème de sécurité</option>
                        <option value="complaint">Suite à une réclamation</option>
                        <option value="terms">Violation des conditions</option>
                        <option value="other">Autre raison</option>
                    </select>
                    <textarea id="other-reason" class="w-full p-3 border border-gray-300 rounded-lg mt-2 hidden" 
                              placeholder="Expliquez la raison..."></textarea>
                </div>
                
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" id="refund-checkbox" class="h-4 w-4 text-blue-600 rounded mt-1">
                        <span class="ml-2 text-sm text-gray-700">
                            Rembourser intégralement le voyageur
                        </span>
                    </label>
                    <label class="flex items-start mt-2">
                        <input type="checkbox" id="notify-checkbox" checked class="h-4 w-4 text-blue-600 rounded mt-1">
                        <span class="ml-2 text-sm text-gray-700">
                            Notifier le voyageur et l'hôte par email
                        </span>
                    </label>
                </div>
                
                <div class="flex space-x-3">
                    <button id="confirm-cancel-reservation" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                        Annuler la réservation
                    </button>
                    <button id="cancel-cancel-reservation" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                        Retour
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notification Toast -->
    <div id="notification-toast" class="fixed bottom-4 right-4 bg-green-600 text-white rounded-lg shadow-2xl p-4 hidden slide-in z-50 max-w-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-xl mr-3"></i>
            <div>
                <p class="font-medium" id="notification-message">Action réussie !</p>
                <p class="text-sm opacity-90" id="notification-details">Les modifications ont été enregistrées.</p>
            </div>
            <button id="close-notification" class="ml-4 text-white opacity-75 hover:opacity-100">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <section id="pop-up-container">
        
    </section>
        <!-- Cancellation Modal -->
     <section id="cancellation-modal">

     </section>
             <!-- Notifications Modal -->
        <section id="notifications-modal" class="inset-0 fixed overlay bg-black/20 hidden items-center justify-center" aria-hidden="true">
            <div class="bg-white rounded-xl shadow-2xl max-w-xl w-full h-[50%]">
                <div class="p-6">
                   <div class="flex items-center justify-between mb-4">
                     <h3 class="text-2xl font-bold text-gray-800">Notifications</h3>
                     <button id="close-notifications-modal" class="cursor-pointer">X</button class="cursor-pointer">
                   </div>
                   <div class="w-full h-100 bg-gray-100 overflow-auto [scrollbar-width:none] flex flex-col items-center pt-2 gap-2">
                    <?php
                    foreach($notifications as $notification) {
                    ?>
                    <div class="w-[95%] rounded-md bg-white flex justify-between px-5 py-5">
                        <h3>
                            <?= $notification['body'] ?>
                        </h3>
                        <h3>
                            <?= $notification['date'] ?>
                        </h3>
                    </div>
                    <?php
                    }
                    if(empty($notifications)) {
                    ?>
                    <h1>
                        Vous n'avez aucune notification pour le moment !
                    </h1>
                    <?php
                    }
                    ?>
                   </div>
                </div>
               
            </div>
        </section>
           <!-- JavaScript -->
    <script src="../assets/script.js"></script>
</body>
</html>