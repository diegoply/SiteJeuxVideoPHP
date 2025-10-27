<?php
// Inclut le header
require_once 'templates/header.php';
require_once 'libs/game.php';
require_once 'libs/session.php';
require_once 'libs/user.php';
require_once 'libs/pdo.php';
require_once 'settings/settings.php';


$games = getAllGames($pdo, LATEST_GAMES_LIMIT);

//  var_dump($_SESSION);

?>


    





<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container mx-auto flex px-5 py-8 md:flex-row flex-col items-center">
    <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
      <?php if (isLoggedIn() === TRUE): ?>
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">
        Bienvenue <?php echo $_SESSION["user"]["username"]; ?>
    </h1>
    <?php endif; ?>
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white">Listez vos jeux favoris
        <br class="hidden lg:inline-block">sur All Games
      </h1>
      <p class="mb-8 leading-relaxed">All Games est la plateform ideal pour ajouter vos jeux favoris et découvrir de nouveaux jeux. Découvrez les derniers jeux</p>
      <div class="flex justify-center">
        <a href="jeux.php" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">Voir les jeux</a>
       
      </div>
    </div>
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
      <svg width="520" height="420" viewBox="0 0 520 220" xmlns="http://www.w3.org/2000/svg">
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
    </div>
  </div>
</section>



<section class="text-gray-400 bg-gray-900 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col">
      <div class="h-1 bg-gray-800 rounded overflow-hidden">
        <div class="w-24 h-full bg-blue-500"></div>
      </div>
      <div class="flex flex-wrap sm:flex-row flex-col py-6 mb-12">
        <h1 class="sm:w-2/5 text-white font-medium title-font text-2xl mb-2 sm:mb-0">Les derniers Jeux</h1>
        
      </div>
    </div>
    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">

  <?php foreach($games as $index=>$game): ?>
    <?php require 'templates/_game_items.php'; ?>
  <?php endforeach; ?>


      
      
    </div>
  </div>
</section>








<?php
// Inclut le header
require_once 'templates/footer.php';
?>

</body>
</html>