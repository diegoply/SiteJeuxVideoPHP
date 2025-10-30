<?php

require_once 'libs/session.php';

// $user = $_SESSION['user'] ?? null; // Si personne n’est connecté, $user sera null

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiteStyleSteam</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <header class="text-gray-400 bg-gray-900 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a href="index.php" class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
      <svg width="403" height="100" viewBox="0 0 520 220" xmlns="http://www.w3.org/2000/svg">
  <rect x="6" y="6" width="508" height="208" rx="24" fill="#0b1220" />
  <circle cx="122" cy="94" r="54" fill="#3b82f6" />
  <!-- pictogramme simplifié -->
  <g transform="translate(96,68) scale(0.9)" fill="#0b1220">
    <path d="M34 6c-6.6 0-12 5.4-12 12v4c0 2.2-1.8 4-4 4h-6c-6.6 0-12 5.4-12 12v2c0 6.6 5.4 12 12 12h44c6.6 0 12-5.4 12-12v-2c0-6.6-5.4-12-12-12h-6c-2.2 0-4-1.8-4-4v-4c0-6.6-5.4-12-12-12z" />
    <circle cx="24" cy="30" r="4" fill="#ffffff" />
    <circle cx="40" cy="30" r="3" fill="#ffffff" />
  </g>
  <text x="180" y="48" font-family="Inter, Arial, sans-serif" font-size="44" font-weight="700" fill="#ffffff">All</text>
  <text x="180" y="92" font-family="Inter, Arial, sans-serif" font-size="34" font-weight="600" fill="#94a3b8">Games</text>
</svg>
    </a>
    <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
      <a href="jeux.php" class="mr-5 hover:text-white">Liste des jeux</a>
      <?php if (isLoggedIn() === TRUE): ?>
      <a href="ma_liste.php" class="mr-5 hover:text-white">Ma liste de souhaits</a>
      <?php endif; ?>
      <a class="mr-5 hover:text-white">Third Link</a>
      <a class="mr-5 hover:text-white">Fourth Link</a>
    </nav>
    
<?php if (isLoggedIn() === TRUE): ?>
  <a href="logout.php" class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">
    Déconnexion
  </a>
<?php else: ?>
  <a href="inscription.php" class="mr-4 inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">Inscription
  </a>
  <a href="login.php" class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">
    Connexion
  </a>
<?php endif; ?>


  </div>
</header>