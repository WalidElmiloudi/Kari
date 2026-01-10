<?php
session_start();

require '../vendor/autoload.php';

use Core\Database;
use Entities\Rental;
use Entities\Favorite;

$pdo = Database::getInstance();
if(isset($_SESSION['userID'])){
    $user_id = $_SESSION['userID'];
}
$rentals = Rental::dispalyAll($pdo);
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
                    <h2 class="text-3xl font-bold">Logements Available</h2>
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
                <?php
                foreach($rentals as $rental) {
                    if(isset($user_id)){
                        $favorite = new Favorite($rental['id'],$user_id);
                        $is_favorited = $favorite->isFavorite();  
                    }
                ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="<?= $rental['img'] ?>" 
                                 alt="Appartement moderne" class="w-full h-48 object-cover">
                                 <?php
                                if(isset($is_favorited) && $is_favorited) {
                                    ?>
                                <a href="../services/favorites-handler.php?action=delete&rental_id=<?= $rental['id'] ?>&target=available-rentals" class="absolute top-3 right-3 text-white text-xl">
                                <i class="fas fa-heart text-red-600"></i>
                                </a>
                                <?php
                                } else {
                                ?>
                                <a href="../services/favorites-handler.php?action=add&rental_id=<?= $rental['id'] ?>&target=available-rentals" class="absolute top-3 right-3 text-white text-xl">
                                <i class="far fa-heart"></i>
                                </a>
                                <?php 
                                }    
                                ?>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg"><?= $rental['title'] ?></h3>
                                    <p class="text-gray-600 text-sm"><?= $rental['city'] ?>, <?= $rental['adress'] ?></p>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="font-bold">4.85/5</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <span class="font-bold text-lg"><?= $rental['price'] ?>$</span>
                                    <span class="text-gray-600"> / nuit</span>
                                </div>
                                <button onclick="dispalyBookingModal('<?= $rental['title'] ?>',<?= $rental['price'] ?>,<?= $rental['id'] ?>,'available-rentals')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    Réserver
                                </button>
                            </div>
                        </div>
                 
                    </div>
                                  <?php
                }
                        ?>         
                <!-- Pagination -->
                <!-- <div class="flex justify-center mt-10">
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
                </div> -->
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
    <section id="bookingModal">

    </section>
    <!-- Modal de Connexion -->
        <div id="loginModal"
            class="overlay fixed inset-0 bg-black bg-opacity-50  z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
                <!-- En-tête -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-800">Connexion</h2>
                        <button id="close-login" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">Connectez-vous à votre compte Kari</p>
                </div>

                <!-- Formulaire -->
                <form id="login-form" class="p-6" action="../repositories/login.php" method="post">
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <div class="relative">
                            <input type="email" name="email" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="vous@exemple.com">
                            <i class="fas fa-envelope absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Votre mot de passe">
                            <i class="fas fa-lock absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 mb-4">
                        Se connecter
                    </button>

                    <!-- Lien vers inscription -->
                    <div class="text-center">
                        <p class="text-gray-600 text-sm">
                            Vous n'avez pas de compte ?
                            <button type="button" id="signupRedirectBtn"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                S'inscrire
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal d'Inscription -->
        <div id="signupModal"
            class="overlay fixed inset-0 bg-black bg-opacity-50  z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md animate-fadeIn">
                <!-- En-tête -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-800">Inscription</h2>
                        <button id="close-register" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">Rejoignez la communauté Kari</p>
                </div>

                <!-- Formulaire -->
                <form id="register-form" class="p-6" action="../repositories/signup.php" method="post">
                    <!-- Nom et Prénom -->
                    <div class="flex flex-col gap-4 mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Votre Nom Complet</label>
                        <input type="text" name="name" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Jean Duhh">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                        <div class="relative">
                            <input type="email" name="email" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="vous@exemple.com">
                            <i class="fas fa-envelope absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Créez un mot de passe">
                            <i class="fas fa-lock absolute right-3 top-3.5 text-gray-400"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères avec chiffres et lettres</p>
                    </div>

                    <!-- Type de compte -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Je souhaite :</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                <input type="radio" name="roles" value="1" class="h-4 w-4 text-blue-600">
                                <div class="ml-3">
                                    <span class="block font-medium">Voyager</span>
                                    <span class="block text-xs text-gray-500">Réserver des logements</span>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                <input type="radio" name="roles" value="2" class="h-4 w-4 text-blue-600">
                                <div class="ml-3">
                                    <span class="block font-medium">Être hôte</span>
                                    <span class="block text-xs text-gray-500">Louer mon logement</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 mb-4">
                        Créer mon compte
                    </button>

                    <!-- Lien vers connexion -->
                    <div class="text-center">
                        <p class="text-gray-600 text-sm">
                            Vous avez déjà un compte ?
                            <button type="button" id="loginRedirectBtn"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                Se connecter
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
     <script src="../assets/script.js"></script>
</body>
</html>