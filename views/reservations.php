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
                    <a href="available-rentals.html" class="text-gray-700 hover:text-blue-600 transition">Explorer</a>
                    <a href="#favorites" class="text-gray-700 hover:text-blue-600 transition">Favoris</a>
                    <a href="#notifications" class="text-gray-700 hover:text-blue-600 transition relative">
                        <i class="far fa-bell"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                    </a>
                    
                    <!-- User Menu -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <span class="text-gray-700">Marie</span>
                            <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block transition">
                            <a href="user-profile.html" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-user-circle mr-2"></i>Mon profil
                            </a>
                            <a href="#logout" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </a>
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
                        <p class="text-2xl font-bold">3</p>
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
                        <p class="text-2xl font-bold">12</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                        <i class="fas fa-star text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Avis à donner</p>
                        <p class="text-2xl font-bold">2</p>
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
                        <p class="text-2xl font-bold">1</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabs Navigation -->
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 overflow-x-auto">
                    <button id="tab-upcoming" class="tab-button py-4 px-1 border-b-2 border-blue-600 text-blue-600 font-medium whitespace-nowrap">
                        <i class="fas fa-calendar-day mr-2"></i>À venir (3)
                    </button>
                    <button id="tab-pending" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                        <i class="fas fa-clock mr-2"></i>En attente (1)
                    </button>
                    <button id="tab-completed" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                        <i class="fas fa-check-circle mr-2"></i>Terminées (12)
                    </button>
                    <button id="tab-cancelled" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                        <i class="fas fa-times-circle mr-2"></i>Annulées (1)
                    </button>
                    <button id="tab-all" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium whitespace-nowrap">
                        <i class="fas fa-list-alt mr-2"></i>Toutes (17)
                    </button>
                </nav>
            </div>
        </div>
        
        <!-- Reservations Content -->
        <div id="tab-content">
            <!-- Upcoming Reservations (Default Tab) -->
            <div id="upcoming-content" class="tab-panel active">
                <h2 class="text-xl font-bold mb-6">Vos prochains séjours</h2>
                
                <!-- Reservation 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="md:flex">
                        <div class="md:w-1/4">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Appartement Paris" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold">Appartement moderne à Paris</h3>
                                            <p class="text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Paris, 15ème arrondissement
                                            </p>
                                        </div>
                                        <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                            Confirmée
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Dates</p>
                                            <p class="font-medium">
                                                <i class="far fa-calendar mr-2"></i>15 - 20 oct. 2023
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">3 nuits</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Voyageurs</p>
                                            <p class="font-medium">
                                                <i class="fas fa-user mr-2"></i>2 adultes
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Prix total</p>
                                            <p class="text-2xl font-bold text-blue-600">267€</p>
                                            <p class="text-sm text-gray-600">89€ / nuit</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 mb-1">Hôte</p>
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                            <span class="font-medium">Pierre Martin</span>
                                            <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Superhôte</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-file-invoice mr-2"></i> Voir la facture
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-envelope mr-2"></i> Contacter l'hôte
                                </button>
                                <button class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition">
                                    <i class="fas fa-calendar-alt mr-2"></i> Modifier les dates
                                </button>
                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition cancel-button" 
                                        data-reservation="12345">
                                    <i class="fas fa-times mr-2"></i> Annuler la réservation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reservation 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="md:flex">
                        <div class="md:w-1/4">
                            <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Chalet montagne" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold">Chalet cosy en montagne</h3>
                                            <p class="text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Chamonix, Haute-Savoie
                                            </p>
                                        </div>
                                        <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                            Confirmée
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Dates</p>
                                            <p class="font-medium">
                                                <i class="far fa-calendar mr-2"></i>22 - 29 déc. 2023
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">7 nuits</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Voyageurs</p>
                                            <p class="font-medium">
                                                <i class="fas fa-user mr-2"></i>4 adultes, 2 enfants
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Prix total</p>
                                            <p class="text-2xl font-bold text-blue-600">1,015€</p>
                                            <p class="text-sm text-gray-600">145€ / nuit</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 mb-1">Hôte</p>
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                            <span class="font-medium">Marie Dubois</span>
                                            <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Superhôte</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Check-in Instructions -->
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <h4 class="font-medium text-blue-800 mb-2">
                                            <i class="fas fa-key mr-2"></i>Instructions pour l'arrivée
                                        </h4>
                                        <p class="text-sm text-blue-700">
                                            Récupérez les clés à la réception au 123 Rue de la Montagne. Code de la boîte aux lettres: 7890
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-directions mr-2"></i> Itinéraire
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-question-circle mr-2"></i> Aide à l'arrivée
                                </button>
                                <button class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition">
                                    <i class="fas fa-calendar-alt mr-2"></i> Modifier
                                </button>
                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition cancel-button" 
                                        data-reservation="12346">
                                    <i class="fas fa-times mr-2"></i> Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reservation 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-1/4">
                            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Villa bord de mer" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold">Villa avec piscine à Nice</h3>
                                            <p class="text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Nice, Côte d'Azur
                                            </p>
                                        </div>
                                        <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">
                                            En attente de paiement
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Dates</p>
                                            <p class="font-medium">
                                                <i class="far fa-calendar mr-2"></i>5 - 12 mars 2024
                                            </p>
                                            <p class="text-sm text-gray-600 mt-1">7 nuits</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Voyageurs</p>
                                            <p class="font-medium">
                                                <i class="fas fa-user mr-2"></i>6 adultes
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Prix total</p>
                                            <p class="text-2xl font-bold text-blue-600">1,470€</p>
                                            <p class="text-sm text-gray-600">210€ / nuit</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 mb-1">Date limite de paiement</p>
                                        <p class="font-medium text-red-600">
                                            <i class="far fa-clock mr-2"></i>10 janvier 2024
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    <i class="fas fa-credit-card mr-2"></i> Payer maintenant
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-question-circle mr-2"></i> Aide au paiement
                                </button>
                                <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition cancel-button" 
                                        data-reservation="12347">
                                    <i class="fas fa-times mr-2"></i> Annuler la demande
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Reservations -->
            <div id="pending-content" class="tab-panel hidden">
                <h2 class="text-xl font-bold mb-6">Réservations en attente</h2>
                <div class="bg-white rounded-xl shadow p-8 text-center">
                    <div class="h-16 w-16 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Vous avez 1 réservation en attente</h3>
                    <p class="text-gray-600 mb-6">Votre demande de réservation pour la villa à Nice est en attente de paiement.</p>
                    <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition">
                        <i class="fas fa-credit-card mr-2"></i> Compléter le paiement
                    </button>
                </div>
            </div>
            
            <!-- Completed Reservations -->
            <div id="completed-content" class="tab-panel hidden">
                <h2 class="text-xl font-bold mb-6">Séjours terminés</h2>
                
                <!-- Filter Controls -->
                <div class="flex justify-between items-center mb-6">
                    <div class="text-gray-600">12 séjours terminés</div>
                    <div class="flex space-x-2">
                        <select class="border border-gray-300 rounded-lg px-4 py-2">
                            <option>Trier par: Plus récent</option>
                            <option>Plus ancien</option>
                            <option>Prix croissant</option>
                            <option>Prix décroissant</option>
                        </select>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-filter mr-2"></i>Filtrer
                        </button>
                    </div>
                </div>
                
                <!-- Completed Reservation 1 -->
                <div class="bg-white rounded-xl shadow overflow-hidden mb-6">
                    <div class="md:flex">
                        <div class="md:w-1/4">
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Studio Bordeaux" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-3/4 p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold">Studio centre-ville Bordeaux</h3>
                                            <p class="text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i>Bordeaux, Centre-ville
                                            </p>
                                        </div>
                                        <div>
                                            <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">
                                                Terminé
                                            </span>
                                            <p class="text-sm text-gray-600 mt-1 text-right">15-18 sept. 2023</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Note</p>
                                            <div class="flex items-center">
                                                <div class="flex text-yellow-400">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <span class="ml-2 font-bold">4.0</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Prix payé</p>
                                            <p class="text-xl font-bold text-blue-600">201€</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Hôte</p>
                                            <p class="font-medium">Jean Dupont</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Review Status -->
                                    <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-medium text-yellow-800">
                                                    <i class="fas fa-star mr-2"></i>Avis en attente
                                                </h4>
                                                <p class="text-sm text-yellow-700">Laissez un avis sur votre séjour pour aider la communauté</p>
                                            </div>
                                            <button class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                                                Laisser un avis
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-file-invoice mr-2"></i> Facture
                                </button>
                                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-redo mr-2"></i> Réserver à nouveau
                                </button>
                                <button class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                    <i class="fas fa-headset mr-2"></i> Support
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-8">
                    <button class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-history mr-2"></i> Voir tout l'historique (12 séjours)
                    </button>
                </div>
            </div>
            
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
            
            <!-- All Reservations -->
            <div id="all-content" class="tab-panel hidden">
                <h2 class="text-xl font-bold mb-6">Toutes vos réservations</h2>
                <p class="text-gray-600 mb-6">Vous avez effectué 17 réservations au total sur Kari.</p>
                
                <!-- Summary Table -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Logement
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dates
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Statut
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Montant
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Sample Row -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded overflow-hidden mr-3">
                                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                                     alt="Appartement Paris" class="h-full w-full object-cover">
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Appartement Paris</div>
                                                <div class="text-sm text-gray-500">15ème arrondissement</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">15-20 oct. 2023</div>
                                        <div class="text-sm text-gray-500">3 nuits</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Confirmée
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        267€
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                        <button class="text-red-600 hover:text-red-900">Annuler</button>
                                    </td>
                                </tr>
                                <!-- More rows would go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cancellation Modal -->
    <div id="cancellation-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Confirmer l'annulation</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir annuler cette réservation ?</p>
                    
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                        <h4 class="font-medium text-red-800 mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Politique de remboursement
                        </h4>
                        <ul class="text-sm text-red-700 space-y-1">
                            <li>• Remboursement à 100% si annulation dans les 48h</li>
                            <li>• Remboursement à 50% si annulation 7 jours avant</li>
                            <li>• Pas de remboursement moins de 24h avant</li>
                        </ul>
                    </div>
                    
                    <div id="cancellation-details" class="p-4 bg-gray-50 rounded-lg">
                        <!-- Dynamic content will go here -->
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button id="confirm-cancel" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                        Oui, annuler
                    </button>
                    <button id="cancel-modal" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                        Non, garder
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <p class="text-gray-400">© 2023 Kari. Tous droits réservés.</p>
                <div class="mt-4 flex justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">Confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-white">Conditions</a>
                    <a href="#" class="text-gray-400 hover:text-white">Centre d'aide</a>
                    <a href="#" class="text-gray-400 hover:text-white">Contact</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab Switching Functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanels = document.querySelectorAll('.tab-panel');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-blue-600', 'text-blue-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('border-blue-600', 'text-blue-600');
                    this.classList.remove('border-transparent', 'text-gray-500');
                    
                    // Hide all tab panels
                    tabPanels.forEach(panel => {
                        panel.classList.remove('active');
                        panel.classList.add('hidden');
                    });
                    
                    // Show selected tab panel
                    const tabId = this.id.replace('tab-', '') + '-content';
                    const activePanel = document.getElementById(tabId);
                    if (activePanel) {
                        activePanel.classList.remove('hidden');
                        activePanel.classList.add('active');
                    }
                });
            });
            
            // Cancellation Modal Functionality
            const cancelButtons = document.querySelectorAll('.cancel-button');
            const modal = document.getElementById('cancellation-modal');
            const closeModal = document.getElementById('close-modal');
            const cancelModal = document.getElementById('cancel-modal');
            const confirmCancel = document.getElementById('confirm-cancel');
            const cancellationDetails = document.getElementById('cancellation-details');
            
            // Mock data for cancellation
            const reservations = {
                '12345': {
                    title: 'Appartement moderne à Paris',
                    dates: '15 - 20 octobre 2023',
                    amount: '267€',
                    policy: 'Remboursement à 100% si annulation avant le 13 octobre',
                    nights: 3
                },
                '12346': {
                    title: 'Chalet cosy en montagne',
                    dates: '22 - 29 décembre 2023',
                    amount: '1,015€',
                    policy: 'Remboursement à 50% si annulation avant le 15 décembre',
                    nights: 7
                },
                '12347': {
                    title: 'Villa avec piscine à Nice',
                    dates: '5 - 12 mars 2024',
                    amount: '1,470€',
                    policy: 'Remboursement à 100% (demande en attente)',
                    nights: 7
                }
            };
            
            let currentReservationId = null;
            
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    currentReservationId = this.getAttribute('data-reservation');
                    const reservation = reservations[currentReservationId];
                    
                    // Populate modal with reservation details
                    cancellationDetails.innerHTML = `
                        <div class="font-medium">${reservation.title}</div>
                        <div class="text-sm text-gray-600 mt-1">
                            <i class="far fa-calendar mr-1"></i>${reservation.dates} (${reservation.nights} nuits)
                        </div>
                        <div class="text-sm text-gray-600 mt-1">
                            <i class="fas fa-euro-sign mr-1"></i>Montant: ${reservation.amount}
                        </div>
                        <div class="text-sm font-medium text-red-600 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>${reservation.policy}
                        </div>
                    `;
                    
                    // Show modal
                    modal.classList.remove('hidden');
                });
            });
            
            // Close modal functions
            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
            
            cancelModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
            
            confirmCancel.addEventListener('click', () => {
                if (currentReservationId) {
                    // Here you would normally make an API call to cancel the reservation
                    alert(`Réservation ${currentReservationId} annulée avec succès !`);
                    modal.classList.add('hidden');
                    
                    // In a real app, you would refresh the reservation list
                    // location.reload();
                }
            });
            
            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
            
            // Dropdown menu functionality
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
        });
    </script>
</body>
</html>