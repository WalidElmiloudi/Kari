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
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Logements actifs</p>
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
                    
                    <div class="bg-white rounded-xl shadow p-6">
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
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Revenus totaux</p>
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
                
                <!-- Quick Actions -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4">Actions rapides</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <button class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-3">
                                <i class="fas fa-user-check text-blue-600 text-xl"></i>
                            </div>
                            <span class="font-medium">Valider utilisateurs</span>
                            <span class="text-sm text-gray-600">3 en attente</span>
                        </button>
                        
                        <button class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mb-3">
                                <i class="fas fa-home text-green-600 text-xl"></i>
                            </div>
                            <span class="font-medium">Modérer logements</span>
                            <span class="text-sm text-gray-600">5 signalés</span>
                        </button>
                        
                        <button class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center mb-3">
                                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                            </div>
                            <span class="font-medium">Réclamations</span>
                            <span class="text-sm text-gray-600">7 non traitées</span>
                        </button>
                        
                        <button class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow hover:shadow-md transition">
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center mb-3">
                                <i class="fas fa-file-invoice-dollar text-purple-600 text-xl"></i>
                            </div>
                            <span class="font-medium">Rapport financier</span>
                            <span class="text-sm text-gray-600">Générer le rapport</span>
                        </button>
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
                            <button id="tab-complaints" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Réclamations
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
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-download mr-2"></i>Exporter
                                </button>
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-user-plus mr-2"></i>Ajouter un admin
                                </button>
                            </div>
                        </div>
                        
                        <!-- Filters -->
                        <div class="bg-white rounded-xl shadow p-4 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <input type="text" placeholder="Rechercher par nom/email" class="p-2 border border-gray-300 rounded-lg">
                                <select class="p-2 border border-gray-300 rounded-lg">
                                    <option>Tous les rôles</option>
                                    <option>Voyageur</option>
                                    <option>Hôte</option>
                                    <option>Administrateur</option>
                                </select>
                                <select class="p-2 border border-gray-300 rounded-lg">
                                    <option>Tous les statuts</option>
                                    <option>Actif</option>
                                    <option>Inactif</option>
                                    <option>Suspendu</option>
                                    <option>En attente</option>
                                </select>
                                <button class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-filter mr-2"></i>Filtrer
                                </button>
                            </div>
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
                                                Inscription
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- User 1 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-blue-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Marie Dubois</div>
                                                        <div class="text-sm text-gray-500">marie@email.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                    Hôte ⭐
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Actif
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                15/06/2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-yellow-600 hover:text-yellow-900">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900 suspend-user" data-user="1">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- User 2 (Pending) -->
                                        <tr class="bg-yellow-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-gray-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Thomas Bernard</div>
                                                        <div class="text-sm text-gray-500">thomas@email.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                    Voyageur
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                    En attente
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Aujourd'hui
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-green-600 hover:text-green-900 approve-user" data-user="2">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900 reject-user" data-user="2">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- User 3 (Suspended) -->
                                        <tr class="bg-red-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-red-600"></i>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Jean Martin</div>
                                                        <div class="text-sm text-gray-500">jean@email.com</div>
                                                        <div class="text-xs text-red-600">3 réclamations</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                    Hôte
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                    Suspendu
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                10/05/2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-green-600 hover:text-green-900 activate-user" data-user="3">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="px-6 py-4 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-700">
                                        Affichage de <span class="font-bold">1-3</span> sur <span class="font-bold">1,247</span> utilisateurs
                                    </div>
                                    <nav class="flex space-x-2">
                                        <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-100">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="px-3 py-1 bg-blue-600 text-white rounded-lg">1</button>
                                        <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-100">2</button>
                                        <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-100">3</button>
                                        <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-100">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rentals Management Tab -->
                    <div id="rentals-content" class="tab-panel hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Modération des logements</h3>
                            <div class="flex space-x-3">
                                <select class="p-2 border border-gray-300 rounded-lg">
                                    <option>Tous les statuts</option>
                                    <option>Actif</option>
                                    <option>En attente</option>
                                    <option>Signalé</option>
                                    <option>Désactivé</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Reported Rentals -->
                        <div class="mb-8">
                            <h4 class="font-bold text-lg mb-4 text-red-600">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Logements signalés (5)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Reported Rental 1 -->
                                <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h5 class="font-bold">Appartement Paris - Rue douteuse</h5>
                                            <p class="text-sm text-gray-600">Signalé 3 fois pour fausses photos</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Urgent
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 mb-4">
                                        <span class="mr-4"><i class="fas fa-user mr-1"></i>Hôte: Jean Martin</span>
                                        <span><i class="fas fa-calendar mr-1"></i>Signalé le: 20/10/2023</span>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            <i class="fas fa-ban mr-2"></i>Désactiver
                                        </button>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            <i class="fas fa-eye mr-2"></i>Vérifier
                                        </button>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                                            <i class="fas fa-check mr-2"></i>Ignorer
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Reported Rental 2 -->
                                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h5 class="font-bold">Chalet Chamonix - Prix anormal</h5>
                                            <p class="text-sm text-gray-600">Prix 2x plus élevé que la moyenne</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            À vérifier
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 mb-4">
                                        <span class="mr-4"><i class="fas fa-user mr-1"></i>Hôte: Marie Dubois</span>
                                        <span><i class="fas fa-calendar mr-1"></i>Signalé le: 19/10/2023</span>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            <i class="fas fa-ban mr-2"></i>Désactiver
                                        </button>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            <i class="fas fa-eye mr-2"></i>Vérifier
                                        </button>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                                            <i class="fas fa-check mr-2"></i>Ignorer
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded overflow-hidden mr-3">
                                                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                                             class="h-full w-full object-cover">
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Appartement Paris</div>
                                                        <div class="text-sm text-gray-500">89€/nuit</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Pierre Martin
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Actif
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                24 réservations
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-yellow-600 hover:text-yellow-900">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reservations Management Tab -->
                    <div id="reservations-content" class="tab-panel hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Gestion des réservations</h3>
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-download mr-2"></i>Exporter
                                </button>
                                <select class="p-2 border border-gray-300 rounded-lg">
                                    <option>Toutes les réservations</option>
                                    <option>Confirmées</option>
                                    <option>En attente</option>
                                    <option>Annulées</option>
                                    <option>Terminées</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Search and Filter -->
                        <div class="bg-white rounded-xl shadow p-4 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <input type="text" placeholder="Rechercher par ID ou email" class="p-2 border border-gray-300 rounded-lg">
                                <input type="date" class="p-2 border border-gray-300 rounded-lg">
                                <button class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-search mr-2"></i>Rechercher
                                </button>
                            </div>
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
                                        <!-- Reservation 1 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #RES-2456
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded overflow-hidden mr-3">
                                                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                                             class="h-full w-full object-cover">
                                                    </div>
                                                    <div class="text-sm text-gray-900">Appartement Paris</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Sophie Laurent</div>
                                                <div class="text-sm text-gray-500">sophie@email.com</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                15-20 oct. 2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                267€
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Confirmée
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900 cancel-reservation-admin" data-id="2456">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Reservation 2 (Problematic) -->
                                        <tr class="bg-red-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #RES-2457
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded overflow-hidden mr-3">
                                                        <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                                             class="h-full w-full object-cover">
                                                    </div>
                                                    <div class="text-sm text-gray-900">Chalet Chamonix</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Thomas Bernard</div>
                                                <div class="text-sm text-gray-500">thomas@email.com</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                22-29 déc. 2023
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                1,015€
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                    Problème
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900 cancel-reservation-admin" data-id="2457">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <button class="text-purple-600 hover:text-purple-900">
                                                        <i class="fas fa-headset"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Complaints Management Tab -->
                    <div id="complaints-content" class="tab-panel hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold">Gestion des réclamations</h3>
                            <div class="flex space-x-3">
                                <select class="p-2 border border-gray-300 rounded-lg">
                                    <option>Toutes les réclamations</option>
                                    <option>Non traitées</option>
                                    <option>En cours</option>
                                    <option>Résolues</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Complaints List -->
                        <div class="space-y-6">
                            <!-- Complaint 1 -->
                            <div class="bg-white rounded-xl shadow overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="font-bold text-lg">Logement non conforme aux photos</h4>
                                            <p class="text-sm text-gray-600">Référence: #COMP-789</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Haute priorité
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Plaignant</p>
                                            <p class="font-medium">Sophie Laurent</p>
                                            <p class="text-sm text-gray-600">Réservation #RES-2456</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Logement concerné</p>
                                            <p class="font-medium">Appartement Paris (Hôte: Pierre Martin)</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Description:</p>
                                        <div class="p-4 bg-gray-50 rounded-lg">
                                            <p>"Les photos montrent un appartement moderne et propre, mais à l'arrivée, l'appartement était sale, des équipements manquaient et il y avait une forte odeur de tabac. Les photos sont trompeuses."</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex space-x-3">
                                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            <i class="fas fa-ban mr-2"></i>Sanctionner l'hôte
                                        </button>
                                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            <i class="fas fa-check mr-2"></i>Rembourser le voyageur
                                        </button>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            <i class="fas fa-comments mr-2"></i>Contacter les parties
                                        </button>
                                        <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                                            <i class="fas fa-archive mr-2"></i>Archiver
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Complaint 2 -->
                            <div class="bg-white rounded-xl shadow overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="font-bold text-lg">Annulation abusive par l'hôte</h4>
                                            <p class="text-sm text-gray-600">Référence: #COMP-788</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Moyenne priorité
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Plaignant</p>
                                            <p class="font-medium">Thomas Bernard</p>
                                            <p class="text-sm text-gray-600">Réservation #RES-2457</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Logement concerné</p>
                                            <p class="font-medium">Chalet Chamonix (Hôte: Marie Dubois)</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Description:</p>
                                        <div class="p-4 bg-gray-50 rounded-lg">
                                            <p>"L'hôte a annulé ma réservation 48h avant mon arrivée sans raison valable. J'avais déjà réservé mes billets de train et cette annulation me cause un préjudice financier important."</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex space-x-3">
                                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            <i class="fas fa-ban mr-2"></i>Sanctionner l'hôte
                                        </button>
                                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            <i class="fas fa-euro-sign mr-2"></i>Offrir un crédit
                                        </button>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            <i class="fas fa-comments mr-2"></i>Médiation
                                        </button>
                                    </div>
                                </div>
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
           <!-- JavaScript -->
    <script src="../assets/script.js"></script>
</body>
</html>